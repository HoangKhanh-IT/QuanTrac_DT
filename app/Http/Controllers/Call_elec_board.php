<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Call_elec_board extends Controller
{
    //
    function index()
    {
        $result = DB::select('SELECT
                                "elecBoard"."id", "elecBoard"."name",
                                "elecBoard"."coordx", "elecBoard"."coordy",
                                "station"."name" "stationName"
                                    
                            FROM "ElectronicBoard" "elecBoard"
                            LEFT JOIN "Observationstation" "station" ON "station"."id" = "elecBoard"."stationid"
                                    
                            ORDER BY "elecBoard"."name" ASC');
        $jsonData = json_encode($result);
        $original_data = json_decode($jsonData, true);
        $features = array();
        foreach ($original_data as $key => $value) {
            $features[] = array(
                'type' => 'Feature',
                'properties' => array(
                    'id' => $value['id'],
                    'name' => $value['name'],
                    'stationName' => $value['stationName']
                ),
                'geometry' => array(
                    'type' => 'Point',
                    'coordinates' => array(
                        floatval($value['coordx']),
                        floatval($value['coordy'])
                    ),
                ),
            );
        }
        $new_data = array(
            'type' => 'FeatureCollection',
            'features' => $features,
        );

        $final_data = json_encode($new_data);
        return $final_data;
    }
}
