<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'address',
        'address_line_2',
        'label',
        'county',
        'country',
        'timezone',
        'city',
        'state',
        'zip',
        'map_icon',
        'latitude',
        'longitude',
    ];

    public function locationable()
    {
        return $this->morphTo();
    }
}
