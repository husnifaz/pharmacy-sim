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
        'order_date'
    ];

    protected $appends = [
        'status_label'
    ];

    public function listStatus()
    {
        return [
            0 => 'Gagal',
            1 => 'Selesai',
        ];
    }

    protected function getStatusLabelAttribute()
    {
        $listStatus = $this->listStatus();
        return (isset($this->status) ? $listStatus[$this->status] : '');
    }
}
