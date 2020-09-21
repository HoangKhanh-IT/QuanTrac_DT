<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Parameter;
use DB;

class ParameterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $parameters =  Parameter::paginate(8);
        return view('admin.parameter.Parameter', ['parameters' => $parameters])->with('no', 1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $parameters = Parameter::all();
        return view('admin.parameter.ParameterCreate', ['parameters' => $parameters]);
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
                'name' => 'bail|required|max:255|unique:Parameter,name',
                'code' => 'bail|required|max:30|unique:Parameter,code',
            ],
            [
                'name.required' => 'Nhập tên thông số.',
                'name.max' => 'Tên không dài quá 255 ký tự!',
                'name.unique' => 'Tên thông số đã tồn tại.',
                'code.required' => 'Nhập mã thông số.',
                'code.max' => 'Mã không dài quá 30 ký tự!',
                'code.unique' => 'Mã thông số đã tồn tại.',
            ]
        );
        $parameters = new Parameter([
            'name' => $request->get('name'),
            'code' => $request->get('code')
        ]);
        $parameters->save();
        return redirect('danhmuc/Parameter')->with('success', 'Thêm mới thành công!');
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
            $parameters = Parameter::paginate(8);
            return view('admin.parameter.Parameter', ['parameters' => $parameters])->with('no', 1);
        }
        else
        {
            $search = trim(mb_strtoupper($search,'UTF-8'));
            $parameters = Parameter::where(DB::raw('UPPER(name)'), 'like', '%' .$search. '%')
                            ->orwhere(DB::raw('UPPER(code)'), 'like', '%' . $search . '%')->paginate(8);
           return view('admin.parameter.Parameter', ['parameters' => $parameters])->with('no', 1);
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
        $Parameter = Parameter::findOrFail($id);
        return view('admin.parameter.ParameterEdit', ['Parameter' => $Parameter]);
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
                'name' => 'bail|required|max:255|unique:Parameter,name,'.$id,
                'code' => 'bail|required|max:30|unique:Parameter,code,'.$id,
            ],
            [
                'name.required' => 'Nhập tên thông số.',
                'name.max' => 'Tên không dài quá 255 ký tự!',
                'name.unique' => 'Tên thông số đã tồn tại.',
                'code.required' => 'Nhập mã thông số.',
                'code.max' => 'Mã không dài quá 30 ký tự!',
                'code.unique' => 'Mã thông số đã tồn tại.',
            ]
        );
        $Parameter = Parameter::find($id);
        $Parameter->name=$request->get('name');
        $Parameter->code = $request->get('code');
        $Parameter->save();
        return redirect('danhmuc/Parameter')->with('success', 'Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $standardParameters = Parameter::find($id)->standardParameters()->get();
        if ($standardParameters->isNotEmpty()) {
            return redirect('danhmuc/Parameter')->with('alert', 'Xóa không thành công do dữ liệu còn tồn tại ở bảng Chỉ tiêu !');
        }
        
        $Parameter = Parameter::find($id);
        $Parameter->delete();
        return redirect('danhmuc/Parameter')->with('success', 'Xóa thành công!');

    }
}
