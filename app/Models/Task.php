<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'project_id', 
        'title', 
        'description', 
        'status', 
        'priority', 
        'due_date'
    ];

    protected $casts = [
        'due_date' => 'date',
    ];

    // Relacionamento inverso 1:N com Project
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    // Relacionamento N:N com Tag
    public function tags(): BelongsToMany
    {
        // O Laravel é inteligente e já vai procurar a tabela pivot 'tag_task' automaticamente
        return $this->belongsToMany(Tag::class);
    }
}