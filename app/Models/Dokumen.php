<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dokumen extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_dok', 'dok', 'assessment_id'
    ];

    public function assessment()
    {
        return $this->belongsTo(Assessment::class);
    }

    protected function dok(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => asset('/storage/assessment/dokumen/' . $value),
        );
    }
}
