<?php

namespace App\Listeners;

use App\Events\LogProcessed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SaveLog
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

    public function handle(LogProcessed $event)
    {
        info('hello log file is created');
        $current_timestamp = Carbon::now()->toDateTimeString();

        $todo = $event->todo;
        $method = $event->method;

        // dd($event);

        $saveHistory = DB::table('todo_history')->insert([
            'user_id' => $todo->user_id,
            'todo_id' => $todo->id,
            'action' => $method,
            'created_at' => $current_timestamp,
            'updated_at' => $current_timestamp
        ]);

        return $saveHistory;
    }
}
