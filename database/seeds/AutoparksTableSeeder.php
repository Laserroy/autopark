<?php

use Illuminate\Database\Seeder;

class AutoparksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Autopark::class, 15)->create();
    }
}
