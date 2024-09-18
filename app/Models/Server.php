<?php

namespace App\Models;

use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;
use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $fillable = [
        'type',
        'provisioned_at',
        'batch_id',
    ];

    protected function casts(): array
    {
        return [
            'provisioned_at' => 'datetime',
        ];
    }

    public function batch(): ?Batch
    {
        if (! $this->batch_id) {
            return null;
        }

        return Bus::findBatch($this->batch_id);
    }
}
