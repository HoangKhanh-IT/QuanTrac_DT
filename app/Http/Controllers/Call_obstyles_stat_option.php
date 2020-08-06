<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Call_obstyles_stat_option extends Controller
{
    //
    function index()
    {
        $result = DB::table('ObservationType')
        ->select('id', 'name', 'parentid')
        ->orderBy('name')
        ->get()
        ->toArray();

        $jsonData = json_encode($result);
        $original_data = json_decode($jsonData, true);
        $option = array();
        foreach ($original_data as $key => $value) {
            if ($value['parentid'] == null) {
                $option[] = array(
                    'id' => $value['id'],
                    'name' => $value['name'],
                );
            } else {
                $option[] = array(
                    'id' => $value['id'],
                    'name' => "--- ".$value['name']." ---",
                );
            }
        }

        $final_data = json_encode($option);
        return $final_data;
    }
}
