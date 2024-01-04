<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Schema::hasTable('menus')) {
            $array = [
                ['id' => 1, 'name' => 'Pengaturan', 'url' => 'setting', 'icons' => 'fa-gear', 'order' => 1],
                ['id' => 2, 'name' => 'Menu', 'url' => 'menu', 'parent_id' => 1, 'icons' => '', 'order' => 1],
                ['id' => 3, 'name' => 'User', 'url' => 'user', 'parent_id' => 1, 'icons' => '', 'order' => 2],
                ['id' => 4, 'name' => 'Pegawai', 'url' => 'employee', 'icons' => 'fa-user', 'order' => 2],
                ['id' => 5, 'name' => 'Master', 'url' => 'master', 'icons' => 'fa-folder-o', 'order' => 3],
                ['id' => 6, 'name' => 'Satuan Obat', 'url' => 'medicine-unit', 'parent_id' => 5, 'icons' => '', 'order' => 1],
                ['id' => 7, 'name' => 'Aturan Pakai', 'url' => 'medicine-use', 'parent_id' => 5, 'icons' => '', 'order' => 2],
                ['id' => 8, 'name' => 'Obat', 'url' => 'item', 'icons' => '', 'parent_id' => 5, 'order' => 3],
                ['id' => 9, 'name' => 'Pembelian', 'url' => 'order', 'icons' => 'fa-truck', 'order' => 4],
                ['id' => 10, 'name' => 'Penjualan', 'url' => 'prescription', 'icons' => 'fa-shopping-cart', 'order' => 5],
                ['id' => 11, 'name' => 'Stok', 'url' => 'item-stock', 'icons' => 'fa-server', 'order' => 6],
            ];

            foreach ($array as $ar) {
                $model = Menu::find($ar['id']);
                if (!$model) {
                    $model = new Menu();
                    $model->fill($ar);
                    $model->save();
                }
            }
        }
    }
}
