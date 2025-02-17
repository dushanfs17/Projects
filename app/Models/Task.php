<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    // Fields that can be mass-assigned
    protected $fillable = [
        'project_id',
        'category_id',
        'title',
        'description',
        'status',
        'due_date',
    ];

    // Cast due_date to a Carbon instance
    protected $casts = [
        'due_date' => 'date',
    ];

    // Relationship: A task belongs to a project
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    // Relationship: A task belongs to a category
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
