<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Periksa extends Model
{
    protected $fillable = [
        'id_janji_periksa',
        'tgl_periksa',
        'catatan',
        'biaya_periksa',
    ];
    protected $casts = [
        'tgl_periksa' => 'datetime',
    ];
    public function janjiPeriksa(): BelongsTo
    {
        return $this->belongsTo(
            JanjiPeriksa::class,
            'id_janji_periksa'
        );
    }
    public function detailPeriksas(): HasMany
    {
        return $this->hasMany(
            DetailPeriksa::class,
            'id_periksa'
        );
    }
}
