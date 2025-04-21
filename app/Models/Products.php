<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    // Define the fields that are mass-assignable for products
    protected $fillable = [
        'name',
        'category_id',  
        'brand_id',
        'status', // other product-specific fields
    ];

    /**
     * Relationship with the ProductCategory model.
     * This defines the inverse of a "hasMany" relationship (products belong to categories).
     */
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id',''); 
    }


    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }


    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }


    public function packagingType()
    {
        return $this->belongsTo(PackagingType::class, 'packaging_type_id');
    }
}
