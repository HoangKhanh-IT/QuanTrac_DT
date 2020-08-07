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
        $querry_statistic_select = 'SELECT
                                    "station"."id", "station"."code", "station"."name",
                                    "station"."coordx", "station"."coordy",
                                    "station"."establishdate", "station"."terminatedate",
                                    "station"."maintenance", "station"."active",
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
                                    "standard"."id" "stdID",
                                    "standard_view"."standardSymbol" "stdSymbol",
                                    "standard_view"."standardName" "stdName",
                                    concat(\'[\', string_agg("standard_view"."detailChild", \', \'), \']\') "total_detail"';

        $querry_statistic_select .= 'FROM (
                                        SELECT distinct "std_para"."standardid",
                                        "standard"."symbol" "standardSymbol", "standard"."name" "standardName",
                                        "obs"."stationid", "obs"."detail" "detailChild"
                                        FROM "StandardParameter" "std_para"
                                        LEFT JOIN "Standard" "standard" ON "standard"."id" = "std_para"."standardid"
                                        LEFT JOIN "Observation" "obs" ON "obs"."standardparameterid" = "std_para"."id"';

        /*** Where Condition Data Quy chuẩn và Lọc các trạm null ***/
        $querry_statistic_select .= 'WHERE "standardid" = ' .$quychuan.
            ' AND "obs"."stationid" is not null) as "standard_view"';

        $querry_statistic_select .= '
                                    LEFT JOIN "Observationstation" "station" ON "standard_view"."stationid" = "station"."id"
                                    LEFT JOIN "Category" "category" ON "category"."id" = "station"."categoryid"
                                    LEFT JOIN "Organization" "organization" ON "organization"."id" = "station"."organizationid"
                                    LEFT JOIN "Enterprise" "enterprise" ON "enterprise"."id" = "station"."enterpriseid"
                                    LEFT JOIN "Basin" "basin" ON "basin"."id" = "station"."basinid"
                                    LEFT JOIN "Location" "location" ON "location"."id" = "station"."locationid"
                                    LEFT JOIN "LocationType" "loctype" on "loctype"."id" = "location"."locationtypeid"
                                    LEFT JOIN "District" "district" ON "district"."id" = "station"."districtid"
                                    LEFT JOIN "ObstypeStation" "obs_station" ON "obs_station"."stationid" = "station"."id"
                                    LEFT JOIN "ObservationType" "obs_type" ON "obs_type"."id" = "obs_station"."obstypesid"
                                    LEFT JOIN "Standard" "standard" ON "standard"."obstypeid" = "obs_station"."obstypesid"';

        /*** Where Condition Quy chuẩn ***/
        $querry_statistic_where = 'WHERE "standard"."id" ='.$quychuan;

        /*** Where Condition Data Loại hình, Loại trạm và Quận huyện (trừ điều kiện $quanhuyen=1=1) ***/
        if ($quanhuyen != '1=1') {
            $querry_statistic_where.= ' AND "obs_type"."id" =' . $loaihinh .
                'and "category"."id" =' . $loaitram . 'and "district"."id" =' . $quanhuyen;
        } else {
            $querry_statistic_where.= ' AND "obs_type"."id" =' . $loaihinh .
                'and "category"."id" =' . $loaitram;
        }

        $querry_statistic_group = 'GROUP BY
                                        "station"."id",
                                        "obs_type"."name", "obs_type"."id",
                                        "category"."name", "category"."id",
                                        "location"."name", "location"."id",
                                        "loctype"."name", "loctype"."id",
                                        "district"."name", "district"."id",
                                        "organization"."name", "organization"."id",
                                        "enterprise"."name", "enterprise"."id",
                                        "basin"."name", "basin"."id",
                                        "standard"."id",
                                        "standard_view"."standardSymbol",
                                        "standard_view"."standardName"
                                        ORDER BY "station"."id" ASC';

        $querry_statistic = $querry_statistic_select.$querry_statistic_where.$querry_statistic_group;
        $result = DB::select($querry_statistic);
        $jsonData = json_encode($result);
        $original_data = json_decode($jsonData, true);

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
                'establishdate' => $value['establishdate'],
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
        return $final_data;
    }
}
