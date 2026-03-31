<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name', 
        'color'
    ];

    // Relacionamento N:N inverso com Task
    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class);
    }
}