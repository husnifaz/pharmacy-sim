<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menu';
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

    public static function getListMenu($user)
    {
        if ($user->role_admin) {
            $modelParent = self::orderBy('order')->whereNull('parent_id')->get();
            $modelParent->map(function($query) {
                $query['child'] = self::orderBy('order')->where('parent_id', $query->id)->get();
            });
        } else {
            $getMenuRole = Role::where('user_id', $user->user_id)->pluck('menu_id')->unique();
            $modelMenu = self::whereIn('id', $getMenuRole)->get();
            $parents = self::whereIn('id', $modelMenu->pluck('parent_id')->unique())->get();

            $modelParent = [];
            foreach ($parents as $parent) {
                $parent['child'] = $modelMenu->where('parent_id', $parent['id']);

                $modelParent[] = $parent;
            }
        }

        return $modelParent;
    }

    public static function getListParentMenu()
    {
        return self::orderBy('order')->whereNull('parent_id')->distinct('parent_id')->get();
    }
}
