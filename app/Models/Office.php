<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use MatanYadaev\EloquentSpatial\Traits\HasSpatial;
use MatanYadaev\EloquentSpatial\Objects\Point;

class Office extends Model
{
    use HasSpatial;

    protected $table = 'office';

    protected $fillable = ['name', 'address', 'geom'];

    protected $casts = [
        'geom' => Point::class,
    ];
}
