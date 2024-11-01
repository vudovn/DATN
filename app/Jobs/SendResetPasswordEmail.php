<?php 
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\CustomResetPasswordMail;
use Mail;

class SendResetPasswordEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $notifiable;
    protected $resetUrl;

    /**
     * Create a new job instance.
     */
    public function __construct($notifiable, $resetUrl)
    {
        $this->notifiable = $notifiable;
        $this->resetUrl = $resetUrl;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        Mail::to($this->notifiable->email)
            ->send(new CustomResetPasswordMail($this->notifiable, $this->resetUrl));
    }
}
