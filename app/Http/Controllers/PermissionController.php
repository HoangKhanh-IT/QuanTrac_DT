<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission;
use App\menus;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $chucnangs = Menus::paginate(8);
        return view(
            'admin.permission.Permission',
            ['chucnangs' => $chucnangs]
        )->with('no', 1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $chucnangs = Menus::all();
        $nhomCNS = Menus::whereNull('parent_id')->get();
        return view('admin.permission.PermissionCreate', ['chucnangs' => $chucnangs, 'nhomCNS' => $nhomCNS]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'addmore.*.name' => 'required|unique:permissions,name',
            'addmore.*.display_name' => 'required',
        ],[
            'addmore.*.name.required' => 'Nhập mô tả.',
            'addmore.*.display_name.required' => 'Nhập tên action.',
            'addmore.*.name.unique' => 'Tên action là duy nhất.'
        ]);
        //
        echo ($request->loaihinhcha);
        if($request->loaihinhcha === 'null'){
            return redirect('quantri/permission.create')->with('success', 'Chọn chức năng!');
        }else{
            $loaihinhchas = explode("_", $request->get('loaihinhcha'));
            foreach ($request->addmore as $key) {
                # code...
            }
            $test = $request->addmore;
            //dd($test[0]['name']);
            for ($i = 0; $i < count($test); $i++) {
                $permission = new Permission([
                    'name' => $test[$i]['name'],
                    'display_name' => $test[$i]['display_name'],
                    'menus_id' => $loaihinhchas[0]
                ]);
                $permission->save();
            }
            return redirect('quantri/permission')->with('success', 'Thêm mới thành công!');
        }
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
        dd($request);

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

        $PermissionItem = Permission::findOrFail($id);
        $chucnangs = Menus::all();
        $nhomCNS = Menus::whereNull('parent_id')->get();
        return view('admin.permission.PermissionEdit', ['chucnangs' => $chucnangs, 'nhomCNS' => $nhomCNS, 'PermissionItem' => $PermissionItem]);
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
                'addmore.*.name' => 'required',
                'addmore.*.display_name' => 'required',
            ],
            [
                'addmore.*.name.required' => 'Nhập tên action.',
                'addmore.*.display_name.required' => 'Nhập mô tả.'
            ]
        );
        if ($request->loaihinhcha === 'null') {
            return redirect(route('permission.edit', $id))->with('success', 'Chọn chức năng!');
        } else {
            $loaihinhchas = explode("_", $request->get('loaihinhcha'));
            $item = $request->addmore;
            for ($i = 0; $i < count($item); $i++) {
                $permission = Permission::find($id);
                $permission->name = $item[$i]['name'];
                $permission->display_name = $item[$i]['display_name'];
                $permission->menus_id = $loaihinhchas[0];
                $permission->save();
                //dd($item[$i]['name']);
            }
            return redirect('quantri/permission')->with('success', 'Sửa thành công!');
        }
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
        //
        $permission = Menus::find($id);
        $permission->delete();

        return redirect('quantri/permission')->with('success', 'Xóa thành công!');
    }
}
