<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'isbn',
        'summary',
        'publish_date',
        'author_id',
    ];

    public function author(){
        return $this->belongsTo(Author::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function edition(){
        return $this->belongsTo(Edition::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }
}
