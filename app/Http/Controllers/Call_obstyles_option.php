<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Call_obstyles_option extends Controller
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
                    'text' => $value['name'],
                    'parent' => '0',
                    'state' => array(
                        'opened' => false,
                    ),
                    'children' => array()
                );
            }
        }
        foreach ($option as $i => $value) {
            foreach ($original_data as $key => $value) {
                if ($value['parentid'] == $option[$i]["id"]) {
                    array_push($option[$i]["children"], array(
                        "id" => $value['id'],
                        "text" => $value['name'],
                        "parent" => $value['parentid']
                    ));
                }
            }
        }

        $option_final[] = array(
            'id' => '0',
            'text' => 'Tất cả',
            'state' => array(
                'opened' => true,
                'selected' => true
            ),
            'children' => $option
        );

        $final_data = json_encode($option_final);
        return $final_data;
    }
}
