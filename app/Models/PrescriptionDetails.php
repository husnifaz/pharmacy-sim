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
        'quantity',
        'price',
        'total',
        'remarks',
        'expired_date',
        'batch_number',
        'item_stock_id'
    ];

    protected function item()
    {
        return $this->hasOne(Items::class, 'id', 'item_id');
    }
}
