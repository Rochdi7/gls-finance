<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    protected $fillable = [
        'center_id',
        'professor_id',

        // ✅ AJOUT
        'name',

        'level_code',
        'students_start_count',
        'students_end_count',
        'price_per_student',
        'month',
        'year',
        'status',
    ];

    protected $casts = [
        'center_id' => 'integer',
        'professor_id' => 'integer',
        'students_start_count' => 'integer',
        'students_end_count' => 'integer',
        'price_per_student' => 'integer',
        'month' => 'integer',
        'year' => 'integer',
    ];

    public const LEVELS = ['A1', 'A2', 'B1', 'B2'];
    public const STATUSES = ['active', 'finished'];

    public function center(): BelongsTo
    {
        return $this->belongsTo(Center::class);
    }

    public function professor(): BelongsTo
    {
        return $this->belongsTo(Professor::class);
    }

    public function monthlyStats(): HasMany
    {
        return $this->hasMany(GroupMonthlyStat::class);
    }

    public function revenue(): int
    {
        return (int) ($this->students_end_count * $this->price_per_student);
    }

    public function retentionPercent(): float
    {
        if ((int) $this->students_start_count <= 0) {
            return 0.0;
        }

        return round(($this->students_end_count / $this->students_start_count) * 100, 2);
    }
}
