<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('produtos')->insert(['nome' => 'Luminária Batman vs. Superman', 'titulo' => 'Luminária Batman vs. Superman','descricao' => 'Abajur do Batman vs. Superman.<br>Tamanho 20x20cm, confecionado em MDF.<br>Utilizar somente lampada florescente ou LED.<br>Lâmpada não inclusa.<br><br>Prazo para postagem 5 dias úteis.','preco' => 90.00,'categoria_id' => 1,'marca_id' => 1,]);
        DB::table('produtos')->insert(['nome' => 'Quadro de Assinatura Corações', 'titulo' => 'Quadro de Assinatura Corações','descricao' => 'Quadro de Assinaturas com 200 corações.<br><br>Uma linda recordação da sua comemoração, seus convidados assinam o nome e colocam dentro do quadro.<br><br>Tamanho: 43,5x61,5cm (LarguraxAltura)<br><br>Confeccionado em MDF e PS Cristal','preco' => 180.00,'categoria_id' => 2,'marca_id' => 1,]);
        DB::table('produtos')->insert(['nome' => 'Torre Eifeel 60cm', 'titulo' => 'Torre Eifeel 60cm','descricao' => 'Torre Eifeel confeccionada em mdf cru 3mm, com altura de 60cm. Linda peça de decoração para a sua casa.','preco' => 55,'categoria_id' => 3,'marca_id' => 1,]);
    }
}
