<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Call_stat_station extends Controller
{
    //
    function index()
    {
        $loaihinh = $_GET['loaihinh_stat'];
        $loaitram = $_GET['loaitram_stat'];
        $quanhuyen = $_GET['quanhuyen_stat'];
        $quychuan = $_GET['quychuan_stat'];

        /*** Querry Thống kê quan trắc ***/
        $querry_statistic_select_distinct = 'SELECT distinct
                                "stat_view"."id", "stat_view"."code", "stat_view"."name",
                                "stat_view"."coordx", "stat_view"."coordy",
                                "stat_view"."establishyear", "stat_view"."terminatedate",
                                "stat_view"."maintenance", "stat_view"."active",
                                "stat_view"."the_geom",
                                "obs_type"."name" "obsTypeName",
                                "obs_type"."id" "obsTypeID",
                                "category"."name" "categoryName",
                                "category"."id" "categoryID",
                                "organization"."name" "organizationName",
                                "enterprise"."name" "enterpriseName",
                                "basin"."name" "basinName",
                                "location"."name" "locationName",
                                "location"."id" "locationID",
                                "stat_view"."locationTypeName",
                                "stat_view"."locationTypeID",
                                "district"."name" "districtName",
                                "district"."id" "districtID",
                                "stat_view"."stdSymbol",
                                "stat_view"."stdName",
                                "stat_view"."total_detail"';

        $querry_statistic_select_distinct .= 'FROM (SELECT
                                    "station"."id", "station"."code", "station"."name",
                                    "station"."coordx", "station"."coordy",
                                    "station"."establishyear", "station"."terminatedate",
                                    "station"."maintenance", "station"."active",
                                    "station"."the_geom",
                                    "obs_type"."name" "obsTypeName",
                                    "obs_type"."id" "obsTypeID",
                                    "category"."name" "categoryName",
                                    "category"."id" "categoryID",
                                    "organization"."id" "organizationID",
                                    "organization"."name" "organizationName",
                                    "enterprise"."id" "enterpriseID",
                                    "enterprise"."name" "enterpriseName",
                                    "basin"."id" "basinID",
                                    "basin"."name" "basinName",
                                    "location"."name" "locationName",
                                    "location"."id" "locationID",
                                    "loctype"."name" "locationTypeName",
                                    "loctype"."id" "locationTypeID",
                                    "district"."name" "districtName",
                                    "district"."id" "districtID",
                                    "standard_view"."standarparaID" "stdParaID",
                                    "standard_view"."standardSymbol" "stdSymbol",
                                    "standard_view"."standardName" "stdName",
                                    concat(\'[\', string_agg(distinct "obs"."detail", \', \'), \']\') "total_detail"';

        $querry_statistic_select_distinct .= 'FROM (
                                        SELECT distinct "std_para"."id" "standarparaID", "std_para"."standardid",
                                        "standard"."symbol" "standardSymbol", "standard"."name" "standardName",
                                        "obs"."stationid"
                                        FROM "StandardParameter" "std_para"
                                        LEFT JOIN "Standard" "standard" ON "standard"."id" = "std_para"."standardid"
                                        LEFT JOIN "Observation" "obs" ON "obs"."standardparameterid" = "std_para"."id"';

        /*** Where Condition Data Quy chuẩn ***/
        $querry_statistic_select_distinct .= 'where "standardid" =' . $quychuan . ') as "standard_view"';

        $querry_statistic_select_distinct .= '
                                    LEFT JOIN "Observationstation" "station" ON "standard_view"."stationid" = "station"."id"
                                    LEFT JOIN "Category" "category" ON "category"."id" = "station"."categoryid"
                                    LEFT JOIN "Organization" "organization" ON "organization"."id" = "station"."organizationid"
                                    LEFT JOIN "Enterprise" "enterprise" ON "enterprise"."id" = "station"."enterpriseid"
                                    LEFT JOIN "Basin" "basin" ON "basin"."id" = "station"."basinid"
                                    LEFT JOIN "Location" "location" ON "location"."id" = "station"."locationid"
                                    LEFT JOIN "LocationType" "loctype" on "loctype"."id" = "location"."locationtypeid"
                                    LEFT JOIN "District" "district" ON "district"."id" = "station"."districtid"
                                    LEFT JOIN "Obstype_Station" "obs_station" ON "obs_station"."stationid" = "station"."id"
                                    LEFT JOIN "ObservationType" "obs_type" ON "obs_type"."id" = "obs_station"."obstypesid"
                                    LEFT JOIN "Observation" "obs" ON "obs"."stationid" = "station"."id"
                                    LEFT JOIN "Standard" "standard" ON "standard"."obstypeid" = "obs_station"."obstypesid"

                                    WHERE "obs"."standardparameterid" = "standard_view"."standarparaID"
                                    GROUP BY
                                        "station"."id",
                                        "obs_type"."name", "obs_type"."id",
                                        "category"."name", "category"."id",
                                        "location"."name", "location"."id",
                                        "loctype"."name", "loctype"."id",
                                        "district"."name", "district"."id",
                                        "organization"."name", "organization"."id",
                                        "enterprise"."name", "enterprise"."id",
                                        "basin"."name", "basin"."id",
                                        "standard_view"."standardSymbol",
                                        "standard_view"."standardName",
                                        "standard_view"."standarparaID"
                                    ORDER BY "station"."name" ASC) as "stat_view"

                            LEFT JOIN "Category" "category" ON "category"."id" = "stat_view"."categoryID"
                            LEFT JOIN "Organization" "organization" ON "organization"."id" = "stat_view"."organizationID"
                            LEFT JOIN "Enterprise" "enterprise" ON "enterprise"."id" = "stat_view"."enterpriseID"
                            LEFT JOIN "Basin" "basin" ON "basin"."id" = "stat_view"."basinID"
                            LEFT JOIN "Location" "location" ON "location"."id" = "stat_view"."locationID"
                            LEFT JOIN "District" "district" ON "district"."id" = "stat_view"."districtID"
                            LEFT JOIN "Obstype_Station" "obs_station" ON "obs_station"."stationid" = "stat_view"."id"
                            LEFT JOIN "ObservationType" "obs_type" ON "obs_type"."id" = "obs_station"."obstypesid"
                            LEFT JOIN "Observation" "obs" ON "obs"."stationid" = "stat_view"."id"';

        /*** Where Condition Data Loại hình, Loại trạm và Quận huyện (trừ điều kiện $quanhuyen=1=1)  ***/
        if ($quanhuyen != '1=1') {
            $querry_statistic_where = 'where "obs_type"."id" =' . $loaihinh .
                'and "category"."id" =' . $loaitram . 'and "district"."id" =' . $quanhuyen;
        } else {
            $querry_statistic_where = 'where "obs_type"."id" =' . $loaihinh .
                'and "category"."id" =' . $loaitram;
        }

        $querry_statistic = $querry_statistic_select_distinct . $querry_statistic_where;
        $result = DB::select($querry_statistic);
        $jsonData = json_encode($result);
        $original_data = json_decode($jsonData, true);

        /*** Xử lý các chuỗi bị trùng ID
        for ($i = 0; $i < count($original_data); $i++) {
            print_r($original_data[$i]['id']);
            if ($original_data[$i]['id'] == $original_data[$i + 1]['id']) {

            }
        } ***/

        $option = array();
        foreach ($original_data as $key => $value) {
            $option[] = array(
                'id' => $value['id'],
                'code' => $value['code'],
                'name' => $value['name'],
                'organizationName' => $value['organizationName'],
                'obstype_id' => $value['obsTypeID'],
                'obstype_name' => $value['obsTypeName'],
                "standard_symbol" => $value['stdSymbol'],
                'categoryID' => $value['categoryID'],
                'categoryName' => $value['categoryName'],
                'basinName' => $value['basinName'],
                'enterpriseName' => $value['enterpriseName'],
                'districtID' => $value['districtID'],
                'districtName' => $value['districtName'],
                'locationID' => $value['locationID'],
                'locationName' => $value['locationName'],
                'locationTypeID' => $value['locationTypeID'],
                'locationTypeName' => $value['locationTypeName'],
                'establishyear' => $value['establishyear'],
                'terminatedate' => $value['terminatedate'],
                'maintenance' => $value['maintenance'],
                'active' => $value['active'],
                'total_detail' => json_decode($value['total_detail'])
            );
        }

        /*** Để Dom dữ liệu vào Danh sách vượt ngưỡng ***/
        $option_final = array(
            'data' => $option
        );

        $final_data = json_encode($option_final);
        // return $final_data;
    }
}
