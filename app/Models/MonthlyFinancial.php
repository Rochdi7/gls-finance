<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MonthlyFinancial extends Model
{
    protected $table = 'monthly_financials';

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
        'center_id' => 'integer',
        'month' => 'integer',
        'year' => 'integer',
        'total_students' => 'integer',
        'total_revenue' => 'integer',
        'owner_share_50' => 'integer',
        'professors_share_35' => 'integer',
        'other_costs_15' => 'integer',
        'is_historical' => 'boolean',
        'locked' => 'boolean',
    ];

    public function center(): BelongsTo
    {
        return $this->belongsTo(Center::class);
    }

    /**
     * ✅ Helper: split 50/35/15 depuis total_revenue (arrondi stable)
     * - owner_share_50: arrondi
     * - professors_share_35: arrondi
     * - other_costs_15: reste pour éviter toute perte due aux arrondis
     */
    public function computeSplitFromRevenue(?int $revenue = null): array
    {
        $revenue = (int) ($revenue ?? $this->total_revenue);

        $owner = (int) round($revenue * 0.50);
        $prof  = (int) round($revenue * 0.35);
        $other = (int) ($revenue - $owner - $prof);

        return [
            'owner_share_50'       => $owner,
            'professors_share_35'  => $prof,
            'other_costs_15'       => $other,
        ];
    }

    /**
     * ✅ Optionnel: recalculer et remplir les colonnes du split
     * (utile dans ton Controller/Service après validation)
     */
    public function fillSplitFromRevenue(?int $revenue = null): self
    {
        return $this->fill($this->computeSplitFromRevenue($revenue));
    }

    /**
     * ✅ Petite sécurité: tu peux vérifier si c’est modifiable
     */
    public function isEditable(): bool
    {
        return !$this->locked;
    }
}
