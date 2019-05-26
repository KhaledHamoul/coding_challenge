<?php

namespace App\Exports;

use App\Models\Field;
use App\Models\Value;
use Maatwebsite\Excel\Concerns\FromArray;

class EntityExport implements  FromArray
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array(): array
    {
        $data = [[]];
        $fields = Field::all();
        foreach($fields as $field){
            array_push($data[0],$field->name);
            $values = Value::where('field_id',$field->id)->get()->toArray();
            
            for( $i = 0; $i < count($values); $i++) 
            {
                try {
                    array_push($data[$i+1],$values[$i]['value']);
                } catch (\Throwable $th) {
                    $data[$i+1] = [];
                    array_push($data[$i+1],$values[$i]['value']);
                }
            }
        }
        
        return $data;
    }
}
