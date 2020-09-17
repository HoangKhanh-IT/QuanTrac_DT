<?php
    include "config.php";
?>

<?php
    $quychuan_note = $_POST['quychuan_option'];
    $exceljson = $_POST['importExcel'];
    if (array_key_exists('status', $exceljson[0])) {
        echo "error";
        exit;
    } else {
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
            $max_count_select = pg_query($travinh_db, 'SELECT COUNT(*) FROM "SampleBanTuDong"');
            $max_arr = array();
            while ($row = pg_fetch_assoc($max_count_select)) {
                $max_arr[] = $row;
            }
            /*** Lấy giá trị max + 1 = ID của bán tự động ***/
            $max_count = $max_arr[0]['count'] + 1;
            pg_query($travinh_db, 'ALTER SEQUENCE samplebantudong_id_seq RESTART WITH ' . $max_count);

            /*** Tìm Station ID ***/
            $querry_select_code = 'SELECT "station"."id"
                                    FROM "Observationstation" "station"' .
                " WHERE" . '"station"."code"' . "= '" . $code_station . "'";
            $result = pg_query($travinh_db, $querry_select_code);
            if (!$result) {
                echo "Không có dữ liệu";
                exit;
            }
            $data_rs = array();
            while ($row = pg_fetch_assoc($result)) {
                $data_rs[] = $row;
            }

            $querry_values_code = '(' . "'" . $symbol . "'" . ','. "'" . $data_rs[0]['id'] . "'" .
                ',' . "'" . $time . "'" . ',' . "'" . $dateOfSampling . "'" .
                ',' . "'" . $dateOfAnalysis . "'" . ',' . "'" . $samplingLocations . "'" .
                ',' . "'" . $weather . "'" . ',' . "'" . $idExcel . "'" .')';

            $querry_insert_code = 'INSERT INTO "SampleBanTuDong"(
                                "symbol", "stationid", "time", "dateOfSampling",
                                "dateOfAnalysis", "samplingLocations", "weather", "idExcel")
                                VALUES' . $querry_values_code;

            $result_insert = pg_query($travinh_db, $querry_insert_code);
            if (!$result_insert) {
                echo "error";
                exit;
            }

            /*---- Insert vào bảng Observation ----*/
            /*** Luôn Restart để tìm ID lớn nhất ***/
            $max_count_observation = pg_query($travinh_db, 'SELECT COUNT(*) FROM "Observation"');
            $max_arr_obser = array();
            while ($row = pg_fetch_assoc($max_count_observation)) {
                $max_arr_obser[] = $row;
            }
            $max_count_obser = $max_arr_obser[0]['count'] + 1;
            pg_query($travinh_db, 'ALTER SEQUENCE observation_id_seq RESTART WITH ' . $max_count_obser);

            /*** Tìm quy chuẩn Code ***/
            $querry_select_Stdcode = 'SELECT "standard"."symbol"
                                    FROM "Standard" "standard"' .
                " WHERE" . '"standard"."id"' . "= '" . $quychuan_note . "'";
            $result_Std = pg_query($travinh_db, $querry_select_Stdcode);
            if (!$result_Std) {
                echo "Không có dữ liệu";
                exit;
            }
            $data_rsStd = array();
            while ($row = pg_fetch_assoc($result_Std)) {
                $data_rsStd[] = $row;
            }

            $querry_values_observation = '(' . "'" . $dateOfAnalysis . "'" . ','. "'" .$time . "'" .
                ',' . "'" . $max_count . "'" . ',' . "'" .$data_rsStd[0]['symbol']. "'" .
                ',' . "'" . $data_rs[0]['id'] . "'" .',' . "'" . $detail . "'" .')';

            $querry_insert_observation = 'INSERT INTO "Observation"(
                                "day", "time", "sampleid", "note", "stationid", "detail")
                                VALUES' . $querry_values_observation;

            $result_insert = pg_query($travinh_db, stripslashes($querry_insert_observation));
            if (!$result_insert) {
                echo "error";
                exit;
            }
        }
    }
?>
