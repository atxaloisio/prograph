<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 18 Jul 2017 01:19:54 -0300.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class ProdutoImagem
 * 
 * @property int $id
 * @property int $produto_id
 * @property string $imagem_path
 * @property string $imagemzoom_path
 * 
 * @property \App\Produto $produto
 *
 * @package App
 */
class ProdutoImagem extends Eloquent
{
        protected $primaryKey = 'id';        
	protected $table = 'produto_imagem';
	public $timestamps = false;

	protected $casts = [
		'produto_id' => 'int'
	];

	protected $fillable = [
		'produto_id',
		'imagem_path',
		'imagemzoom_path'
	];

	public function produto()
	{
		return $this->belongsTo(\App\Produto::class);
	}
}
