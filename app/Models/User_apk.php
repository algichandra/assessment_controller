<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_apk extends Model
{
    use HasFactory;

    protected $fillable = [
        'pengguna_apk'
    ];

    public function apk()
    {
        return $this->hasMany(Apk::class);
    }
}
