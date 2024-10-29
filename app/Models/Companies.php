<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
    use HasFactory;
    protected $fillable = [
        "representative",
        "company_name",
        "short_name",
        "phone_number",
        "slug",
        "content",
        "rating_id",
        "link",
        "user_id",
        "created_at",
        "updated_at"
    ];
    public function companyCategory(){
        return $this->hasMany(CompanyCategory::class,'company_id');
    }
    public function address(){
        return $this->belongsTo(Addresses::class,'address_id','id');
    }
    public function companyImage(){
        return $this->hasMany(CompanyImage::class,'company_id');
    }
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function rating() {
        return $this->belongsTo(Ratings::class, 'rating_id', 'id');
    }
}
