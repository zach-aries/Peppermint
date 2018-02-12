<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // If you change the amount generated make sure that the employees factory generator
        // matches this number.
        // See documentation on ModelFactory/Employees
        factory(App\Admin::class, 2)->create();
    }
}
