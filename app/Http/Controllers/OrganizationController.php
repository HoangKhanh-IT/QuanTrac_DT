<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Organization;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $Organizations = Organization::paginate(8);
        return view('admin.organization.Organization',['Organizations' => $Organizations])->with('no', 1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $Organizations = Organization::all();
        return view('admin.organization.OrganizationCreate', ['Organizations' => $Organizations]);
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
                'name' => 'bail|required|max:255|unique:Organization,name'
            ],
            [
                'name.required' => 'Nhập tên tổ chức.',
                'name.max' => 'Tên không dài quá 255 ký tự!',
                'name.unique' => 'Tên tổ chức đã tồn tại.'
            ]
        );
        $Organization = new Organization([
            'name' => $request->get('name'),
            'description' => $request->get('description')
        ]);
        $Organization->save();
        return redirect('danhmuc/Organization')->with('success', 'Thêm mới thành công!');
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
            $Organizations = Organization::paginate(8);
            return view('admin.organization.Organization',['Organizations' => $Organizations])->with('no', 1);
        } else {
            $search = trim(mb_strtoupper($search,'UTF-8'));
            $Organizations = Organization::where(DB::raw('UPPER(name)'), 'like', '%' .$search. '%')
                            ->orwhere(DB::raw('UPPER(description)'), 'like', '%' . $search . '%')->paginate(8);
             return view('admin.organization.Organization',['Organizations' => $Organizations])->with('no', 1);
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
        $Organization = Organization::findOrFail($id);
        return view('admin.organization.OrganizationEdit', ['Organization' => $Organization]);
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
                 'name' => 'bail|required|max:255|unique:Organization,name,'.$id,
            ],
            [
                'name.required' => 'Nhập tên tổ chức.',
                'name.max' => 'Tên không dài quá 255 ký tự!',
                'name.unique' => 'Tên tổ chức đã tồn tại.'
            ]
        );
        $Organization = Organization::find($id);
        $Organization->name = $request->get('name');
        $Organization->description = $request->get('description');
        $Organization->save();
        return redirect('danhmuc/Organization')->with('success', 'Cập nhật thành công!');
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
            $Observationstations = Organization::findOrFail($id)->Observationstations()->get();
            if ($Observationstations->isNotEmpty()) 
            {
                return redirect('danhmuc/Organization')->with('alert', 'Xóa không thành công do dữ liệu đã được tham chiếu đến bảng Trạm quan trắc!');
            } 

            $Organization = Organization::find($id);
            $Organization->delete();
            return redirect('danhmuc/Organization')->with('success', 'Xóa thành công!');
        }
        catch (\Exception $exception) 
        {
            return back()->withError($exception->getMessage());
        }
    }
}
