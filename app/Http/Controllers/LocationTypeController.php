<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\LocationType;

class LocationTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $LocationTypes = LocationType::paginate(10);
        return view('admin.location_type.LocationType', ['LocationTypes' => $LocationTypes])->with('no', 1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.location_type.LocationTypeCreate');
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
                'name' => 'bail|required|max:255|unique:LocationType,name',
            ],
            [
                'name.required' => 'Nhập tên.',
                'name.max' => 'Tên không dài quá 255 ký tự!',
                'name.unique' => 'Tên đã tồn tại.'
            ]
        );
        $LocationType = new LocationType([
                'name' => $request->get('name')
            ]);
        $LocationType->save();
        return redirect('danhmuc/LocationType')->with('success', 'Thêm mới thành công!');
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
        if ($search == null
        ) {
            # code...
            $LocationTypes = LocationType::paginate(10);
            return view('admin.location_type.LocationType', ['LocationTypes' => $LocationTypes])->with('no', 1);
        } 
        else 
        {
             $search = trim(mb_strtoupper($search,'UTF-8'));
            $LocationTypes = LocationType::where(DB::raw('UPPER(name)'), 'like', '%' .$search. '%')->paginate(10);
            return view('admin.location_type.LocationType', ['LocationTypes' => $LocationTypes])->with('no', 1);
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
        $LocationType = LocationType::findOrFail($id);
        return view('admin.location_type.LocationTypeEdit', ['LocationType' => $LocationType]);
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
                'name' => 'bail|required|max:255|unique:LocationType,name,'.$id,
            ],
            [
                'name.required' => 'Nhập tên.',
                'name.max' => 'Tên không dài quá 255 ký tự!',
                'name.unique' => 'Tên đã tồn tại.'
            ]
        );
        $LocationType = LocationType::find($id);
        $LocationType->name = $request->get('name');
        $LocationType->save();
        return redirect('danhmuc/LocationType')->with('success', 'Cập nhật thành công!');
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
        $LocationType = LocationType::find($id);
        $LocationType->delete();

        return redirect('danhmuc/LocationType')->with('success', 'Xóa thành công!');
    }
}
