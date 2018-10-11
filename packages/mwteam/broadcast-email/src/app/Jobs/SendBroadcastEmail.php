<?php

namespace Mwteam\BroadcastEmail\App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use Mwteam\BroadcastEmail\App\Mail\BroadcastEmail;

class SendBroadcastEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 5;
    protected $email;
    protected $info;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email,$info)
    {
        $this->email=$email;
        $this->info=$info;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->email)->send(new BroadcastEmail($this->info));
    }
}
