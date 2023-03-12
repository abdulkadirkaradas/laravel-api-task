<?php

namespace App\Listeners;

use App\Events\LogCreated;
use App\Models\Logs;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MakeLogAfterRequest
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(LogCreated $event): void
    {
        $record = $event->record;

        $log = new Logs();
        $log->update_time = Carbon::now()->toDateTimeString();
        $log->book_id = $record->id;
        $log->save();
    }
}
