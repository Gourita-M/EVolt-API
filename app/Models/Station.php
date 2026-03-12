<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    /** @use HasFactory<\Database\Factories\StationFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'latitude',
        'longitude',
        'connector_type',
        'status',
        'power',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function stats()
    {
        return $this->hasMany(Stats::class);
    }
}
