<?php

namespace App\Imports;

use App\BTD;
use Maatwebsite\Excel\Concerns\ToModel;

class BTD_Import implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new BTD([
            //
            'id' => $row[0],
            'symbol' => $row[1],
            'stationid' => $row[2],
            'time' => $row[3],
            'dateOfSamping' => $row[4],
            'samplingLocations' => $row[5],
            'weather' => $row[6],
        ]);
    }
}
