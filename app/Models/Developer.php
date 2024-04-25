<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_perusahaan', 'nama_pj', 'alamat', 'telp', 'email'
    ];

    public function apk()
    {
        return $this->belongsTo(Apk::class);
    }
}
