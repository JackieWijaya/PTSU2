<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class manajemen_jabatan extends Model
{
    use HasFactory;

    public function data_pribadi(){
        return $this->belongsTo(data_pribadi::class, 'nik', 'nik');
    }
}
