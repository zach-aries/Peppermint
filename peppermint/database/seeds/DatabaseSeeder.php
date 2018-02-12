<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // call seeder classes in this format:
        // $this->call(SeederName::class);


        // must create roles classes to use application
        $this->call('RolesTableSeeder');

        // fills database with dummy entities
        //$this->call(AdminsTableSeeder::class);
        $this->call(EmployeesTableSeeder::class);
        //$this->call('SuppliesTableSeeder');
    }
}

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

class SuppliesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Supplies::class, 10)->create();
    }
}
