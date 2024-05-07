<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hosting_sub_domain extends Model
{
    use HasFactory;

    protected $fillable = [
        'collocation_server', 'hosting',
        'sub_domain', 'nama_subdomain',
        'cttan_collock_server', 'cttan_hosting',
        'cttan_sub_domain', 'assessment_id'
    ];

    public function assessment()
    {
        return $this->belongsTo(Assessment::class);
    }
}
