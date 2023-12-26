<?php

namespace App\Models;

use App\Http\Controllers\ItemController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_order_id',
        'item_id',
        'price',
        'qty',
        'expired_date',
        'batch_number',
        'total'
    ];

    public function item()
    {
        return $this->hasOne(Items::class, 'id', 'item_id');
    }
}
