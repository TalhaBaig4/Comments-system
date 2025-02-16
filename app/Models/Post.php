<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // protected $table = 'post';

    protected $fillable = [
        'user_id', 'p_title', 'p_url', 'short_des', 'p_image', 'p_description', 'meta_title', 'meta_description'
    ];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
