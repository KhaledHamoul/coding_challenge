<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\Model;

use Log;
use Exception;

class Field extends Model {
    public $table = 'Field';

    public $fillable =
        [ 'name'
        , 'label'
        , 'fieldType'
        ];

    public function asCollection() {
        return collect($this->toArray());
    }


}

class FieldType {
    const BASIC   = 'BASIC';
    const FIXED   = 'FIXED';
    const FOREIGN = 'FOREIGN';
    const STATIK  = 'STATIC';
}