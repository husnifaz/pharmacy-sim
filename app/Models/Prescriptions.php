<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescriptions extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'status',
        'remarks',
        'order_date',
        'paid_at'
    ];

    protected $appends = [
        'status_label',
        'status_bg'
    ];

    public function listStatus()
    {
        return [
            0 => 'Gagal',
            1 => 'Draf',
            2 => 'Belum Bayar',
            3 => 'Sudah Dibayar',
        ];
    }

    public function listBg()
    {
        return [
            0 => 'bg-red',
            1 => 'bg-blue',
            2 => 'bg-yellow',
            3 => 'bg-green',
        ];
    }

    protected function getStatusLabelAttribute()
    {
        $listStatus = $this->listStatus();
        return (isset($this->status) ? $listStatus[$this->status] : '');
    }

    protected function getStatusBgAttribute()
    {
        $listStatus = $this->listBg();
        return (isset($this->status) ? $listStatus[$this->status] : '');
    }

    public static function generateNumber()
    {
        $prefix = 'PRE/'.\Carbon\Carbon::now()->format('ymd');
        $number = self::select('number')
            ->where('created_at', \Carbon\Carbon::now()->toDateString())
            ->first();

        if ($number) {
            $inc = substr($number, -4);
            $newinc = (int) $inc + 1;
            $newinc = str_pad($newinc, 4, '0', STR_PAD_LEFT);
        } else {
            $newinc = '0001';
        }

        return "$prefix/$newinc";
    }
}
