<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 18 Jul 2017 01:19:23 -0300.
 */

namespace App;

use App\BaseModel as Eloquent;

/**
 * Class Marca
 * 
 * @property int $id
 * @property string $nome
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App
 */
class Marca extends Eloquent {

    protected $primaryKey = 'id';
    protected $table = 'marcas';
    protected $fillable = [
        'nome'
    ];

}
