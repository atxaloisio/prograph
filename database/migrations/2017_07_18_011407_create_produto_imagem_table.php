<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProdutoImagemTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('produto_imagem', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned()->comment('identificador unico');
			$table->bigInteger('produto_id')->unsigned()->index('fk_produto_imagem_produto')->comment('id do produto');
			$table->string('imagem_path', 512)->nullable()->comment('caminho da imagem');
			$table->string('imagemzoom_path', 512)->nullable()->comment('cminho imagem zoom');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('produto_imagem');
	}

}
