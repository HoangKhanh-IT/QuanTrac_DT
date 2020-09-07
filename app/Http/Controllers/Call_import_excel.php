<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Call_import_excel extends Controller
{
    //
    function index()
    {
        $exceljson = $_POST['importExcel'];

        foreach($exceljson as $row) {
            $code_station = $row['code_station'];
            $symbol = $row['symbol'];
            $time = $row['time'];
            $dateOfSampling = $row['dateOfSampling'];
            $dateOfAnalysis = $row['dateOfAnalysis'];
            $samplingLocations = $row['samplingLocations'];
            $weather = $row['weather'];
            $idExcel = $row['idExcel'];
            $detail = json_encode($row['detail_data']);

            /*---- Insert vào bảng SampleBanTuDong ----*/
            /*** Luôn Restart để tìm ID lớn nhất ***/
            $max_count_select = DB::select('SELECT COUNT(*) FROM "SampleBanTuDong"');
            /*** Lấy giá trị max + 1 = ID của bán tự động ***/
            $max_count = $max_count_select[0]['count'] + 1;
            DB::select('ALTER SEQUENCE samplebantudong_id_seq RESTART WITH ' . $max_count);

            /*** Tìm Station ID ***/
            $querry_select_code = 'SELECT "station"."id"
                                    FROM "Observationstation" "station"' .
                " WHERE" . '"station"."code"' . "= '" . $code_station . "'";
            $result = DB::select($querry_select_code);

            $querry_values_code = '(' . "'" . $symbol . "'" . ','. "'" . $result[0]['id'] . "'" .
                ',' . "'" . $time . "'" . ',' . "'" . $dateOfSampling . "'" .
                ',' . "'" . $dateOfAnalysis . "'" . ',' . "'" . $samplingLocations . "'" .
                ',' . "'" . $weather . "'" . ',' . "'" . $idExcel . "'" .')';

            $querry_insert_code = 'INSERT INTO "SampleBanTuDong"(
                                "symbol", "stationid", "time", "dateOfSampling",
                                "dateOfAnalysis", "samplingLocations", "weather", "idExcel")
                                VALUES' . $querry_values_code;

            DB::select($querry_insert_code);

            /*---- Insert vào bảng Observation ----*/
            /*** Luôn Restart để tìm ID lớn nhất ***/
            $max_count_observation = DB::select('SELECT COUNT(*) FROM "Observation"');
            $max_count_obser = $max_count_observation[0]['count'] + 1;
            DB::select('ALTER SEQUENCE observation_id_seq RESTART WITH ' . $max_count_obser);

            $querry_values_observation = '(' . "'" . $dateOfAnalysis . "'" . ','. "'" .$time . "'" .
                ',' . "'" . $max_count . "'" . ',' . "'" . $result[0]['id'] . "'" .
                ',' . "'" . $detail . "'" .')';

            $querry_insert_observation = 'INSERT INTO "Observation"(
                                "day", "time", "sampleid", "stationid", "detail")
                                VALUES' . $querry_values_observation;

            DB::select(stripslashes($querry_insert_observation));
        }
    }
}
