<?php

namespace App\Jobs;

use App\Models\Division;
use App\Models\Race;
use App\Service\Discord\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PostNextRace implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Grab active divisions
        $divisions = Division::active()->get();
        foreach ($divisions as $division) {

            // Is there an upcoming race in roughly 72 hours that hasn't been reminded already
            $race = $division->races()
                ->where('race_time', '>=', now())
                ->where('race_time', '<', now()->addHours(72))
                ->whereNull('reminder_sent_at')
                ->first();

            if ($race) {
                // Send reminder
                $this->postMessage($race);
            }
        }
    }

    private function postMessage(Race $race)
    {
        // TODO: Figure out the proper way to inject this. It works, but fails because it actually returns a PendingRequest rather than a Client.
        $client = app(Client::class);
        $channel = $race->division->discord_reminder_channel_id;

        if (! $channel) {
            return;
        }

        // TODO: Add mention capability

        // Original Message
        $response = $client->post("/channels/{$channel}/messages", [
            "content" => "Greetings racers! Please indicate your availability for next race.

✅: if you are a full-time driver and you will attend
✔: if you are a reserve driver and you can fill a spot
❔: if you are unsure about attending
🛑: if you are not able to attend",
            "tts" => false,
            'embed' => [
                "title" => $race->track->name,
                "description" => "**[{$race->race_time->tz('US/Eastern')->toDayDateTimeString()} EST](https://www.timeanddate.com/worldclock/converter.html?iso={$race->race_time->format('Ymd\THis')}&p1=tz_et&p2=tz_ct&p3=tz_pt)**",
                "url" => route('race.results.index', $race)
            ]
        ]);

        $json = $response->json();
        $messageId = $json['id'];

        // Add reactions
        $emojis = ["✅", "✔️", "❔", "🛑"];
        foreach ($emojis as $emoji) {
            $client->put("/channels/{$channel}/messages/{$messageId}/reactions/{$emoji}/@me");
            sleep(1);
        }

        // Set race as been reminded
        $race->reminder_sent_at = now();
        $race->save();

        // TODO: Once we have discord accounts linked, we can actually see who has responded with each status as well
//    $response = $client->get("/channels/802023385395363872/messages/{$messageId}/reactions/✅");
    }
}
