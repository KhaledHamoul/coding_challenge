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
    public $timestamps = false;

    public $fillable = [ 'entityType' ];

    public function asCollection() {
        return collect($this->toArray());
    }

    public function _values() {
        //TODO return the relation to values table
        return $this->hasMany('App\Models\Value', 'entity_id');
    }

    /**
     * Creates the entitiy and all linked values
     */
    public static function create(array $attributes)
    {
        //TODO
        $entity = new Entity;
        $entity->entityType = $attributes["entityType"];
        $entity->timestamps = now();
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

    /**
     * Return the entity with all its linked values
     */
    public function includeValues()
    {
        $this->with('_values._field:id,name');
        $entity = [
            'id' => $this->id,
            'entityType' => $this->entityType,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
        foreach ($this->_values as $_value) $entity[$_value->_field->name] = $_value->value;
        
        return $entity;
    }
 
}