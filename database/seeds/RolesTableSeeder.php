<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $rol = \Spatie\Permission\Models\Role::create([
            'name' => 'admin',
        ]);
        $rol->syncPermissions(['list', 'create', 'edit', 'delete']);

        $roles = [
            'supervisor',
            'user'
        ];
        foreach ($roles as $role) {

            \Spatie\Permission\Models\Role::create([
                'name' => $role,
            ]);
        }
    }
}
