<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineUses extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status'
    ];

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
