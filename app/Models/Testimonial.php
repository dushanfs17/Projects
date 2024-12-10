<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'testimonial_text',
        'client_name',
        'client_position',
        'client_company',
        'client_profile_picture',
    ];
}
