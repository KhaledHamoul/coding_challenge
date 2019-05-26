<?php

namespace App\Exports;

use App\Models\Entity;
use Maatwebsite\Excel\Concerns\FromArray;

class EntityExport implements  FromArray
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array(): array
    {
        return [ 
            ['subj_age','subj_name'],
            ['30','med']
        ];
    }
}
