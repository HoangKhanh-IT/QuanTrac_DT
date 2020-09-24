<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Call_discharge_point extends Controller
{
    //
    function index()
    {
        $select_discharge = 'SELECT
                                "discharge".*, "enterprise"."name" "enterpriseName",
                                "standard"."symbol" "standardSymbol", "basin"."name" "basinName", ';

        $select_discharge .= 'ST_AsText(ST_Transform(ST_GeomFromText(concat(\'POINT(\',
                                "discharge"."coordx", \' \', "discharge"."coordy", \')\'), 9209), 4326)) AS LatLng ';

        $select_discharge .= 'FROM "Dischargepoint" "discharge"
                                LEFT JOIN "Enterprise" "enterprise" ON "discharge"."enterpriseid" = "enterprise"."id"
                                LEFT JOIN "Standard" "standard" ON "discharge"."standardid" = "standard"."id"
                                LEFT JOIN "Basin" "basin" ON "discharge"."basinid" = "basin"."id"';
        $result = DB::select($select_discharge);
        $jsonData = json_encode($result);
        $original_data = json_decode($jsonData, true);
        $features = array();
        foreach ($original_data as $key => $value) {
            $features[] = array(
                'type' => 'Feature',
                'properties' => array(
                    'id' => $value['id'],
                    'enterpriseName' => $value['enterpriseName'],
                    'decisionnumber' => $value['decisionnumber'],
                    'licensedate' => $value['licensedate'],
                    'period' => $value['period'],
                    'establishmentname' => $value['establishmentname'],
                    'location' => $value['location'],
                    'operatingtime	' => $value['operatingtime'],
                    'dischargemethod' => $value['dischargemethod'],
                    'flowrate' => $value['flowrate'],
                    'standardid' => $value['standardid'],
                    'standardSymbol' => $value['standardSymbol'],
                    'sourcereception' => $value['sourcereception'],
                    'establishmentname' => $value['establishmentname'],
                    'basinid' => $value['basinid'],
                    'basinName' => $value['basinName'],
                    'licensetype' => $value['licensetype'],
                    'licenseterm' => $value['licenseterm'],
                    'note' => $value['note']
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
