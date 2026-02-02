<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MonthlyFinancial extends Model
{
    protected $fillable = [
        'center_id',
        'month',
        'year',
        'total_students',
        'total_revenue',
        'owner_share_50',
        'professors_share_35',
        'other_costs_15',
        'is_historical',
        'locked',
    ];

    protected $casts = [
        'is_historical' => 'boolean',
        'locked' => 'boolean',
    ];

    public function center(): BelongsTo
    {
        return $this->belongsTo(Center::class);
    }
}
