<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'product_categories';

    protected $fillable = ['name', 'slug', 'status', 'parent_category', 'image'];

    protected $dates = ['deleted_at'];

    public function parent()
    {
        return $this->belongsTo(ProductCategory::class, 'parent_category');
    }


    public function children()
    {
        return $this->hasMany(ProductCategory::class, 'parent_category');
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }


}
