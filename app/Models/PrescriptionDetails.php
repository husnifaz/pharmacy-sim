<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrescriptionDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'prescription_id',
        'medicine_uses_id',
        'qty',
        'price',
        'total',
        'remarks',
        'item_stock_id'
    ];

    protected function item()
    {
        return $this->hasOne(Items::class, 'id', 'item_id');
    }
}
