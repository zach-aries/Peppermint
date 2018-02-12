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
        factory(App\Role::class)->create(['name' => 'sysadmin']);
        factory(App\Role::class)->create(['name' => 'admin']);
        factory(App\Role::class)->create(['name' => 'employee']);
    }
}
