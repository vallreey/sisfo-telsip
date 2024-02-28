<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'birthdate',
        'address',
        'phone_number',
    ];

    // atau gunakan guarded jika Anda ingin melarang semua properti
    // yang tidak ada dalam fillable
    // protected $guarded = [];
}
