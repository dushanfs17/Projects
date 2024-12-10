<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Partner extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_name',
        'industry_id',
        'logo',
        'collaboration_description',

    ];

    public $timestamps = true;

    public function industry()
    {
        return $this->belongsTo(Industry::class);
    }
}