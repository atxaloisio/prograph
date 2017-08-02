<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 18 Jul 2017 01:19:34 -0300.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class Produto
 * 
 * @property int $id
 * @property string $nome
 * @property string $titulo
 * @property string $descricao
 * @property int $preco
 * @property int $categoria_id
 * @property int $marca_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $produto_imagems
 *
 * @package App
 */
class Produto extends Eloquent
{
        protected $primaryKey = 'id';
        protected $table = 'produtos';
	protected $casts = [
		'preco' => 'decimal',
		'categoria_id' => 'int',
		'marca_id' => 'int',
                'imagem_id' => 'int'
	];

	protected $fillable = [
		'nome',
		'titulo',
		'descricao',
		'preco',
		'categoria_id',
		'marca_id',
                'imagem_id'
	];

	public function produto_imagems()
	{
		return $this->hasMany(\App\ProdutoImagem::class);
	}
}
