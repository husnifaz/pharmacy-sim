<?php

namespace App\Models;

use App\Http\Controllers\ItemController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'price',
        'qty',
    ];

    public function item()
    {
        return $this->hasOne(ItemController::class, 'id', 'item_id');
    }
}
