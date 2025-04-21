<?php


namespace App\Models\Frontend\Retailer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    
    protected $table = 'product_categories'; 

    
    protected $fillable = ['id', 'name', 'slug'];

   
    public $timestamps = true; 
    
}
