<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opd extends Model
{
    use HasFactory;

    protected $fillable = [
        'opd', 'alamat', 'telp', 'email', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function apk()
    {
        return $this->belongsTo(Apk::class);
    }
}
