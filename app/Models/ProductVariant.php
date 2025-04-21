<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'sku',
        'size',
        'calculated_size',
        'pcs_per_pack',
        'layers_per_pack',
        'packing_weight',
        'box_qty',
        'price', 
        'status',
    ];
 



    public function product()
    {
        return $this->belongsTo(Product::class);
    }


}
