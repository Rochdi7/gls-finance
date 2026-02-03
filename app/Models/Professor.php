<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Professor extends Model
{
    protected $fillable = [
        'center_id',
        'name',
        'active',
    ];

    protected $casts = [
        'center_id' => 'integer',
        'active' => 'boolean',
    ];

    public function center(): BelongsTo
    {
        return $this->belongsTo(Center::class);
    }

    public function groups(): HasMany
    {
        return $this->hasMany(Group::class);
    }
}
