<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;

    const GENDER_MAN = 1;
    const GENDER_WOMAN = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nik',
        'name',
        'gender',
        'address',
        'dob',
        'phone_number',
        'image_url',
        'status'
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
