<?php

namespace App\Jobs;

use App\Models\Server;
use Illuminate\Bus\Batchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class InstallNginx implements ShouldQueue
{
    use Batchable;
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(protected readonly Server $server) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        sleep(random_int(2, 5));
    }
}
