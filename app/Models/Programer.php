<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programer extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'alamat', 'telp', 'email'
    ];

    public function apk()
    {
        return $this->belongsTo(Apk::class);
    }
}
