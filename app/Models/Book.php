<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public function author(){
        return $this->belongsTo(Author::class);
    }

    public function categories(){
        return $this->hasMany(Category::class);
    }

    public function editions(){
        return $this->hasMany(Edition::class);
    }

    public function genre() {
        return $this->hasOne(Genre::class);
    }

    public function tags() {
        return $this->hasMany(Tag::class);
    }
}
