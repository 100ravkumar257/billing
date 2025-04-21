<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_Management extends Model
{
    use HasFactory;
    
    protected $table = 'order'; 

   
    protected $fillable = [
        'retailer_id', 'order_code', 'order_date', 'order_status', 
        'status', 'remarks', 'ip', 'indate', 'created_by', 'updated', 
        'updated_by', 'approver_id', 'approved_status', 'approver_lavel'
    ];


 
    // Disable timestamps if your table doesn't have created_at and updated_at columns
    public $timestamps = false;

    // Define relationships if needed
    // public function retailer()
    // {
    //     return $this->belongsTo(Retailer::class);
    // }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approver_id');  
    }
}
