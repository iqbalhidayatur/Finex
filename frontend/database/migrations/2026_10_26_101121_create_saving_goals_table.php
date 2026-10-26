<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavingGoal extends Model
{
    protected $fillable = [
        'name',
        'description',
        'target_amount',
        'saved_amount',
        'target_date',
    ];

    protected function casts(): array
    {
        return [
            'target_amount' => 'decimal:2',
            'saved_amount' => 'decimal:2',
            'target_date' => 'date',
        ];
    }

    public function getProgressAttribute(): float
    {
        if ((float) $this->target_amount <= 0) {
            return 0;
        }

        return min(
            100,
            round(
                ((float) $this->saved_amount / (float) $this->target_amount) * 100,
                1
            )
        );
    }

    public function getRemainingAmountAttribute(): float
    {
        return max(
            0,
            (float) $this->target_amount - (float) $this->saved_amount
        );
    }
}
