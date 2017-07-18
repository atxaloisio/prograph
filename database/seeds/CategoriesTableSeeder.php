<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias')->insert(['nome' => 'LUMINARIAS']);
        DB::table('categorias')->insert(['nome' => 'DECORAÇÃO DE FESTAS']);
        DB::table('categorias')->insert(['nome' => 'DECORAÇÃO']);
        DB::table('categorias')->insert(['nome' => 'LEMBRANCINHAS']);
        DB::table('categorias')->insert(['nome' => 'PRESENTES']);
    }
}
