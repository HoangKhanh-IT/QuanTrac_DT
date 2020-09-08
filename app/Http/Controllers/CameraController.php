<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Camera;
use App\ObservationStation;

class CameraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cameras = Camera::paginate(10);
        $ObservationStations = ObservationStation::all();
        return view('admin.camera.Camera', ['cameras' => $cameras, 'ObservationStations' => $ObservationStations] )->with('no', 1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $ObservationStations = ObservationStation::all();
        return view('admin.camera.CameraCreate', ['ObservationStations' => $ObservationStations]);
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
                'name' => 'bail|required|unique:Camera,name|max:255',
                'username' => 'bail|required|max:255',
                'pass' => 'bail|required|max:255',
                'ipaddress' => 'bail|required|unique:Camera,ipaddress|max:255',
            ],
            [
                'name.required' => 'Nhập tên camera.',
                'name.unique' => 'Tên đã tồn tại.',
                'name.max' => 'Tên không quá 255 ký tự.',
                'username.required' => 'Nhập tài khoản.',
                'username.max' => 'Tài khoản không quá 255 ký tự.',
                'pass.required' => 'Nhập mật khẩu.',
                'pass.max' => 'Mật khẩu không quá 255 ký tự.',
                'ipaddress.required' => 'Nhập địa chỉ IP.',
                'ipaddress.unique' => 'Địa chỉ IP đã tồn tại.',
                'ipaddress.max' => 'IP không quá 255 ký tự.',
            ]
        );
        $Camera = new Camera([
            'name' => $request->get('name'),
            'username' => $request->get('username'),
            'pass' => $request->get('pass'),
            'ipaddress' => $request->get('ipaddress'),
            'stationid' => $request->get('loaihinhcha'),
            'description' => $request->get('description')
        ]);
        $Camera->save();
        return redirect('quanly/Camera')->with('success', 'Thêm mới thành công!');
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
        if ($search ==null) {
            # code...
            $cameras = Camera::paginate(10);
            return view('admin.camera.Camera', ['cameras' => $cameras])->with('no', 1);
        }
        else
        {
            $search = trim(mb_strtoupper($search,'UTF-8'));
            $cameras = Camera::select('Camera.*')
                            ->where(DB::raw('UPPER("Camera"."name")'), 'like', '%' .$search. '%')
                            ->orwhere(DB::raw('UPPER("Camera"."username")'), 'like', '%' . $search . '%')
                            ->orwhere(DB::raw('UPPER("Camera"."ipaddress")'), 'like', '%' . $search . '%')
                            ->orwhere(DB::raw('UPPER("Camera"."description")'), 'like', '%' . $search . '%')
                             ->join('Observationstation', 'Observationstation.id', '=', 'Camera.stationid')
                            ->orWhere(DB::raw('UPPER("Observationstation"."name")'), 'like', '%' . $search . '%')->paginate(10);
           return view('admin.camera.Camera', ['cameras' => $cameras])->with('no', 1);
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
        $ObservationStations = ObservationStation::all();
        $Camera = Camera::findOrFail($id);
        return view('admin.camera.CameraEdit', ['ObservationStations' => $ObservationStations, 'Camera' => $Camera]);
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
                'name' => 'bail|required|max:255|unique:Camera,name,'.$id,
                'username' => 'bail|required|max:255',
                'pass' => 'bail|required|max:255',
                'ipaddress' => 'bail|required|max:255|unique:Camera,ipaddress,'.$id,
            ],
            [
                'name.required' => 'Nhập tên camera.',
                'name.max' => 'Tên không quá 255 ký tự.',
                'name.unique' => 'Tên camera đã tồn tại.',
                'username.required' => 'Nhập tài khoản.',
                'username.max' => 'Tài khoản không quá 255 ký tự.',
                'pass.required' => 'Nhập mật khẩu.',
                'pass.max' => 'Mật khẩu không quá 255 ký tự.',
                'ipaddress.required' => 'Nhập địa chỉ IP.',
                'ipaddress.max' => 'IP không quá 255 ký tự.',
                'ipaddress.unique' => 'Địa chỉ IP đã tồn tại.',

            ]
        );
        $Camera = Camera::find($id);
        $Camera->name = $request->get('name');
        $Camera->username = $request->get('username');
        $Camera->pass = $request->get('pass');
        $Camera->ipaddress = $request->get('ipaddress');
        $Camera->stationid = $request->get('loaihinhcha');
        $Camera->description = $request->get('description');
        $Camera->save();
        return redirect('quanly/Camera')->with('success', 'Cập nhật thành công!');
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
        $Camera = Camera::find($id);
        $Camera->delete();
        return redirect('quanly/Camera')->with('success', 'Xóa thành công!');
    }
}
