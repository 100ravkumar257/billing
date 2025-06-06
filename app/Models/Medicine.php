<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $fillable = [
        'name', 'category_id', 'price', 'stock', 'expiry_date', 'prescription_required'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

