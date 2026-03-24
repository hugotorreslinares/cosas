<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'category',
        'condition',
        'min_rental_days',
        'pricing_type',
        'price_amount',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'min_rental_days' => 'integer',
            'price_amount' => 'decimal:2',
            'is_published' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
