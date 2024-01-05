<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $primaryKey = 'id';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'menu_id',
        'user_id',
    ];

    public function menu()
    {
        return $this->hasOne('\App\Models\Menu', 'id', 'menu_id');
    }

    public static function getListPermission()
    {
        $userId = auth()->user()->id;
        $modelRole = self::where('user_id', $userId)
            ->with('menu')->get();

        $modelRole->map(function($query) {
            $query['url'] = $query->menu->url.'*';
        });

        return $modelRole->pluck('url')->toArray();
    }
}
