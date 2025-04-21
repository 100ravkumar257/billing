<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model

{
    use HasFactory;
    protected $table = 'product_variants';


    protected $fillable = [
        'product_id',
        'sku',
        'size',
        'calculated_size',
        'pcs_per_pack',
        'layers_per_pack',
        'packing_weight',
        // 'box_weight',
        'box_qty',
    ];

    protected $casts = [
        'size' => 'integer',
        'calculated_size' => 'integer',
        'pcs_per_pack' => 'integer',
        'layers_per_pack' => 'integer',
        'packing_weight' => 'float',
        // 'box_weight' => 'float',
        'box_qty' => 'integer',
    ];


    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class);
    }


}
