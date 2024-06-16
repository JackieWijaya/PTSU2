<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class data_pribadi extends Model
{
    use HasFactory;

    public function devisi(){
        return $this->belongsTo(devisi::class, 'devisis_id', 'id');
    }

    public function jabatan(){
        return $this->belongsTo(jabatan::class, 'jabatans_id', 'id');
    }
}
