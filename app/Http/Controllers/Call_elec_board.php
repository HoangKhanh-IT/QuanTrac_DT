<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Call_elec_board extends Controller
{
    //
    function index()
    {
        $select_electricBoard = 'SELECT
                                "elecBoard"."id", "elecBoard"."name",
                                "elecBoard"."coordx", "elecBoard"."coordy", "elecBoard"."note", 
                                "station"."name" "stationName", 
                                concat(\'[\', string_agg(distinct "obs"."detail", \', \'), \']\') "total_detail", ';

        $select_electricBoard .= 'ST_AsText(ST_Transform(ST_GeomFromText(concat(\'POINT(\',
                                "elecBoard"."coordx", \' \', "elecBoard"."coordy", \')\'), 9209), 4326)) AS LatLng ';
                                    
        $select_electricBoard .= 'FROM "ElectronicBoard" "elecBoard"
                                LEFT JOIN "Observationstation" "station" ON "station"."id" = "elecBoard"."stationid"
                                LEFT JOIN "Observation" "obs" ON "obs"."stationid" = "station"."id"
                                GROUP BY "elecBoard"."id", "elecBoard"."name",
                                "elecBoard"."coordx", "elecBoard"."coordy", 
                                "elecBoard"."note", "station"."name"
                                ORDER BY "elecBoard"."name" ASC';

        $result = DB::select($select_electricBoard);
        $jsonData = json_encode($result);
        $original_data = json_decode($jsonData, true);
        $features = array();
        foreach ($original_data as $key => $value) {
            $features[] = array(
                'type' => 'Feature',
                'properties' => array(
                    'id' => $value['id'],
                    'name' => $value['name'],
                    'stationName' => $value['stationName'],
                    'note' => $value['note'],
                    'total_detail' => json_decode($value['total_detail'])
                ),
                'geometry' => array(
                    'type' => 'Point',
                    'coordinates' => array(
                        /*** Cắt chuỗi POINT để lấy tọa độ ***/
                        floatval(explode("POINT(",explode(" ", $value['latlng'])[0])[1]),
                        floatval(explode(" ", $value['latlng'])[1])
                        /* floatval($value['coordx']),
                        floatval($value['coordy']) */
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
