<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cuti extends Model
{
    use HasFactory;

    public function data_pribadi(){
        return $this->belongsTo(data_pribadi::class, 'nik', 'nik');
    }

    public function jenis_cuti(){
        return $this->belongsTo(jenis_cuti::class, 'jenis_cutis_id', 'id');
    }
}
