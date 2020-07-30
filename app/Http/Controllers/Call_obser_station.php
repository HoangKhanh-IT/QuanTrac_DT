<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Call_obser_station extends Controller
{
    //
    function index()
    {
        $loaihinh = $_GET['loaihinh'];
        $loaitram = $_GET['loaitram'];
        $quanhuyen = $_GET['quanhuyen'];
        $loaidiadanh = $_GET['loaidiadanh'];
        $diadanh = $_GET['diadanh'];

        $querry_tramqt_select = 'SELECT
                            "station"."id", "station"."code", "station"."name",
                            "station"."coordx", "station"."coordy",
                            "station"."establishyear", "station"."terminatedate",
                            "station"."maintenance", "station"."active",
                            "category"."name" "categoryName",
                            "category"."id" "categoryID",
                            "organization"."name" "organizationName",
                            "enterprise"."name" "enterpriseName",
                            "basin"."name" "basinName",
                            "location"."name" "locationName",
                            "location"."id" "locationID",
                            "loctype"."name" "locationTypeName",
                            "loctype"."id" "locationTypeID",
                            "district"."name" "districtName",
                            "district"."id" "districtID",
                            (array_agg(distinct "obs_type"."name"))[1] "obstype_namefirst",
							string_agg(distinct "obs_type"."name", \'; \') "obstype_namelist",
							concat(\'[\', string_agg(distinct "obs"."detail", \', \'), \']\') "total_detail",
							string_agg(distinct CAST ("obs"."day" + "obs"."time"  AS text), \', \') "total_day"';

        $querry_tramqt_select .= 'FROM "Observationstation" "station"
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

                            WHERE "station"."id" IN (
                                SELECT "station_In"."id"
                                FROM "Observationstation" "station_In"
                                LEFT JOIN "Category" "category" ON "category"."id" = "station_In"."categoryid"
                                LEFT JOIN "Organization" "organization" ON "organization"."id" = "station_In"."organizationid"
                                LEFT JOIN "Enterprise" "enterprise" ON "enterprise"."id" = "station_In"."enterpriseid"
                                LEFT JOIN "Basin" "basin" ON "basin"."id" = "station_In"."basinid"
                                LEFT JOIN "Location" "location" ON "location"."id" = "station_In"."locationid"
                                LEFT JOIN "LocationType" "loctype" on "loctype"."id" = "location"."locationtypeid"
                                LEFT JOIN "District" "district" ON "district"."id" = "station_In"."districtid"
                                LEFT JOIN "Obstype_Station" "obs_station" ON "obs_station"."stationid" = "station_In"."id"
                                LEFT JOIN "ObservationType" "obs_type" ON "obs_type"."id" = "obs_station"."obstypesid"
                                LEFT JOIN "Observation" "obs" ON "obs"."stationid" = "station_In"."id"';

        /*** Where Condition Data Loại hình ***/
        $querry_tramqt_where_loaihinh = ' WHERE ';
        if (count($loaihinh) == 1) {
            if ($loaihinh[0] == 0) {
                $querry_tramqt_where_loaihinh .= '1=1 ';
            } else {
                $querry_tramqt_where_loaihinh .= '"obs_station"."obstypesid" = ' . $loaihinh[0];
            }
        } else {
            for ($i = 0; $i < count($loaihinh); $i++) {
                if ($i == count($loaihinh) - 1) {
                    $querry_tramqt_where_loaihinh .= '"obs_station"."obstypesid" = ' . $loaihinh[$i];
                } else {
                    $querry_tramqt_where_loaihinh .= '"obs_station"."obstypesid" = ' . $loaihinh[$i] . " OR ";
                }
            }
        }
        $querry_tramqt_where_loaihinh .= ')';

        /*** Where Condition Data Loại trạm, Quận huyện, Loại địa danh và Địa danh (1=1 là không có điều kiện xảy ra)***/
        $querry_tramqt_where_loaitram_quanhuyen_loaidiadanh_diadanh = 'AND 1=1';
        if ($quanhuyen != '1=1') {
            $querry_tramqt_where_loaitram_quanhuyen_loaidiadanh_diadanh .= ' AND "district"."id" = ' . $quanhuyen;
        }
        if ($loaitram != '1=1') {
            $querry_tramqt_where_loaitram_quanhuyen_loaidiadanh_diadanh .= ' AND "category"."id" = ' . $loaitram;
        }
        if ($loaidiadanh != '1=1') {
            $querry_tramqt_where_loaitram_quanhuyen_loaidiadanh_diadanh .= ' AND "loctype"."id" = ' . $loaidiadanh;
        }
        if ($diadanh != '1=1') {
            $querry_tramqt_where_loaitram_quanhuyen_loaidiadanh_diadanh .= ' AND "location"."id" = ' . $diadanh;
        }

        /*** Group and Order Data ***/
        $querry_tramqt_group = ' GROUP BY "station"."id",
                                "category"."name", "category"."id",
                                "location"."name", "location"."id",
                                "loctype"."name", "loctype"."id",
                                "district"."name", "district"."id",
                                "organization"."name", "enterprise"."name", "basin"."name"
                                ORDER BY "station"."name" ASC';

        /*** Gộp 3 chuỗi trên tạo thành câu truy vấn ***/
        $querry_tramqt = $querry_tramqt_select . $querry_tramqt_where_loaihinh .
            $querry_tramqt_where_loaitram_quanhuyen_loaidiadanh_diadanh . $querry_tramqt_group;

        $result = DB::select($querry_tramqt);
        $jsonData = json_encode($result);
        $original_data = json_decode($jsonData, true);
        $features = array();
        foreach ($original_data as $key => $value) {
            $features[] = array(
                'type' => 'Feature',
                'properties' => array(
                    'id' => $value['id'],
                    'code' => $value['code'],
                    'name' => $value['name'],
                    'organizationName' => $value['organizationName'],
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
                    'obstype_namefirst' => $value['obstype_namefirst'],
                    'obstype_namelist' => $value['obstype_namelist'],
                    /*** Get daytime earliest ***/
                    'daytime_earliest' => max(explode(", ", $value['total_day'])),
                    'total_detail' => json_decode($value['total_detail'])
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
