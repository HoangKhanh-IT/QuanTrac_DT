<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\DischargePoint;
use App\Basin;
use App\Standard;
use App\Enterprise;
use Carbon\Carbon;

class DischargePointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $DischargePoints = DischargePoint::paginate(8);
        return view( 'admin.discharge_point.ListDischargePoint',['DischargePoints' => $DischargePoints])->with('no', 1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $Basins =Basin::all();
        $Standards =Standard::all();
        $Enterprises =Enterprise::all();
        return view('admin.discharge_point.CreateDischargePoint', ['Basins' => $Basins,'Standards' => $Standards,'Enterprises' => $Enterprises]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
         $request->validate(
            [
                'coordx' => 'bail|required|numeric',
                'coordy' => 'bail|required|numeric',
                'operatingtime' =>'bail|nullable|numeric',
                'flowrate' =>'bail|nullable|numeric',
                'licenseterm' =>'bail|nullable|numeric',
            ],
            [
                'coordx.required' => 'Nhập tọa độ X.',
                'coordx.numeric' => 'Tọa độ X phải là số.',
                'coordy.required' => 'Nhập tọa độ Y.',
                'coordy.numeric' => 'Tọa độ Y phải là số.',
                'operatingtime.numeric' => 'Thời gian vận hành phải là số.',
                'flowrate.numeric' => 'Lưu lượng xả thải phải là số.',
                'licenseterm.numeric' => 'Hạn giấy phép phải là số.',

            ]
        );
        $date = null;
        $temp = $request->input('licensedate');
        if($temp!=null && $temp!="")
        {
            $dtemp = explode("-", $temp );
            //$date = date_format(date_create($temp),"d/m/Y");
            $date = Carbon::create($dtemp[2],$dtemp[1],$dtemp[0]);
        }
        $DischargePoint = new DischargePoint([
            'enterpriseid'  => $request->get('enterpriseid'),
            'decisionnumber'  => $request->get('decisionnumber'),
            'licensedate'  =>  $date,
            'period'  => $request->get('period'),
            'establishmentname'  => $request->get('establishmentname'),
            'location'  => $request->get('location'),
            'operatingtime'  => $request->get('operatingtime'),
            'dischargemethod'  => $request->get('dischargemethod'),
            'flowrate'  => $request->get('flowrate'),
            'standardid'  => $request->get('standardid'),
            'coordx'  => $request->get('coordx'),
            'coordy'  => $request->get('coordy'),
            'sourcereception'  => $request->get('sourcereception'),
            'basinid' => $request->get('basinid'),
            'licensetype'  => $request->get('licensetype'),
            'licenseterm'  => $request->get('licenseterm'),
            'note'  => $request->get('note'),

        ]);
        $DischargePoint->save();
        return redirect('quanly/DischargePoint')->with('success', 'Thêm mới thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function show(Request $request)
   {
        //
        $search = $request->search;
        if ($search == null)
         {
            $DischargePoints = DischargePoint::paginate(8);
            return view( 'admin.discharge_point.ListDischargePoint',['DischargePoints' => $DischargePoints])->with('no', 1);
        }
        else
        {
            $search = trim(mb_strtoupper($search,'UTF-8'));
            $DischargePoints = DischargePoint::select('DischargePoint.*')
                ->where(DB::raw('UPPER("DischargePoint"."decisionnumber")'), 'like', '%' .$search. '%')
                ->orwhere(DB::raw('UPPER("DischargePoint"."establishmentname")'), 'like', '%' .$search. '%')
                ->orwhere(DB::raw('UPPER("DischargePoint"."location")'), 'like', '%' .$search. '%')
                ->orwhere(DB::raw('UPPER("DischargePoint"."dischargemethod")'), 'like', '%' .$search. '%')
                ->orwhere(DB::raw('UPPER("DischargePoint"."sourcereception")'), 'like', '%' .$search. '%')
                ->join('Basin', 'Basin.id', '=', 'DischargePoint.basinid')
                ->orWhere(DB::raw('UPPER("Basin"."name")'), 'like', '%' . $search . '%')
                ->join('Standard', 'Standard.id', '=', 'DischargePoint.standardid')
                ->orWhere(DB::raw('UPPER("Standard"."name")'), 'like', '%' . $search . '%')
                ->join('Enterprise', 'Enterprise.id', '=', 'DischargePoint.enterpriseid')
                ->orWhere(DB::raw('UPPER("Enterprise"."name")'), 'like', '%' . $search . '%')->paginate(8);
            return view( 'admin.discharge_point.ListDischargePoint',['DischargePoints' => $DischargePoints])->with('no', 1);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $Basins =Basin::get();
        $Standards =Standard::get();
        $Enterprises =Enterprise::get();
        $DischargePointItem = DischargePoint::findOrFail($id);
        return view('admin.discharge_point.EditDischargePoint', compact('DischargePointItem', 'Basins','Standards','Enterprises'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
          $request->validate(
            [
                'coordx' => 'bail|required|numeric',
                'coordy' => 'bail|required|numeric',
                'operatingtime' =>'nullable|numeric',
                'flowrate' =>'nullable|numeric',
                'licenseterm' =>'nullable|numeric',
            ],
            [
                'coordx.required' => 'Nhập tọa độ X.',
                'coordx.numeric' => 'Tọa độ X phải là số.',
                'coordy.required' => 'Nhập tọa độ Y.',
                'coordy.numeric' => 'Tọa độ Y phải là số.',
                'operatingtime.numeric' => 'Thời gian vận hành phải là số.',
                'flowrate.numeric' => 'Lưu lượng xả thải phải là số.',
                'licenseterm.numeric' => 'Hạn giấy phép phải là số.',

            ]
        );
        $date = null;
        $temp = $request->input('licensedate');
        if($temp!=null && $temp!="")
        {
            $dtemp = explode("-", $temp );
            //$date = date_format(date_create($temp),"d/m/Y");
            $date = Carbon::create($dtemp[2],$dtemp[1],$dtemp[0]);
        }
        $DischargePoint = DischargePoint::findOrFail($id);
             $DischargePoint ->enterpriseid = $request->get('enterpriseid');
             $DischargePoint ->decisionnumber = $request->get('decisionnumber');
             $DischargePoint ->licensedate =  $date;
             $DischargePoint ->period = $request->get('period');
             $DischargePoint ->establishmentname = $request->get('establishmentname');
             $DischargePoint ->location = $request->get('location');
             $DischargePoint ->operatingtime = $request->get('operatingtime');
             $DischargePoint ->dischargemethod = $request->get('dischargemethod');
             $DischargePoint ->flowrate = $request->get('flowrate');
             $DischargePoint ->standardid = $request->get('standardid');
             $DischargePoint ->coordx = $request->get('coordx');
             $DischargePoint ->coordy = $request->get('coordy');
             $DischargePoint ->sourcereception = $request->get('sourcereception');
             $DischargePoint ->basinid = $request->get('basinid');
             $DischargePoint ->licensetype = $request->get('licensetype');
             $DischargePoint ->licenseterm = $request->get('licenseterm');
             $DischargePoint ->note = $request->get('note');
        $DischargePoint->save();
        return redirect('quanly/DischargePoint')->with('success', 'Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $DischargePoint = DischargePoint::find($id);
        $DischargePoint->delete();
        return redirect('quanly/DischargePoint')->with('success', 'Xóa thành công!');
    }
}
