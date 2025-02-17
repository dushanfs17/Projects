<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    // Fields that can be mass-assigned
    protected $fillable = [
        'name',
    ];

    // Relationship: A category has many tasks
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
