<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'qty',
        'expired_date',
        'batch_number'
    ];

    public function item()
    {
        return $this->hasOne(Items::class, 'id', 'item_id');
    }
}
