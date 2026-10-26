<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $fillable = [
        'name',
        'description',
        'budget',
        'category',
    ];

    protected function casts(): array
    {
        return [
            'budget' => 'decimal:2',
        ];
    }
}
