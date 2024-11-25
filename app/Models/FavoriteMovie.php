<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FavoriteMovie extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'movie_id'];

    public function movie(): belongsTo
    {
        return $this->belongsTo(Movie::class, 'movie_id');
    }
}
