<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Value extends Model {
    public $table = 'Value';

    public $fillable =
        [ 'field_id'
        , 'entity_id'
        , 'value'
        ];

    public function _field() {
        //TODO fill in the relation to the field
    }

    public function _entity() {
        //TODO fill in the relation to the entity
    }


}
