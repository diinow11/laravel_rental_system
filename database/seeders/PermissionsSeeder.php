<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        $models = ['apartment', 'houseunit', 'tenant', 'invoice'];
        $actions = ['create', 'view', 'edit', 'delete'];

        foreach ($models as $model) {
            foreach ($actions as $action) {
                Permission::firstOrCreate(['name' => "$model.$action"]);
            }
        }
    }
}
