<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function category(){
        return $this->belongsTo(Category::class);           // defines the relationship
    }

    public function author(){
        return $this->belongsTo(Post::class,'user_id');           // defines the relationship
    }
}
