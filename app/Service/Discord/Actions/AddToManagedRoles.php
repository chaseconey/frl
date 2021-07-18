<?php


namespace App\Service\Discord\Actions;


use App\Enums\DriverType;
use App\Exceptions\DiscordRoleSyncError;
use App\Models\Driver;
use Illuminate\Support\Facades\Log;

class AddToManagedRoles
{

    public function handle(Driver $driver)
    {

        $client = app(\App\Service\Discord\Client::class);
        $guildId = config('services.discord.server_id');
        $roleId = null;

        if ($driver->type === DriverType::FullTime()->value) {
            $roleId = $driver->division->discord_driver_role_id;
        } else if ($driver->type === DriverType::Reserve()->value) {
            $roleId = $driver->division->discord_reserve_role_id;
        }

        $userId = $driver->user->discord_user_id;

        if (!$userId) {
            throw new DiscordRoleSyncError();
        }

        // Only execute if we have a role to operate on
        if ($roleId) {
            Log::info("Adding {$driver->name} to Discord role ID {$roleId}");

            $client->put("/guilds/{$guildId}/members/{$userId}/roles/{$roleId}");
        }

    }

}
