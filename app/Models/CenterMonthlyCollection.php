<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CenterMonthlyCollection extends Model
{
    protected $table = 'center_monthly_collections';

    protected $fillable = [
        'center_id',
        'year',
        'month',
        'cash_amount',
        'tpe_amount',
        'bank_transfer_amount',
        'cheque_amount',
        'note',
    ];

    protected $casts = [
        'center_id'             => 'integer',
        'year'                  => 'integer',
        'month'                 => 'integer',
        'cash_amount'           => 'decimal:2',
        'tpe_amount'            => 'decimal:2',
        'bank_transfer_amount'  => 'decimal:2',
        'cheque_amount'         => 'decimal:2',
        'total_amount'          => 'decimal:2',
    ];

    public function center(): BelongsTo
    {
        return $this->belongsTo(Center::class);
    }

    /**
     * Get total amount from all payment methods.
     *
     * @return float
     */
    public function getTotalAmountAttribute(): float
    {
        return (float) (
            ($this->cash_amount ?? 0) +
            ($this->tpe_amount ?? 0) +
            ($this->bank_transfer_amount ?? 0) +
            ($this->cheque_amount ?? 0)
        );
    }
}
