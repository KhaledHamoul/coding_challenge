<?php

namespace App\Models;
use Validator;
use Illuminate\Database\Eloquent\Model;
use App\Models\Field;
use App\Common;

use DB;
use Log;

class Entity extends Model {
    public $table = 'Entity';

    public function _values() {
        //TODO return the relation to values table
    }

    /**
     * Creates the entitiy and all linked values
     */
    public static function create(array $attributes)
    {
        //TODO
    }
 
}