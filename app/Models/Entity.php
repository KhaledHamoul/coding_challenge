<?php

namespace App\Models;
use Validator;
use Illuminate\Database\Eloquent\Model;
use App\Models\Field;
use App\Models\Entity;
use App\Models\Value;
use App\Common;

use DB;
use Log;

//TODO complete this class
class Entity extends Model {
    public $table = 'Entity';
    public $timestamps = true;

    public $fillable = [ 'fieldType' ];

    public function asCollection() {
        return collect($this->toArray());
    }

    public function _values() {
        //TODO return the relation to values table
    }

    /**
     * Creates the entitiy and all linked values
     */
    public static function create(array $attributes)
    {
        //TODO
        $entity = new Entity;
        $entity->fieldType = $attributes["entityType"];
        $entity->save();
        
        foreach ( $attributes as $key => $value ){
            $field = Field::where('name', $key)->first();
            if ($field){
                Value::create([ 
                    'field_id' => $field->id, 
                    'entity_id' => $entity->id, 
                    'value' => $value
                ]);
            }
        }
        return $entity;

    }
 
}