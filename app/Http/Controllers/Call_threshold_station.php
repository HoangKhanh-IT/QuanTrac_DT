<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Call_threshold_station extends Controller
{
    //
    function index()
    {
        $result = DB::select('SELECT 
                                "station"."id", "station"."name", 
                                "district"."name" "districtName",
                                "district"."id" "districtID",
                                "category"."name" "categoryName",
                                "category"."id" "categoryID",
                                /*** Ghép cột Name của bảng ObservationType cần có hàm distinct để trở nên duy nhất ***/
                                string_agg(distinct "obs_type"."name", \'; \') "obstype_namelist", 
                                concat(\'[\', string_agg(distinct "obs"."detail", \', \'), \']\') "total_detail"
                                                                    
                                FROM "Observationstation" "station"
                                LEFT JOIN "Category" "category" ON "category"."id" = "station"."categoryid"
                                LEFT JOIN "District" "district" ON "district"."id" = "station"."districtid"
                                LEFT JOIN "Obstype_Station" "obs_station" ON "obs_station"."stationid" = "station"."id"
                                LEFT JOIN "ObservationType" "obs_type" ON "obs_type"."id" = "obs_station"."obstypesid"
                                LEFT JOIN "Observation" "obs" ON "obs"."stationid" = "station"."id"
                                
                                WHERE "category"."id" = \'1\' OR "category"."id" = \'3\'
                                GROUP BY "station"."id", 
                                "category"."name", "category"."id", 
                                "district"."name", "district"."id"
                                ORDER BY "station"."name" ASC');
        $jsonData = json_encode($result);
        $original_data = json_decode($jsonData, true);
        $option = array();
        foreach ($original_data as $key => $value) {
            $option[] = array(
                'id' => $value['id'],
                'name' => $value['name'],
                'districtID' => $value['districtID'],
                'districtName' => $value['districtName'],
                'categoryID' => $value['categoryID'],
                'categoryName' => $value['categoryName'],
                'obstype_namelist' => $value['obstype_namelist'],
                'total_detail' => json_decode($value['total_detail'])
            );
        }

        /*** Để Dom dữ liệu vào Danh sách vượt ngưỡng ***/
        $option_final = array(
            'data' => $option
        );

        $final_data = json_encode($option_final);
        return $final_data;
    }
}
