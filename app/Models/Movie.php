<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image', 'view', 'category_id'];

    public function category(): belongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }


}
