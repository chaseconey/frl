<?php

namespace App\Listeners;

use App\Events\DriverSaving;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SyncDriverToDiscordRole
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  DriverSaving  $event
     * @return void
     */
    public function handle(DriverSaving $event)
    {
        $this->removeFromRoles($event);
        $this->addToRole($event);
    }

    /**
     * Remove from all managed roles before adding new role (if applicable)
     *
     * @param  DriverSaving  $event
     */
    private function removeFromRoles(DriverSaving $event)
    {
        $client = app(\App\Service\Discord\Client::class);

        $guildId = config('services.discord.server_id');
        $driverRole = $event->driver->division->discord_driver_role_id;
        $reserveRole = $event->driver->division->discord_reserve_role_id;
        $userId = $event->driver->user->discord_user_id;

        $client->delete("/guilds/{$guildId}/members/{$userId}/roles/{$driverRole}");
        $client->delete("/guilds/{$guildId}/members/{$userId}/roles/{$reserveRole}");

    }

    /**
     * Add to new role based on type of driver
     *
     * @param  DriverSaving  $event
     */
    private function addToRole(DriverSaving $event): void
    {
        $client = app(\App\Service\Discord\Client::class);
        $guildId = config('services.discord.server_id');

        if ($event->driver->type === "FULL_TIME") {
            $roleId = $event->driver->division->discord_driver_role_id;
        } else {
            $roleId = $event->driver->division->discord_reserve_role_id;
        }

        $userId = $event->driver->user->discord_user_id;

        $client->put("/guilds/{$guildId}/members/{$userId}/roles/{$roleId}");
    }
}
