<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addresses extends Model
{
    use HasFactory;
    public function companies(){
        return $this->hasMany(Categories::class,'address_id');
    }

}
