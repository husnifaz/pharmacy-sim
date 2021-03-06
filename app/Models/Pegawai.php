<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';
    protected $primaryKey = 'id';

    const GENDER_MAN = 1;
    const GENDER_WOMAN = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nik',
        'nama',
        'gender',
        'alamat',
        // 'tgl_lahir',
        'no_telp',
        'image_url'
    ];

    public $appends = [
        'gender_label'
    ];

    private static function getGender()
    {
        return [
            self::GENDER_MAN => 'Laki-laki',
            self::GENDER_WOMAN => 'Perempuan'
        ];
    }

    public function getGenderLabelAttribute()
    {
        if (!isset($this->attributes['gender'])) return null;
        return self::getGender()[$this->attributes['gender']];
    }
}
