<?php

namespace App\Imports;

use App\Models\Entity;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class EntityImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        for( $i = 1; $i < count($rows); $i++) 
        {
            $attributes = [
                'entityType' => 'SUBJECT'
            ];

            for( $j = 0; $j < count($rows[0]); $j++) 
            {
                $attributes[ $rows[0][$j]  ] = $rows[$i][$j];
            }

            Entity::create($attributes);
        }
    }
}
