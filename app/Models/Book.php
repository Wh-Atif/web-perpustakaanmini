<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'year',
        'stock',
        'category_id'
    ];

    public function borrowings()
    {
        return $this->HasMany(Borrowing::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
