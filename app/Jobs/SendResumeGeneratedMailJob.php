<?php

namespace App\Jobs;

use App\Mail\SendResumeGeneratedMail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendResumeGeneratedMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $uuid = null;
    public $email = null;
    public $name = null;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($uuid, $data)
    {
        $this->uuid = $uuid;
        $this->email = $data['email'];
        $this->name = $data['first_name'] . ' ' . $data['last_name'];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->email)
            ->send(new SendResumeGeneratedMail($this->uuid, $this->name));
    }
}
