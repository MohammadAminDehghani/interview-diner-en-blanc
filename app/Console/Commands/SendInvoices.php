<?php

namespace App\Console\Commands;

use App\Jobs\SendInvoiceEmail;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class SendInvoices extends Command
{
    protected $signature = 'invoices:send';
    protected $description = 'Send invoices to users';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->sendInvoicesToUsers();

        $this->info('Invoice sending process has started.');
    }

    public function sendInvoicesToUsers()
    {
        Cache::put('emails_sent', 0);
        Cache::put('emails_failed', 0);

        User::chunk(1000, function ($users) {
            foreach ($users as $user) {
                $lastInvoice = Invoice::where('user_id', $user->id)
                    ->latest()
                    ->first();

                if ($lastInvoice) {
                    SendInvoiceEmail::dispatch($user, $lastInvoice);
                }
                $user->id % 1000 != 0 ?? dump($user->id);
            }
        });
    }
}
