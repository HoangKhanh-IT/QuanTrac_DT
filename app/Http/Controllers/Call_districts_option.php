<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Call_districts_option extends Controller
{
    //
    function index()
    {
        $result = DB::select('SELECT * FROM "District"');
        $jsonData = json_encode($result);
        $original_data = json_decode($jsonData, true);
        $option = array();
        foreach ($original_data as $key => $value) {
            $option[] = array(
                'id' => $value['id'],
                'name' => $value['name']
            );
        }

        $final_data = json_encode($option);
        return $final_data;
    }
}
