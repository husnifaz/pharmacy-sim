<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'distributor',
        'status',
        'order_date',
        'created_by'
    ];

    protected $appends = [
        'status_label'
    ];

    public function listStatus()
    {
        return [
            0 => 'Gagal',
            1 => 'Draf',
            2 => 'Selesai',
        ];
    }

    protected function getStatusLabelAttribute()
    {
        $listStatus = $this->listStatus();
        return (isset($this->status) ? $listStatus[$this->status] : '');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function purchaseOrderDetails()
    {
        return $this->hasMany(PurchaseOrderDetail::class, 'purchase_order_id', 'id');
    }

    protected function getCreatedByAttribute()
    {
        $user = User::find($this->attributes['created_by'])->first();
        if ($user) {
            return $user->name;
        }
    }
}
