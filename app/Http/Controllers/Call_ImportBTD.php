<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\BTD_Import;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class Call_ImportBTD extends Controller
{
    //
    public function import()
    {
        $data = Excel::import(new BTD_Import, request()->file('select_file'));
        if ($data->count() > 0) {
            foreach ($data->toArray() as $key => $value) {
                foreach ($value as $row) {
                    $insert_data[] = array(
                        'id' => $row['id'],
                        'symbol' => $row['symbol'],
                        'stationid' => $row['stationid'],
                        'time' => $row['time'],
                        'dateOfSamping' => $row['dateOfSamping'],
                        'samplingLocations' => $row['samplingLocations'],
                        'weather' => $row['weather'],
                    );
                }
            }

            if (!empty($insert_data)) {
                DB::table('Sample_BanTuDong')->insert($insert_data);
            }
        }
        return redirect('/')->with('success', 'All good!');
    }
}
