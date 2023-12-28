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
        'med_unit_id',
        'status',
        'order_price'
    ];

    public function unitMedicine()
    {
        return $this->hasOne(UnitMedicines::class, 'id', 'med_unit_id');
    }

    protected $appends = [
        'status_label'
    ];

    public function listStatus()
    {
        return [
            1 => 'Aktif',
            0 => 'Non Aktif'
        ];
    }

    protected function getStatusLabelAttribute()
    {
        $listStatus = $this->listStatus();
        return (isset($this->status) ? $listStatus[$this->status] : '');
    }
}
