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
        ->orderBy('id')
        ->get()
        ->toArray();

        $jsonData = json_encode($result);
        $original_data = json_decode($jsonData, true);
        $option = array();
        foreach ($original_data as $key => $value) {
            if ($value['parentid'] == null) {
                $option[] = array(
                    'id' => $value['id'],
                    'flag' => $value['id'],
                    'name' => $value['name'],
                );
            } else {
                $option[] = array(
                    'id' => $value['id'],
                    'flag' => $value['parentid'],
                    'name' => "--- ".$value['name']." ---",
                );
            }
        }

        /*** Hàm sort theo Object key bất kỳ ***/
        function array_sort($array, $on, $order = SORT_ASC)
        {
            $new_array = array();
            $sortable_array = array();

            if (count($array) > 0) {
                foreach ($array as $k => $v) {
                    if (is_array($v)) {
                        foreach ($v as $k2 => $v2) {
                            if ($k2 == $on) {
                                $sortable_array[$k] = $v2;
                            }
                        }
                    } else {
                        $sortable_array[$k] = $v;
                    }
                }

                switch ($order) {
                    case SORT_ASC:
                        asort($sortable_array);
                    break;
                    case SORT_DESC:
                        arsort($sortable_array);
                    break;
                }

                foreach ($sortable_array as $k => $v) {
                    $new_array[$k] = $array[$k];
                }
            }

            return $new_array;
        }

        /*** Sau khi sort cần loại bỏ Object key của hàm để DOM đúng thứ tự ***/
        $final_data = json_encode(array_values(array_sort($option, 'flag', SORT_DESC)));
        return $final_data;
    }
}
