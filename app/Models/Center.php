<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Center extends Model
{
    protected $fillable = [
        'name',
        'city',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function groups(): HasMany
    {
        return $this->hasMany(Group::class);
    }

    public function monthlyFinancials(): HasMany
    {
        return $this->hasMany(MonthlyFinancial::class);
    }
}
