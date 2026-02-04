<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GroupMonthlyStat extends Model
{
    protected $table = 'group_monthly_stats';

    protected $fillable = [
        'group_id',
        'month',
        'year',
        'students_start_count',
        'students_end_count',
        'revenue',
    ];

    protected $casts = [
        'group_id' => 'integer',
        'month' => 'integer',
        'year' => 'integer',
        'students_start_count' => 'integer',
        'students_end_count' => 'integer',
        'revenue' => 'integer',
    ];

    /**
     * 🔗 Groupe concerné
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    /**
     * ✅ Retention mensuelle %
     */
    public function retentionPercent(): float
    {
        if ($this->students_start_count <= 0) {
            return 0.0;
        }

        return round(
            ($this->students_end_count / $this->students_start_count) * 100,
            2
        );
    }
}
