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
        return $this->belongsTo('App\Models\Field', 'field_id');
    }

    public function _entity() {
        //TODO fill in the relation to the entity
        return $this->belongsTo('App\Models\Entity', 'entity_id');
    }


}
