<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 */
class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    protected $casts = [
        'view' => 'integer',
        'image' => 'string', // If you store URLs, ensure it's a string
    ];

    public function movies(): HasMany
    {
        return $this->hasMany(Movie::class);
    }

    public function getMoviesCountAttribute(): int
    {
        return $this->movies()->count();
    }
}
