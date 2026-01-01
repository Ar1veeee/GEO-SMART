<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\Traits\HasSpatial;

class School extends Model
{
    use HasSpatial;

    protected $fillable = [
        'npsn', 'name', 'address', 'kelurahan', 'geom', 'student_count',
        'teacher_count', 'class_count', 'type', 'status',
        'lab_count', 'library_count', 'sanitation_count',
        'facilities', 'description', 'established_year',
        'district_id', 'user_id', 'kabupaten', 'provinsi'
    ];

    protected $casts = [
        'geom' => Point::class,
        'facilities' => 'array',
        'established_year' => 'integer',
    ];

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
