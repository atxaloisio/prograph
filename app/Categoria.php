<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 18 Jul 2017 01:18:54 -0300.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class Categoria
 * 
 * @property int $id
 * @property string $nome
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App
 */
class Categoria extends Eloquent
{
    protected $primaryKey = 'id';
    protected $table = 'categorias';
    protected $fillable = [
		'nome'
	];
}
