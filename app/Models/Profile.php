<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;


use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'bio', 
        'phone', 
        'avatar_url'
    ];

    // Relacionamento inverso do 1:1
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}