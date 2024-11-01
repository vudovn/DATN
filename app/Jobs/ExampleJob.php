<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Password;
class ExampleJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    protected $email;
    public function __construct(
        $email,
    ) {
        $this->email = $email;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Password::sendResetLink(['email' => $this->email]);
    }
}
