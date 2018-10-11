<?php

namespace Mwteam\BroadcastEmail\App\Mail;

use App\Helpers\PackageHelper;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BroadcastEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $info;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($info)
    {
        $this->info = $info;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(PackageHelper::getConfig('dashboard.emails.info.email'), PackageHelper::getConfig('dashboard.emails.info.title'))
            ->subject($this->info->title)
            ->view('dashboard::email.template')
            ->with(['content' => $this->info->content]);
    }
}
