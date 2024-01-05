<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'generic',
        'price',
        'order_price',
        'medicine_unit_id',
        'status'
    ];

    public function medicineUnit()
    {
        return $this->hasOne(MedicineUnit::class, 'id', 'medicine_unit_id');
    }
}
