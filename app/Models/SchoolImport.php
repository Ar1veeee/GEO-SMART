<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolImport extends Model
{
    protected $fillable = [
        'file_name', 'file_path', 'total_rows', 'imported_rows',
        'failed_rows', 'status', 'log', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
