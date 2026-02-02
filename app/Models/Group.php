<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Group extends Model
{
    protected $fillable = [
        'center_id',
        'level_id',
        'professor_id',
        'students_start_count',
        'students_end_count',
        'price_per_student',
        'month',
        'year',
        'status',
    ];

    public function center(): BelongsTo
    {
        return $this->belongsTo(Center::class);
    }

    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class);
    }

    public function professor(): BelongsTo
    {
        return $this->belongsTo(Professor::class);
    }

    // Helpers (optionnel mais utile)
    public function getRetentionRateAttribute(): float
    {
        $start = (int) $this->students_start_count;
        $end   = (int) $this->students_end_count;

        if ($start <= 0) return 0.0;

        return round(($end / $start) * 100, 2); // %
    }

    public function getRevenueAttribute(): int
    {
        // Tu peux choisir end_count ou start_count selon ta logique business.
        // Ici on prend end_count (ceux qui ont “payé/continué” fin du mois).
        return (int) $this->students_end_count * (int) $this->price_per_student;
    }
}
