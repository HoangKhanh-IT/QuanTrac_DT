<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Call_standard_param extends Controller
{
    //
    function index()
    {
        $result = DB::select('SELECT "standParam".*,
                                "unit".name "UnitName",
                                "param".name "paramName",
                                "param".code "paramCode",
                                "purpose".name "purposeName",
                                "stand".name "standName"

                                FROM "StandardParameter" "standParam"
                                LEFT JOIN "Unit" "unit" ON "unit".id = "standParam"."unitid"
                                LEFT JOIN "Purpose" "purpose" ON "purpose".id = "standParam"."purposeid"
                                LEFT JOIN "Standard" "stand" ON "stand".id = "standParam"."standardid"
                                LEFT JOIN "Parameter" "param" ON "param".id = "standParam"."parameterid"');
        $jsonData = json_encode($result);
        $original_data = json_decode($jsonData, true);
        $option = array();
        foreach ($original_data as $key => $value) {
            $option[] = array(
                'id' => $value['id'],
                'standardID' => $value['standardid'],
                'standardName' => $value['standName'],
                'parameterid' => $value['parameterid'],
                'parameterCode' => $value['paramCode'],
                'parameterName' => $value['paramName'],
                'unitid' => $value['unitid'],
                'unitName' => $value['UnitName'],
                'purposeid' => $value['purposeid'],
                'purposeName' => $value['purposeName'],
                'min_value' => $value['minvalue'],
                'max_value' => $value['maxvalue'],
                'analysismethod' => $value['analysismethod']
        );
    }

    $final_data = json_encode($option);
        return $final_data;
    }
}
