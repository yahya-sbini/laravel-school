<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class LessonImport  implements ToModel
{
    public function model(array $row)
    {
        return $row;
    }
}
