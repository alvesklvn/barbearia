<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Support\Facades\Log;
use Throwable;

class SendEmailVerificationJob implements ShouldQueue, ShouldBeUnique
{
    use Queueable;

    public int $tries = 4;

    public int $timeout = 10;

    public function backoff(): array
    {
        return [
            10,
            15,
            20
        ];
    }

    /**
     * Create a new job instance.
     */
    public function __construct(private User $user)
    {
        
    }

    public function uniqid(): string
    {
        return "email-verification:user-{$this->user->id}";
    }

    public function middleware(): array
    {
        return [
            new WithoutOverlapping("sendemail-verify:user-{$this->user->id}")
        ];
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        event(new Registered($this->user));
    }

    public function failed(Throwable $exception)
    {
        Log::error('Falha ao enviar email', [
            'user_id' => $this->user->id,
            'user_email' => $this->user->email,
            'error' => $exception->getMessage(),
            'http_code' => $exception->getCode()
        ]);
    }
}