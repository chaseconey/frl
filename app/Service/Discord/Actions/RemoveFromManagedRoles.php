<?php


namespace App\Service\Discord\Actions;


use App\Models\Driver;
use Illuminate\Support\Facades\Log;

class RemoveFromManagedRoles
{

    public function handle(Driver $driver)
    {
        $client = app(\App\Service\Discord\Client::class);

        $guildId = config('services.discord.server_id');
        $driverRole = $driver->division->discord_driver_role_id;
        $reserveRole = $driver->division->discord_reserve_role_id;
        $userId = $driver->user->discord_user_id;

        Log::info("Removing {$driver->name} from Discord role IDs {$driverRole}, {$reserveRole}");

        $client->delete("/guilds/{$guildId}/members/{$userId}/roles/{$driverRole}");
        $client->delete("/guilds/{$guildId}/members/{$userId}/roles/{$reserveRole}");

    }

}
