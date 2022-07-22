<?php

namespace App\Jobs;

use App\Mail\TeacherCreated;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class SendNotificationToTeacherJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $teacher;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($teacher)
    {
        $this->teacher = $teacher;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            Mail::to($this->teacher->email)->send(new TeacherCreated($this->teacher));
        } catch (\Exception $e) {
            report($e);
            echo $e->getMessage();
            return false;
        }
    }
}
