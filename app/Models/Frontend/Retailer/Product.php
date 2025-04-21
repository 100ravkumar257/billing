<?php

namespace App\Models\Frontend\Retailer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Frontend\Retailer\ProductCategory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'short_desc','category_id', 'brand_id','density', 'image' ];

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }  

public function category()
{
    return $this->belongsTo(ProductCategory::class, 'category_id', 'id');
}


}
