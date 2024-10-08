<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Novel extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'author',
        'synopsis', 
        'published_at',
        'user_id'
    ];


    protected $casts = [
        'published_at' => 'datetime', 
    ];

    
    // Relationship: A novel belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }  
}
