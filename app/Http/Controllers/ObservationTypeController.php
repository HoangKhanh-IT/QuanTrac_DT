<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\View;
use Session;
use App\ObservationType;
use App\Category;

class ObservationTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ObservationTypes = ObservationType::paginate(8);
        $ObservationTypeItems = ObservationType::all();
        //dd($ObservationTypes);
        return view(
            'admin.obs_type.ObservationType',
            ['ObservationTypes' => $ObservationTypes, 'ObservationTypeItems'=> $ObservationTypeItems]
        )->with('no', 1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        $ObservationTypes = ObservationType::get();
        return view('admin.obs_type.ObservationTypeCreate', ['ObservationTypes' => $ObservationTypes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'maloaihinh' => 'bail|required|unique:ObservationType,code|max:3',
                'tenloaihinh' => 'bail|required|unique:ObservationType,name|max:255'
            ],
            [
                'maloaihinh.required' => 'Nhập mã loại hình!',
                'maloaihinh.unique' => 'Mã loại hình đã tồn tại!',
                'maloaihinh.max' => 'Mã loại hình không dài quá 3 ký tự!',
                'tenloaihinh.required' => 'Nhập tên loại hình!',
                'tenloaihinh.unique' => 'Tên loại hình đã tồn tại!',
                'tenloaihinh.max' => 'Tên loại hình không dài quá 255 ký tự!',
            ]
        );

        $ObservationType = new ObservationType([
            'code' => $request->get('maloaihinh'),
            'name' => $request->get('tenloaihinh'),
            'parentid' => $request->get('loaihinhcha')
        ]);
        $ObservationType->save();
        return redirect('danhmuc/ObservationType')->with('success', 'Thêm mới thành công!');
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
        if ($search == null) {
            $ObservationTypes = ObservationType::paginate(8);
         return view( 'admin.obs_type.ObservationType', ['ObservationTypes' => $ObservationTypes])->with('no', 1);
        } 
        else 
        {
             $search = trim(mb_strtoupper($search,'UTF-8'));
            $ObservationTypes = ObservationType::where(DB::raw('UPPER(name)'), 'like', '%' . $search . '%')
             ->orwhere(DB::raw('UPPER(code)'), 'LIKE', '%'.$search.'%')->paginate(8);
           return view( 'admin.obs_type.ObservationType', ['ObservationTypes' => $ObservationTypes])->with('no', 1);
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
        $ObservationTypes = ObservationType::get();
        $ObservationTypeItem = ObservationType::findOrFail($id);
        return view('admin.obs_type.ObservationTypeedit', compact('ObservationTypeItem', 'ObservationTypes'));
     
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
                'maloaihinh' => 'bail|required|max:3|unique:ObservationType,code,'.$id,
                'tenloaihinh' => 'bail|required|max:255|unique:ObservationType,name,'.$id
            ],
            [
                'maloaihinh.required' => 'Nhập mã loại hình!',
                'maloaihinh.max' => 'Mã loại hình không dài quá 3 ký tự!',
                'maloaihinh.unique' => 'Mã loại hình đã tồn tại!',
                'tenloaihinh.required' => 'Nhập tên loại hình!',
                'tenloaihinh.max' => 'Tên loại hình không dài quá 255 ký tự!',
                'tenloaihinh.unique' => 'Tên loại hình đã tồn tại!',
              
            ]
        );
        $ObservationType = ObservationType::find($id);
        $ObservationType->code = $request->get('maloaihinh');
        $ObservationType->name = $request->get('tenloaihinh');
        $ObservationType->parentid = $request->get('loaihinhcha');
        $ObservationType->save();
        return redirect('/danhmuc/ObservationType')->with('success', 'Cập nhật thành công!');
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
        try
        {
            $standards = ObservationType::findOrFail($id)->standards()->get();
            //$ObstypeStations = ObservationType::find($id)->ObstypeStations()->get();
            if ($standards->isNotEmpty()) 
            {
                return redirect('danhmuc/ObservationType')->with('alert', 'Xóa không thành công do dữ liệu đã được tham chiếu đến bảng Quy chuẩn!');
            } 

            ObstypeStation::where("obstypesid", $id)->delete();
            $ObservationType = ObservationType::findOrFail($id);
            $ObservationType->delete();
            return redirect('danhmuc/ObservationType')->with('success', 'Xóa thành công!');
        }
        catch (\Exception $exception) 
        {
            return back()->withError($exception->getMessage());
        }
    }
}
