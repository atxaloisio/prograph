<?php

use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('marcas')->insert(['nome' => 'PROGRAPH']);        
    }
}
