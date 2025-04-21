<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;

    protected $table = 'order_item'; // Specify the table name if not default

    protected $fillable = [
        'order_id',
        'product_id',
        'variant_id',
        'quantity',
        'indate',
        'status',
        'updated_by',
        'confirm_date'
    ];

    protected $dates = ['indate', 'confirm_date', 'updated'];

    // Define relationships

public function product()
{
    return $this->belongsTo(Product::class, 'product_id', 'id');
}

public function variant()
{
    return $this->belongsTo(Variant::class, 'variant_id', 'id');
}

}
