<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use MatanYadaev\EloquentSpatial\Objects\Polygon;
use MatanYadaev\EloquentSpatial\Traits\HasSpatial;

class District extends Model
{
    use HasSpatial;

    protected $fillable = ['name', 'geom', 'total_students', 'area_sqkm'];

    protected $casts = [
        'geom' => Polygon::class,
    ];

    public function schools()
    {
        return $this->hasMany(School::class);
    }
}
