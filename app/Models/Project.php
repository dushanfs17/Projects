<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use function Pest\Laravel\assertDatabaseHas;

class Project extends Model
{
    use HasFactory;

    // Fields that can be mass-assigned
    protected $fillable = [
        'name',
        'description',
        'due_date',
    ];

    // Cast due_date to a Carbon instance
    protected $casts = [
        'due_date' => 'date',
    ];

    // Relationship: A project has many tasks
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
