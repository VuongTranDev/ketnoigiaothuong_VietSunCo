<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    public function categorie(){
        return $this->belongsTo(Categories::class,'cate_id', 'id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id', 'id');
    }
    public function comments(){
        return $this->hasMany(Comments::class,'new_id');
    }
}
