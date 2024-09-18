<?php

namespace App\Livewire;

use App\Models\Server;
use Livewire\Component;
use Illuminate\View\View;

class ShowServer extends Component
{
    public Server $server;

    public function updateProgress(): void
    {
        $this->server->refresh();
    }

    public function render(): View
    {
        return view('livewire.show-server');
    }
}
