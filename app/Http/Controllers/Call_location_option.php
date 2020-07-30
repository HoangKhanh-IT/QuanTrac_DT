<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Call_location_option extends Controller
{
    //
    function index()
    {
        $result = DB::select('SELECT "Location".*, "loctype"."name" "locationTypeName"
                                FROM "Location"
                                LEFT JOIN "LocationType" "loctype" on "loctype"."id" = "Location"."locationtypeid"');
        $jsonData = json_encode($result);
        $original_data = json_decode($jsonData, true);
        $option = array();
        foreach ($original_data as $key => $value) {
            $option[] = array(
                'id' => $value['id'],
                'name' => $value['name'],
                'locationTypeName' => $value['locationTypeName'],
                'locationTypeID' => $value['locationtypeid']
            );
        }

        $final_data = json_encode($option);
        return $final_data;
    }
}
