<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Call_WQIAQI_result extends Controller
{
    //
    function index()
    {
        $loaihinh = $_GET['loaihinh_WA'];
        $loaitram = $_GET['loaitram_WA'];
        $quanhuyen = $_GET['district_WA'];
        $fromDate_WA = date($_GET['fromDate_WA']);
        $toDate_WA = date($_GET['toDate_WA']);

        /***  Querry Result WQI/AQI ***/
        $querry_select = 'SELECT "station"."id", "station"."code", "station"."name",
                            "obs"."day", "obs"."value", "district"."name" "districtName",
                            "district"."id" "districtID",
                            "quality"."id" "qualityID", "quality"."purpose" "qualityPurpose",
                            "quality"."colorcode" "qualityColorcode"
                            FROM "Observation" "obs"
                            LEFT JOIN "Observationstation" "station" ON "obs"."stationid" = "station"."id"
                            LEFT JOIN "Qualityindex" "quality" ON "obs"."qualityindexid" = "quality"."id"
                            LEFT JOIN "Category" "category" ON "category"."id" = "station"."categoryid"
                            LEFT JOIN "ObstypeStation" "obs_station" ON "obs_station"."stationid" = "station"."id"
                            LEFT JOIN "ObservationType" "obs_type" ON "obs_type"."id" = "obs_station"."obstypesid"
                            LEFT JOIN "District" "district" ON "district"."id" = "station"."districtid"
                            WHERE "obs"."qualityindexid" IS NOT NULL';

        $querry_where = ' AND 1=1';
        if ($loaihinh != '1=1') {
            $querry_where.=' AND "obs_type"."id" = '.$loaihinh;
        }
        if ($loaitram != '1=1') {
            $querry_where.=' AND "category"."id" = '.$loaitram;
        }
        if ($quanhuyen != '1=1') {
            $querry_where.=' AND "district"."id" = '.$quanhuyen;
        }

        $querry_where.= ' AND "obs"."day" BETWEEN '.$fromDate_WA.' AND '.$toDate_WA;

        $querry_orderby = 'ORDER BY "quality"."id" DESC, "obs"."day" DESC';

        $querry_qualities = $querry_select.$querry_where.$querry_orderby;
        $result = DB::select($querry_qualities);
        $jsonData = json_encode($result);
        $original_data = json_decode($jsonData, true);
        $option = array();
        foreach ($original_data as $key => $value) {
            $option[] = array(
                'id' => $value['id'],
                'code' => $value['code'],
                'name' => $value['name'],
                'day' => $value['day'],
                'value' => $value['value'],
                'qualityID' => $value['qualityID'],
                'qualityPurpose' => $value['qualityPurpose'],
                'qualityColorcode' => $value['qualityColorcode']
            );
        }

        $final_data = json_encode($option);
        return $final_data;
    }
}
