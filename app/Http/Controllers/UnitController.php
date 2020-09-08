<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Unit;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $Units =  Unit::paginate(10);
        return view('admin.unit.Unit', ['Units' => $Units])->with('no', 1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $Units = Unit::all();
        return view('admin.unit.UnitCreate', ['Units' => $Units]);
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
                'name' => 'bail|required|max:255|unique:Unit,name',
                'code' => 'bail|required|max:30|unique:Unit,code',
            ],
            [
                'name.required' => 'Nhập tên đơn vị đo.',
                'name.max' => 'Tên không dài quá 255 ký tự!',
                'name.unique' => 'Tên đơn vị đo đã tồn tại.',
                'code.required' => 'Nhập mã đơn vị đo.',
                'code.max' => 'Mã không dài quá 30 ký tự!',
                'code.unique' => 'Mã đơn vị đo đã tồn tại.',
            ]
        );
        $Unit = new Unit([
            'name' => $request->get('name'),
            'code' => $request->get('code')
        ]);
        $Unit->save();
        return redirect('danhmuc/Unit')->with('success', 'Thêm mới thành công!');
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
        //
        $search = $request->search;
        if ($search == null) {
            # code...
            $Units = Unit::paginate(10);
            return view('admin.unit.Unit', ['Units' => $Units])->with('no', 1);
        } 
        else 
        {
            $search = trim(mb_strtoupper($search,'UTF-8'));
            $Units = Unit::where(DB::raw('UPPER(name)'), 'like', '%' .$search. '%')
                        ->orwhere(DB::raw('UPPER(code)'), 'like', '%' . $search . '%')->paginate(10);
             return view('admin.unit.Unit', ['Units' => $Units])->with('no', 1);
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
        $Unit = Unit::findOrFail($id);
        return view('admin.unit.UnitEdit', ['Unit' => $Unit]);
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
                'name' => 'bail|required|max:255|unique:Unit,name,'.$id,
                'code' => 'bail|required|max:30|unique:Unit,code,'.$id,
            ],
            [
                'name.required' => 'Nhập tên đơn vị đo.',
                'name.max' => 'Tên không dài quá 255 ký tự!',
                'name.unique' => 'Tên đơn vị đo đã tồn tại.',
                'code.required' => 'Nhập mã đơn vị đo.',
                'code.max' => 'Mã không dài quá 30 ký tự!',
                'code.unique' => 'Mã đơn vị đo đã tồn tại.',
            ]
        );
        $Unit = Unit::find($id);
        $Unit->name = $request->get('name');
        $Unit->code = $request->get('code');
        $Unit->save();
        return redirect('danhmuc/Unit')->with('success', 'Cập nhật thành công!');
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
        $Unit = Unit::find($id);
        $Unit->delete();

        return redirect('danhmuc/Unit')->with('success', 'Xóa thành công!');
    }
}
