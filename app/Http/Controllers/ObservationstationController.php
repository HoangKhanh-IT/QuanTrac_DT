<?php

namespace App\Http\Controllers;

use App\Category;
use App\District;
use App\Enterprise;
use Illuminate\Http\Request;
use App\Observationstation;
use App\ObservationType;
use App\Standard;
use App\Purpose;
use App\Parameter;
use App\Organization;
use App\StandardParameter;
use App\Basin;
use App\Location;
use App\ObstypeStation;
use App\StdStation;
use Illuminate\Support\Facades\DB;

class ObservationstationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $Observationstations1 = Observationstation::find(4)->StandardParameters;
        // dd($Observationstations1);

        $ObservationTypes = ObservationType::all();
        $Categorys = Category::all();

        $Observationstations =
        Observationstation::orderBy('categoryid', 'ASC')->paginate(8);
        // $Observationstations =  DB::table('Observationstation')
        // // ->select('chapters.id', 'chapters.chapter_description', 'questions.id', 'questions.question_description', 'answers.id', 'answers.answer_description')
        // ->leftJoin('Category', 'Observationstation.categoryid', '=', 'Category.id')
        // ->select(['Observationstation.id', 'Observationstation.categoryid', 'Observationstation.code', 'Observationstation.name', 'Category.name'])
        // ->whereNotNull('Observationstation.id')
        // ->orderBy('Observationstation.categoryid', 'ASC')
        // ->paginate(8);
        //dd($Observationstations);

        // return $test =  $query->join('chapters', 'chapters.id', '=', 'question_chapter_rel.chapter_id')
        // ->join('questions', 'questions.id', '=', 'question_chapter_rel.question_id')
        // ->join('answers', 'answers.id', '=', 'questions.correct_answers')
        // ->where('answers.is_correct', 1)
        // ->where('question_chapter_rel.chapter_id', $id)
        // ->select(
        //     [

        //         'chapters.id',
        //         'chapters.chapter_description',
        //         'questions.id',
        //         'questions.question_description',
        //         'answers.id',
        //         'answers.answer_description'
        //     ]
        // )->paginate(20);

        // $Observationstations = DB::select('
        //     SELECT
        //         public."Observationstation".id as stationid,
        //         public."Observationstation".code as stationcode,
        //         public."Observationstation".name as stationname,
        //         public."Observationstation".active as stationactive,
        //         public."Enterprise".name as Enterprise_name,
        //         public."Category".name as Category_name
        //     FROM
        //         public."Observationstation"
        //     FULL JOIN
        //         public."Enterprise"
        //     ON
        //         public."Observationstation".enterpriseid = public."Enterprise".id
        //     FULL JOIN
        //         public."Category"
        //     ON
        //         public."Observationstation".categoryid = public."Category".id
        //     WHERE
	    //         public."Observationstation".id IS NOT NULL
        // ');
        //dd($Observationstations);
        return view('admin.obs_station.Observationstation', compact('Observationstations','Categorys','ObservationTypes'))->with('no', 1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $Districts = District::all();
        $Categorys = Category::all();
        $Enterprises = Enterprise::all();
        $Organizations = Organization::all();
        $Basins = Basin::all();
        $Locations = Location::all();
        $WQI = StandardParameter::findOrFail(396);
        $AQI = StandardParameter::findOrFail(395);
        //dd($WQI,$AQI);
        $ObservationTypes = ObservationType::get();
        return view('admin.obs_station.ObservationstationCreate', ['ObservationTypes' => $ObservationTypes,'WQI' =>$WQI,'AQI'=>$AQI, 'Districts'=> $Districts, 'Categorys'=> $Categorys, 'Enterprises'=> $Enterprises, 'Organizations'=> $Organizations, 'Basins'=> $Basins,'Locations'=> $Locations]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $WQI = StandardParameter::findOrFail(396);
        $AQI = StandardParameter::findOrFail(395);
        $request->validate(
            [
                'code' => 'bail|required|max:30|unique:Observationstation,code',
                'name' => 'bail|required|max:255|unique:Observationstation,name',
                'coordx' => 'bail|required|numeric',
                'coordy' => 'bail|required|numeric',
                'Parameters' => 'required',
                'ObservationTypes' => 'required'
            ],
            [
                'code.required' => 'Nhập mã trạm.',
                'code.max' => 'Mã trạm không dài quá 30 ký tự.',
                'code.unique' => 'Mã trạm đã tồn tại.',
                'name.required' => 'Nhập tên trạm.',
                'name.max' => 'Tên trạm không dài quá 255 ký tự.',
                'name.unique' => 'Tên trạm đã tồn tại.',
                'coordx.required' => 'Nhập tọa độ X.',
                'coordx.numeric' => 'Tọa độ X là dạng số.',
                'coordy.required' => 'Nhập tọa độ Y.',
                'coordy.numeric' => 'Tọa độ Y là dạng số.',
                'ObservationTypes.required' => 'Chọn loại hình quan trắc.',
                'Parameters.required' => 'Chọn chỉ tiêu quan trắc.',
               
            ]
        );
        //
        //dd($request);
        //dd($request->Parameters);


        $Params = $request->Parameters;
        $ObsTypes = $request->ObservationTypes;

        $establishdate = $request->input('establishdate');
        $terminatedate = $request->input('terminatedate');

        $Observationstation = new Observationstation([
            'code' => $request->get('code'),
            'name' => $request->get('name'),
            'organizationid' => $request->get('organization'),
            'categoryid' => $request->get('category'),
            'coordx' => $request->get('coordx'),
            'coordy' => $request->get('coordy'),
            'basinid' => $request->get('basin'),
            'enterpriseid' => $request->get('enterprise'),
            'districtid' => $request->get('district'),
            'locationid' => $request->get('location'),
            'establishdate' => $establishdate,
            'terminatedate' => $terminatedate,
            'maintenance' => $request->get('maintenance'),
            'note' => $request->get('note'),
            'active' => $request->get('active'),
            'ftpusername' => $request->get('ftpusername'),
            'ftppassword' => $request->get('ftppassword')
        ]);
        //dd($Observationstation);
        $Observationstation->save();
        $idObsStation = $Observationstation->id;
        foreach ($ObsTypes as $key => $ObsType) {
            $ObsTypeStation = new ObstypeStation([
                'stationid' => $idObsStation,
                'obstypesid' => $ObsType
            ]);
            $ObsTypeStation->save();
            //echo $ObsType . '</br>';
        }

        //echo '----';
        foreach ($Params as $key => $Param) {
            $Items = explode("_", $Param);
            $StdStation = new StdStation([
                'stationid' => $idObsStation,
                'standardParameterid' => $Items[1]
            ]);
            $StdStation->save();
        }
        if (isset($request->Check)) {
            if ($request->Check == "WQI") {
               // echo 'WQI' . $WQI->id;
                $StdStation = new StdStation([
                    'stationid' => $idObsStation,
                    'standardParameterid' => $WQI->id
                ]);
                $StdStation->save();
            }
            if ($request->Check == "AQI") {
                # code...
               // echo 'AQI' . $AQI->id;
                $StdStation = new StdStation([
                    'stationid' => $idObsStation,
                    'standardParameterid' => $AQI->id
                ]);
                $StdStation->save();
            }
           // dd($request->Check);
        }
        return redirect('quanly/Observationstation')->with('success', 'Thêm mới thành công!');
        //dd($idObsStation);
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
        $ObservationTypes = ObservationType::all();
        $Categorys = Category::all();
        if ($search == null) 
        {
            $Observationstations = Observationstation::orderBy('categoryid', 'ASC')->paginate(8);
            return view('admin.obs_station.Observationstation', compact('Observationstations','Categorys','ObservationTypes'))->with('no', 1);
        }
        else 
        {
            $search = trim(mb_strtoupper($search,'UTF-8'));
            $Observationstations = Observationstation::select('Observationstation.*')
                ->where(DB::raw('UPPER("Observationstation"."code")'), 'like', '%' .$search. '%')
                ->orwhere(DB::raw('UPPER("Observationstation"."name")'), 'like', '%' .$search. '%')
                //->orwhere(DB::raw('UPPER("Observationstation"."note")'), 'like', '%' .$search. '%')
                ->join('District', 'District.id', '=', 'Observationstation.districtid')
                ->orwhere(DB::raw('UPPER("District"."name")'), 'like', '%' .$search. '%')
                ->join('Location', 'Location.id', '=', 'Observationstation.locationid')
                ->orwhere(DB::raw('UPPER("Location"."name")'), 'like', '%' .$search. '%')
                ->join('Basin', 'Basin.id', '=', 'Observationstation.basinid')
                ->orwhere(DB::raw('UPPER("Basin"."name")'), 'like', '%' .$search. '%')
                ->join('Enterprise', 'Enterprise.id', '=', 'Observationstation.enterpriseid')
                ->orwhere(DB::raw('UPPER("Enterprise"."name")'), 'like', '%' .$search. '%')
                ->join('Organization', 'Organization.id', '=', 'Observationstation.organizationid')
                ->orwhere(DB::raw('UPPER("Organization"."name")'), 'like', '%' .$search. '%')
                ->join('Category', 'Category.id', '=', 'Observationstation.categoryid')
                ->orWhere(DB::raw('UPPER("Category"."name")'), 'like', '%' . $search . '%')
                // ->leftJoin('Basin', 'Observationstation.basinid', '=', 'Basin.id' )
                // ->orwhere(DB::raw('UPPER("Basin"."name")'), 'like', '%' .$search. '%')
                // ->leftJoin('Enterprise', 'Observationstation.enterpriseid', '=', 'Enterprise.id' )
                // ->orwhere(DB::raw('UPPER("Enterprise"."name")'), 'like', '%' .$search. '%')
                // ->leftJoin('Organization', 'Observationstation.organizationid', '=', 'Organization.id')
                // ->orwhere(DB::raw('UPPER("Organization"."name")'), 'like', '%' .$search. '%')
                ->paginate(8);
                return view('admin.obs_station.Observationstation', compact('Observationstations','Categorys','ObservationTypes'))->with('no', 1);
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
        $Districts = District::all();
        $Categorys = Category::all();
        $Enterprises = Enterprise::all();
        $Organizations = Organization::all();
        $Basins = Basin::all();
        $Locations = Location::all();
        $WQI = StandardParameter::findOrFail(396);
        $AQI = StandardParameter::findOrFail(395);
        //dd($WQI,$AQI);
        $ObservationTypes = ObservationType::get();
        $Observationstation = Observationstation::FindorFail($id);
        return view('admin.obs_station.ObservationstationEdit', ['Observationstation'=> $Observationstation,'ObservationTypes' => $ObservationTypes, 'WQI' => $WQI, 'AQI' => $AQI, 'Districts' => $Districts, 'Categorys' => $Categorys, 'Enterprises' => $Enterprises, 'Organizations' => $Organizations, 'Basins' => $Basins, 'Locations' => $Locations]);
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
        $WQI = StandardParameter::findOrFail(396);
        $AQI = StandardParameter::findOrFail(395);
        $request->validate(
            [
                'code' => 'bail|required|max:30|unique:Observationstation,code,'.$id,
                'name' => 'bail|required|max:255|unique:Observationstation,name,'.$id,
                'coordx' => 'bail|required|numeric',
                'coordy' => 'bail|required|numeric',
                'Parameters' => 'required',
                'ObservationTypes' => 'required'
            ],
            [
                'code.required' => 'Nhập mã trạm.',
                'code.max' => 'Mã trạm không dài quá 30 ký tự.',
                'code.unique' => 'Mã trạm đã tồn tại.',
                'name.required' => 'Nhập tên trạm.',
                'name.max' => 'Tên trạm không dài quá 255 ký tự.',
                'name.unique' => 'Tên trạm đã tồn tại.',
                'coordx.required' => 'Nhập tọa độ X.',
                'coordx.numeric' => 'Tọa độ X là dạng số.',
                'coordy.required' => 'Nhập tọa độ Y.',
                'coordy.numeric' => 'Tọa độ Y là dạng số.',
                'ObservationTypes.required' => 'Chọn loại hình quan trắc.',
                'Parameters.required' => 'Chọn chỉ tiêu quan trắc.',
            ]
        );
        $Params = $request->Parameters;
        $ObsTypes = $request->ObservationTypes;
        $establishdate = $request->input('establishdate');
        $terminatedate = $request->input('terminatedate');

        $Observationstation = Observationstation::find($id);
        $Observationstation->code = $request->get('code');
        $Observationstation->name = $request->get('name');
        $Observationstation->organizationid = $request->get('organization');
        $Observationstation->categoryid = $request->get('category');
        $Observationstation->coordx = $request->get('coordx');
        $Observationstation->coordy = $request->get('coordy');
        $Observationstation->basinid = $request->get('basin');
        $Observationstation->enterpriseid = $request->get('enterprise');
        $Observationstation->districtid = $request->get('district');
        $Observationstation->locationid = $request->get('location');
        $Observationstation->establishdate = $establishdate;
        $Observationstation->terminatedate = $terminatedate;
        $Observationstation->maintenance = $request->get('maintenance');
        $Observationstation->note = $request->get('note');
        $Observationstation->active = $request->get('active');
        $Observationstation->ftpusername = $request->get('ftpusername');
        $Observationstation->ftppassword = $request->get('ftppassword');
        $Observationstation->save();
        $idObsStation = $id;
        ObstypeStation::where("stationid", $id)->delete();
        StdStation::where("stationid", $id)->delete();
        foreach ($ObsTypes as $key => $ObsType) {
            $ObsTypeStation = new ObstypeStation([
                'stationid' => $idObsStation,
                'obstypesid' => $ObsType
            ]);
            $ObsTypeStation->save();
            //echo $ObsType . '</br>';
        }

        //echo '----';
        foreach ($Params as $key => $Param) {
            $Items = explode("_", $Param);
            $StdStation = new StdStation([
                'stationid' => $idObsStation,
                'standardParameterid' => $Items[1]
            ]);
            $StdStation->save();
        }
        if (isset($request->Check)) {
            if ($request->Check == "WQI") {
                // echo 'WQI' . $WQI->id;
                $StdStation = new StdStation([
                    'stationid' => $idObsStation,
                    'standardParameterid' => $WQI->id
                ]);
                $StdStation->save();
            }
            if ($request->Check == "AQI") {
                # code...
                // echo 'AQI' . $AQI->id;
                $StdStation = new StdStation([
                    'stationid' => $idObsStation,
                    'standardParameterid' => $AQI->id
                ]);
                $StdStation->save();
            }
            // dd($request->Check);
        }
        return redirect('quanly/Observationstation')->with('success', 'Cập nhật thành công!');
        //dd($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            $Observations = Observationstation::findOrFail($id)->Observations()->get();
            if ($Observations->isNotEmpty()) 
            {
                return redirect('quanly/Observationstation')->with('alert', 'Xóa không thành công do dữ liệu đã được tham chiếu đến bảng Kết quả quan trắc!');
            } 
            $Cameras = Observationstation::findOrFail($id)->Cameras()->get();
            if ($Cameras->isNotEmpty()) 
            {
                return redirect('quanly/Observationstation')->with('alert', 'Xóa không thành công do dữ liệu đã được tham chiếu đến bảng Camera!');
            } 
            $ElesctronicBoards = Observationstation::findOrFail($id)->ElesctronicBoards()->get();
            if ($ElesctronicBoards->isNotEmpty()) 
            {
                return redirect('quanly/Observationstation')->with('alert', 'Xóa không thành công do dữ liệu đã được tham chiếu đến bảng Bảng điện tử!');
            } 
            ObstypeStation::where("stationid", $id)->delete();
            StdStation::where("stationid", $id)->delete();
            $Observationstation = Observationstation::find($id);
            $Observationstation->delete();

            return redirect('quanly/Observationstation')->with('success', 'Xóa thành công!');
        }
        catch (\Exception $exception) 
        {
            return back()->withError($exception->getMessage());
        }
    }
}
