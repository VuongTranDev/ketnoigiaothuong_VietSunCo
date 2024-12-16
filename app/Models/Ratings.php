<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ratings extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'numberstart',
        'company_id',
        'user_id',       
    ];
    public function company()
    {
        return $this->belongsTo(Companies::class, 'company_id');
    }



}
