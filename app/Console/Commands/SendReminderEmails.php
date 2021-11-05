<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\reminderEmail;
use App\Models\Todo;
use App\Models\User;

class SendReminderEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notification to user about reminder';

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
        // get all todos
        $todos = Todo::query()
        ->with(['user'])
        ->where('reminder', '!=', null)->get();
        // send email
        $data = [];
        foreach($todos as $todo) {
            $data[$todo->user_id][] = $todo->toArray();
        }
        // //send email
        foreach($data as $userId => $reminders) {
            $this->sendEmailToUser($userId, $reminders);
        }
        
    }
    
    private function sendEmailToUser($userId, $reminders) {
        $user = User::findOrFail($userId);
        \Mail::to($user)->send(new reminderEmail($reminders));
    }
}
