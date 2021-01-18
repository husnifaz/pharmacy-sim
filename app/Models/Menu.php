<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menu';
    protected $primaryKey = 'id';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'icons',
        'url',
        'order',
        'parent_id'
    ];

    public function menuParent()
    {
        return $this->hasOne(self::class, 'id', 'parent_id');
    }

    public static function getListMenu()
    {
        return self::orderBy('order')
            ->whereNotNull('parent_id')->get();
    }

    public static function getListParentMenu()
    {
        return self::orderBy('order')
            ->whereNull('parent_id')->get();
    }
}
