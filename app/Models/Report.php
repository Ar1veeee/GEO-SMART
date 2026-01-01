<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'name', 'type', 'start_date', 'end_date',
        'district_id', 'jenjang', 'notes', 'file_format'
    ];

    protected $casts = [
        'jenjang' => 'array',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
