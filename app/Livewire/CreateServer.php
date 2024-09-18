<?php

namespace App\Livewire;

use App\Models\Server;
use Livewire\Component;
use Illuminate\View\View;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;

class CreateServer extends Component
{
    public Server $server;

    public function create(): void
    {
        $server = \App\Models\Server::create([
            'type' => 'app',
        ]);

        $batch = Bus::batch([
            new \App\Jobs\CreateServer($server),
            new \App\Jobs\InstallNginx($server),
            new \App\Jobs\InstallDatabase($server),
            new \App\Jobs\FinalizeServer($server),
        ])
            ->then(function (Batch $job) use ($server) {
                $server->update([
                    'batch_id' => null,
                    'provisioned_at' => now(),
                ]);
            })
            ->dispatch();

        $server->update([
            'batch_id' => $batch->id,
        ]);

        $this->redirectRoute('servers.show', $server);
    }

    public function render(): View
    {
        return view('livewire.create-server');
    }
}
