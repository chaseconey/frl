<?php

namespace App\Console\Commands;

use App\Models\Division;
use App\Service\Discord\Actions\AddToManagedRoles;
use App\Service\Discord\Actions\RemoveFromManagedRoles;
use Illuminate\Console\Command;

class SyncDiscordRoles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'discord:sync-roles {divisionId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync Discord roles for specified division';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $division = Division::with('drivers', 'drivers.user')->findOrFail($this->argument('divisionId'));

        foreach ($division->drivers as $driver) {
            if (! $driver->user->discord_user_id) {
                $this->warn("{$driver->name} does not have discord synced");
                continue;
            }

            $removeEvent = new RemoveFromManagedRoles();
            $removeEvent->handle($driver);

            $addEvent = new AddToManagedRoles();
            $addEvent->handle($driver);

            $this->info("{$driver->name}'s roles have been synced");
        }
    }
}
