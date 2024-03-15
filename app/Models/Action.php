<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Action extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_investiment_id',
        'user_id',
        'active_code',
        'price',
        'recommended_percentage',
        'magic_number',
        'total_quotas_contributed',
        'missing_for_magic_number',
        'type',
    ];

    public function typeInvestiment(): BelongsTo
    {
        return $this->belongsTo(TypeInvestiment::class);
    }
}
