<?php

use Illuminate\Database\Seeder;

class BridgesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Bridge::class, 3)->create();
    }
}
