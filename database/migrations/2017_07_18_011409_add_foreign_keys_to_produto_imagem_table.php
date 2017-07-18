<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToProdutoImagemTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('produto_imagem', function(Blueprint $table)
		{
			$table->foreign('produto_id', 'fk_produto_imagem_produto')->references('id')->on('produtos')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('produto_imagem', function(Blueprint $table)
		{
			$table->dropForeign('fk_produto_imagem_produto');
		});
	}

}
