<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Call_data_sampleBTD extends Controller
{
    //
    function index()
    {
        /*** Select Data ***/
        $station_id = $_GET['stationid'];
        $fromDate = $_GET['fromDate'];
        $toDate = $_GET['toDate'];
        /*** Đối với 1 số VPS không hỗ trợ xuất Date có dấu nháy nên cần dùng hàm date() để lấy ***/
        $fromDate = date($_GET['fromDate']);
        $toDate = date($_GET['toDate']);

        /*** Querry lựa chọn sample bán tự động ***/
        $querry_select_sampleBTD = 'SELECT "SampleBanTuDong".*, "Observation".detail
                                    FROM "SampleBanTuDong"
                                    LEFT JOIN "Observation" ON "Observation".stationid = "SampleBanTuDong".stationid
                                    WHERE "Observation".day = "SampleBanTuDong"."dateOfAnalysis"';

        $querry_select_sampleBTD.= ' AND "SampleBanTuDong".stationid ='.$station_id;
        if ($fromDate == '' && $toDate == '') {
            $querry_select_sampleBTD = $querry_select_sampleBTD.'ORDER BY "day" DESC';
        }
        if ($fromDate != '' && $toDate != ''){
            $querry_select_sampleBTD.= ' AND "dateOfSampling" between '.$fromDate.' AND '.$toDate.' ORDER BY "day" DESC';
            /*** Đối với 1 số VPS không hỗ trợ xuất Date có dấu nháy nên phải truy vấn cộng dấu nháy ***/
            /* $querry_select_sampleBTD.= ' AND "dateOfSampling" between '."'".$fromDate."'".' AND '."'".$toDate."'"; */
        }

        $result =  DB::select($querry_select_sampleBTD);
        $jsonData = json_encode($result);
        $original_data = json_decode($jsonData, true);
        $option = array();
        foreach ($original_data as $key => $value) {
            $option[] = array(
                'id' => $value['id'],
                'symbol' => $value['symbol'],
                'stationid' => $value['stationid'],
                'time_dateOfSamping' => date("d-m-Y", strtotime($value['dateOfSampling'])).' '.$value['time'],
                'dateOfAnalysis' => date("d-m-Y", strtotime($value['dateOfAnalysis'])),
                'samplingLocations' => $value['samplingLocations'],
                'weather' => $value['weather'],
                'detail' => json_decode($value['detail'])
            );
        }

        /*** Để Dom dữ liệu vào Sample Bán tự động ***/
        $option_final = array(
            'data' => $option
        );

        $final_data = json_encode($option_final);
        return $final_data;
    }
}
