<?php

namespace App\Listeners;

use App\Events\DivisionCreating;

class CreateDiscordRoleForDivision
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  DivisionCreating  $event
     * @return void
     */
    public function handle(DivisionCreating $event)
    {
        $resp = $this->makeRole("{$event->division->name} Drivers");
        $event->division->discord_driver_role_id = $resp['id'];

        $resp = $this->makeRole("{$event->division->name} Reserves");
        $event->division->discord_reserve_role_id = $resp['id'];
    }

    /**
     * @param  string  $name
     * @return mixed
     */
    private function makeRole(string $name)
    {
        $client = app(\App\Service\Discord\Client::class);

        $guildId = config('services.discord.server_id');
        $resp = $client->post("/guilds/{$guildId}/roles", [
            'name' => $name,
            'mentionable' => true,
            'hoist' => true,
        ]);

        return $resp;
    }
}
