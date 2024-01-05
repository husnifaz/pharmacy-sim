<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemStock extends Model
{
    use HasFactory;

    const STATUS_ACTIVE = 1;
    const STATUS_PULL = 3;
    const STATUS_DESTROY = 4;

    protected $fillable = [
        'item_id',
        'quantity',
        'expired_date',
        'batch_number',
        'status',
        'remarks'
    ];

    protected $appends = [
        'status_label'
    ];

    public function item()
    {
        return $this->hasOne(Items::class, 'id', 'item_id');
    }

    public static function statusList()
    {
        return [
            self::STATUS_PULL => 'Ditarik',
            self::STATUS_DESTROY => 'Dihancurkan',
        ];
    }

    public static function statusListAll()
    {
        return [
            self::STATUS_ACTIVE => 'Aktif',
            self::STATUS_PULL => 'Ditarik',
            self::STATUS_DESTROY => 'Dihancurkan',
        ];
    }

    public function getStatusLabelAttribute()
    {
        return (isset($this->attributes['status']) ? $this->statusListAll()[$this->attributes['status']] : $this->attributes['status']);
    }
}
