<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Graduate extends Model
{
    /** @use HasFactory<\Database\Factories\GraduateFactory> */
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
