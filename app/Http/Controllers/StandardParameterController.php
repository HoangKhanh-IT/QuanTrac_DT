<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Standard;
use App\Purpose;
use App\Parameter;
use App\StandardParameter;
use App\Unit;
use Illuminate\Support\Facades\DB;

class StandardParameterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function jsonStandardParameterdb()
    {
        $jsonStandardParameterdb = DB::select('
                                                select
                                                    public."StandardParameter".id as sp_id,
                                                    public."StandardParameter".standardid as sp_standardid,
                                                    public."StandardParameter".parameterid as sp_parameterid,
                                                    public."StandardParameter".purposeid as sp_purposeid,
                                                    public."StandardParameter".unitid as sp_unitid,
                                                    public."StandardParameter".minvalue as sp_minvalue,
                                                    public."StandardParameter".maxvalue as sp_maxvalue,
                                                    public."StandardParameter".analysismethod as sp_analysismethod,
                                                    public."Parameter".id as parameter_id,
                                                    public."Parameter".name as parameter_name,
                                                    public."Parameter".code as parameter_code
                                                from
                                                    public."StandardParameter", public."Parameter"
                                                where
                                                    public."Parameter".id = public."StandardParameter".parameterid');
        return $jsonStandardParameterdb;
    }

    public function jsonStandard()
    {
        $standards = standard::get()->tojson();
        return $standards;
    }
    public function jsonStandardParameter()
    {
        $StandardParameters = StandardParameter::get()->tojson();
        return $StandardParameters;
    }
    public function jsonPurpose()
    {
        $Purposes = Purpose::get()->tojson();
        return $Purposes;
    }
    public function jsonParameter()
    {
        $Parameters = Parameter::get()->tojson();
        return $Parameters;
    }
    public function jsonStandardWParam()
    {
        $standards = Standard::get();
        //return $standards;
        $data  = [];
        foreach ($standards as  $standard) {
            # code...
            // echo '----------------</br>';
            // echo 'Tiêu chuẩn: '.$standard;
            // echo '</br>';
            $item = [];
            $StandardParameters =  $standard->standardParameters;
            //dd($StandardParameters);
            foreach ($StandardParameters as $key => $StandardParameter) {
                $item[$key] = [
                    'id' => $StandardParameter->id,
                    'standardid' => $StandardParameter->standardid,
                    'parameterid' => $StandardParameter->parameterid,
                    'unitid' => $StandardParameter->unitid,
                    'minvalue' => $StandardParameter->minvalue,
                    'maxvalue' => $StandardParameter->maxvalue,
                    'purposeid' => $StandardParameter->purposeid,
                    'analysismethod' => $StandardParameter->analysismethod
                ];
                // echo 'Chỉ tiêu: ' . $StandardParameter;
                //echo '</br>';
            }
            $data[] = [
                'id' => $standard->id,
                'name' => $standard->name,
                'symbol' => $standard->symbol,
                'obstypeid' => $standard->obstypeid,
                'dateoflssue' => $standard->dateoflssue,
                'organization' => $standard->organization,
                'attachment' => $standard->attachment,
                'StandardParameters' => $item,
            ];
        }
        $json_data = json_encode($data);
        //return response()->json(['success' => '1', 'data' => $json_data]);
        return response()->json([$data]);
        //return json_encode($json_data);
        // $standards = Standard::get();

        // $standards = Standard::find(1)->standardParameters;
        // dd($standards);
        // $StandardParameters = $standards->standardParameters;
        // dd($StandardParameters);
    }


    public function index()
    {
        //
        $StandardParameters = StandardParameter::paginate(10);
        return view('admin.stand_param.StandardParameter', ['StandardParameters' => $StandardParameters])->with('no', 1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $units = Unit::all();
        $paramerters = Parameter::all();
        $standards = Standard::all();
        $purposes = Purpose::all();
        return view('admin.stand_param.StandardParameterCreate', ['units' => $units, 'paramerters' => $paramerters, 'standards' => $standards, 'purposes' => $purposes])->with('no', 1);
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
                'standard' => 'required',
                'paramerter' => 'required',
                //'minvalue' => 'numeric',
                //'maxvalue' => 'numeric',
            ],
            [
                'standard.required' => 'Nhập tiêu chuẩn.',
                'paramerter.required' => 'Nhập thông số quan trắc.',
                //'minvalue.numeric' => 'Giá trị nhỏ nhất là dạng số.',
                //'maxvalue.numeric' => 'Giá trị lớn nhất là dạng số.'
            ]
        );
        $StandardParameter = new StandardParameter([
            'standardid' => $request->get('standard'),
            'parameterid' => $request->get('paramerter'),
            'unitid' => $request->get('unit'),
            'minvalue' => $request->get('minvalue'),
            'maxvalue' => $request->get('maxvalue'),
            'purposeid' => $request->get('purpose'),
            'analysismethod' => $request->get('analysismethod')
        ]);
        $StandardParameter->save();
        return redirect('quanly/StandardParameter')->with('success', 'Thêm mới thành công!');
        // dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
          $search = $request->search;
        if ($search == null) 
        {
            $StandardParameters = StandardParameter::orderBy('id','DESC')->paginate(10);
            return view('admin.stand_param.StandardParameter', ['StandardParameters' => $StandardParameters])->with('no', 1);
        } 
        else 
        {
            $search = trim(mb_strtoupper($search,'UTF-8'));
            $StandardParameters = StandardParameter::select('StandardParameter.*')
                ->where(DB::raw('UPPER("StandardParameter"."analysismethod")'), 'like', '%' .$search. '%')
                ->join('Standard', 'Standard.id', '=', 'StandardParameter.standardid')
                ->orWhere(DB::raw('UPPER("Standard"."name")'), 'like', '%' . $search . '%')
                ->orWhere(DB::raw('UPPER("Standard"."symbol")'), 'like', '%' . $search . '%')
                ->orWhere(DB::raw('UPPER("Standard"."organization")'), 'like', '%' . $search . '%')
                 ->join('Unit', 'Unit.id', '=', 'StandardParameter.unitid')
                ->orWhere(DB::raw('UPPER("Unit"."code")'), 'like', '%' . $search . '%')
                ->orWhere(DB::raw('UPPER("Unit"."name")'), 'like', '%' . $search . '%')
                 ->join('Purpose', 'Purpose.id', '=', 'StandardParameter.purposeid')
                ->orWhere(DB::raw('UPPER("Purpose"."name")'), 'like', '%' . $search . '%')
                 ->join('Parameter', 'Parameter.id', '=', 'StandardParameter.parameterid')
                ->orWhere(DB::raw('UPPER("Parameter"."code")'), 'like', '%' . $search . '%')
                ->orWhere(DB::raw('UPPER("Parameter"."name")'), 'like', '%' . $search . '%')->paginate(10);
            return view('admin.stand_param.StandardParameter', ['StandardParameters' => $StandardParameters])->with('no', 1);
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
        $units = Unit::all();
        $paramerters = Parameter::all();
        $standards = Standard::all();
        $purposes = Purpose::all();
        $StandardParameter = StandardParameter::findOrFail($id);
        //dd($StandardParameter);
        return view('admin.stand_param.StandardParameterEdit', ['StandardParameter' => $StandardParameter,'units' => $units, 'paramerters' => $paramerters, 'standards' => $standards, 'purposes' => $purposes])->with('no', 1);

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
                'standard' => 'required',
                'paramerter' => 'required',
                //'minvalue' => 'numeric',
                //'maxvalue' => 'numeric',
            ],
            [
                'standard.required' => 'Nhập tiêu chuẩn.',
                'paramerter.required' => 'Nhập thông số quan trắc.',
                //'minvalue.numeric' => 'Giá trị nhỏ nhất là dạng số.',
                //'maxvalue.numeric' => 'Giá trị lớn nhất là dạng số.'
            ]
        );

        $StandardParameter = StandardParameter::find($id);
        $StandardParameter->standardid = $request->get('standard');
        $StandardParameter->purposeid = $request->get('purpose');
        $StandardParameter->parameterid = $request->get('paramerter');
        $StandardParameter->unitid = $request->get('unit');
        $StandardParameter->minvalue = $request->get('minvalue');
        $StandardParameter->maxvalue = $request->get('maxvalue');
        $StandardParameter->analysismethod = $request->get('analysismethod');
        $StandardParameter->save();
        return redirect('quanly/StandardParameter')->with('success', 'Cập nhật thành công!');
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
        $StandardParameter = StandardParameter::find($id);
        $StandardParameter->delete();

        return redirect('quanly/StandardParameter')->with('success', 'Xóa thành công!');
    }
}
