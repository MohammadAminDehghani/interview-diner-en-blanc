<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class ShowEmailProgress extends Command
{
    protected $signature = 'email:progress';
    protected $description = 'Display email sending progress';

    public function handle()
    {
        $sent = Cache::get('emails_sent', 0);
        $failed = Cache::get('emails_failed', 0);

        $this->info("Emails sent: {$sent}");
        $this->info("Emails failed: {$failed}");
    }
}
