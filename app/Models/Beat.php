<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beat extends Model
{
    use HasFactory;

    protected $fillable=
    [
        'id',
        'slug',
        'title',
        'premium_file',
        'free_file',
        'user_id',
    ];

    public function likes()
    {
        return $this->morphOne(Like::class, 'likeable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
