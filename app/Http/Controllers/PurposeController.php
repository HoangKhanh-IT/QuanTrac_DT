<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Purpose;

class PurposeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $Purposes = Purpose::paginate(10);
        return view('admin.purpose.Purpose', ['Purposes' => $Purposes])->with('no', 1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $Purposes = Purpose::all();
        return view('admin.purpose.PurposeCreate', ['Purposes' => $Purposes]);
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
                'name' => 'bail|required|max:255|unique:Purpose,name',
            ],
            [
                'name.required' => 'Nhập tên mục đích sử dụng.',
                'name.max' => 'Tên không dài quá 255 ký tự!',
                'name.unique' => 'Mục đích sử dụng đã tồn tại.'
            ]
        );
        $Purpose = new Purpose([
            'name' => $request->get('name'),
            'description' => $request->get('description')
        ]);
        $Purpose->save();
        return redirect('danhmuc/Purpose')->with('success', 'Thêm mới thành công!');
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
            $Purposes = Purpose::paginate(10);
             return view('admin.purpose.Purpose', ['Purposes' => $Purposes])->with('no', 1);
        } 
        else
        {
             $search = trim(mb_strtoupper($search,'UTF-8'));
            $Purposes = Purpose::where(DB::raw('UPPER(name)'), 'like', '%' .$search. '%')
                            ->orwhere(DB::raw('UPPER(description)'), 'like', '%' . $search . '%')->paginate(10);
            return view('admin.purpose.Purpose', ['Purposes' => $Purposes])->with('no', 1);
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
        $Purpose = Purpose::findOrFail($id);
        return view('admin.purpose.PurposeEdit', ['Purpose' => $Purpose]);
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
                 'name' => 'bail|required|max:255|unique:Purpose,name,'.$id,
            ],
            [
                'name.required' => 'Nhập tên mục đích sử dụng.',
                'name.max' => 'Tên không dài quá 255 ký tự!',
                'name.unique' => 'Mục đích sử dụng đã tồn tại.'
            ]
        );
        $Purpose = Purpose::find($id);
        $Purpose->name = $request->get('name');
        $Purpose->description = $request->get('description');
        $Purpose->save();
        return redirect('danhmuc/Purpose')->with('success', 'Cập nhật thành công!');
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
        $Purpose = Purpose::find($id);
        $Purpose->delete();

        return redirect('danhmuc/Purpose')->with('success', 'Xóa thành công!');
    }
}
