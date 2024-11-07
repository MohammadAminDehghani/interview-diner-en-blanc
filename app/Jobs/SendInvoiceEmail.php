<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Invoice;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class SendInvoiceEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public User $user;
    public Invoice $invoice;

    public function __construct(User $user, Invoice $invoice)
    {
        $this->user = $user;
        $this->invoice = $invoice;
    }

    public function handle()
    {
        // Simulate a small delay
        usleep(50000); // 50ms delay

        // Simulate an error rate
        $error = rand(1, 100) <= 2; // 2% error rate

        if ($error) {
            Log::error("Failed to send email to user {$this->user->id} for invoice {$this->invoice->invoice_number}");
            Cache::increment('emails_failed');
            return;
        }

        Log::info("Sent email to user {$this->user->id} for invoice {$this->invoice->invoice_number}");
        Cache::increment('emails_sent');

        // Store the fake email content every 1000 emails
        $sentCount = Cache::get('emails_sent', 0);
        if ($sentCount % 100 == 0) {
            $this->storeFakeEmailContent($sentCount);
        }
    }

    protected function storeFakeEmailContent($sentCount)
    {
        $content = "To: {$this->user->name}@example.com\n" .
            "Subject: Invoice {$this->invoice->invoice_number}\n" .
            "Body: Dear {$this->user->name}, your invoice amount is {$this->invoice->amount}.\n\n";

        $folder = 'emails';
        $filePath = "{$folder}/emails_batch_{$sentCount}.txt";

        if (!is_dir($folder)) {
            mkdir($folder, 0755, true);
        }

        Storage::append($filePath, $content);
    }
}
