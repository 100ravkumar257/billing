<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'products';

    // Define the fields that are mass-assignable
    protected $fillable = [
        'category_id',  
        'brand_id', 
        'name',
        'slug',
        'short_desc', 
        'density', 
        'images', // If handling multiple images as JSON or single image
        'status',
    ];

    /**
     * Relationship with the ProductCategory model.
     * A product belongs to a category.
     */
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');  // Corrected foreign key
    }

    /**
     * Relationship with the Brand model.
     * A product belongs to one brand.
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function variants()
    {
        return $this->hasMany(Variant::class);
    }
    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class);
    }

}
