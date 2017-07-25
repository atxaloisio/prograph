<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Reliese\Database\Eloquent\Model as Eloquent;
use DB;
/**
 * 
 */
class BaseModel extends Eloquent {
    
    /**
     * 
     * @param type string $sql_stmt
     * @return type
     */
    public function selectQuery($sql_stmt) { return DB::select($sql_stmt); }
    
 
    public function sqlStatement($sql_stmt) { DB::statement($sql_stmt); }
}
