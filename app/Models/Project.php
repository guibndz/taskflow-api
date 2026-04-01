<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'name', 
        'description', 
        'status', 
        'deadline'
    ];

    // Transforma a string do banco em um objeto de data no PHP
    protected $casts = [
        'deadline' => 'date',
    ];

    // Relacionamento inverso 1:N com User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relacionamento 1:N com Task
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}