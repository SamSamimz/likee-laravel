<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Like extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function post():BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

}
