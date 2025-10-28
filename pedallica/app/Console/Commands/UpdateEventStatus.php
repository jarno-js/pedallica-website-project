<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Event;

class UpdateEventStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'events:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the is_passed status for all events based on their end_date';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Updating event status...');

        $events = Event::all();
        $updatedCount = 0;

        foreach ($events as $event) {
            $oldStatus = $event->is_passed;
            $event->checkIfPassed();

            if ($oldStatus !== $event->is_passed) {
                $updatedCount++;
                $this->line("Updated: {$event->title} - is_passed: " . ($event->is_passed ? 'true' : 'false'));
            }
        }

        $this->info("Done! Updated {$updatedCount} event(s).");

        return 0;
    }
}
