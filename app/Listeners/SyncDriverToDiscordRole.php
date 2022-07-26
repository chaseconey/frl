<?php

namespace App\Listeners;

use App\Events\DriverSaving;
use App\Exceptions\DiscordRoleSyncError;
use App\Service\Discord\Actions\AddToManagedRoles;
use App\Service\Discord\Actions\RemoveFromManagedRoles;

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
     *
     * @throws DiscordRoleSyncError
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
        $action = new RemoveFromManagedRoles();
        $action->handle($event->driver);
    }

    /**
     * Add to new role based on type of driver
     *
     * @param  DriverSaving  $event
     *
     * @throws DiscordRoleSyncError
     */
    private function addToRole(DriverSaving $event): void
    {
        $action = new AddToManagedRoles();
        $action->handle($event->driver);
    }
}
