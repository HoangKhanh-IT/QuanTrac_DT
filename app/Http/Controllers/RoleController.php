<?php

namespace App\Http\Controllers;

use DB;
use App\Menus;
use App\Permission;
use Illuminate\Http\Request;
use App\Role;
use App\role_permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $roles = Role::paginate(8);
        $chucnangs = Menus::whereNotNull('parent_id')->get();
        return view('admin.Role.Role',['roles' => $roles, 'chucnangs'=> $chucnangs])->with('no', 1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles =
            Role::paginate(30);
        $chucnangs = Menus::whereNotNull('parent_id')->get();
        return view(
            'admin.Role.RoleCreate',
            ['roles' => $roles, 'chucnangs' => $chucnangs]
        )->with('no', 1);
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
                'tennhom' => 'bail|required|unique:roles,name',
                'mota' => 'required',
                'permissions' => 'required'
                //'permissions[]' => 'required|in_array:[0, 100000000]'
            ],
            [
                'tennhom.required' => 'Nhập tên nhóm.',
                'tennhom.unique' => 'Tên nhóm đã tồn tại.',
                'mota.required' => 'Nhập mô tả.',
                'permissions.required' => 'Chọn quyền chức năng.'
            ]
        );
        \DB::beginTransaction();
        try{

            $role = new role([
                'name' => $request->get('tennhom'),
                'display_name' => $request->get('mota')
            ]);
            $permissions = $request->input('permissions');
            $save = $role ->save();
            $idRole = $role ->id;
            if($save) {
            foreach ($permissions as $key => $permission) {
                $per = new role_permission([
                        'role_id' => $idRole,
                        'permission_id' => $permission
                ]);
                $per->save();
                //echo ($permission);
                }
            }
            // }
            \DB::commit();
            return redirect('quantri/role')->with('success', 'Thêm mới thành công!');
            //dd($permissions);
        }catch (PDOException  $e){
            // echo $e->getMessage();
            \DB::rollBack();
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
        //
        $chucnangs = Menus::whereNotNull('parent_id')->get();
        $search = $request->search;
        if ($search == null) {
            $roles = Role::paginate(8);
            return view('admin.Role.Role',['roles' => $roles, 'chucnangs'=> $chucnangs])->with('no', 1);
        } 
        else 
        {
            $search = trim(mb_strtoupper($search,'UTF-8'));
            $roles = Role::where(DB::raw('UPPER(name)'), 'like', '%' .$search. '%')
                        ->orwhere(DB::raw('UPPER(display_name)'), 'like', '%' . $search . '%')->paginate(8);
            return view('admin.Role.Role',['roles' => $roles, 'chucnangs'=> $chucnangs])->with('no', 1);
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
        $role = Role::findOrFail($id);
        $roles =
            Role::paginate(30);
        $chucnangnhoms = role_permission::where('role_id', $id)->get();
        $chucnangs = Menus::whereNotNull('parent_id')->get();
        //dd($chucnangs);
        return view(
            'admin.Role.RoleEdit',
            ['role' => $role, 'chucnangs' => $chucnangs, 'chucnangnhoms' => $chucnangnhoms]
        )->with('no', 1);
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
                'tennhom' => 'bail|required|unique:roles,name, ' . $id . '',
                'mota' => 'required',
                'permissions' => 'required'
                //'permissions[]' => 'required|in_array:[0, 100000000]'
            ],
            [
                'tennhom.required' => 'Nhập tên nhóm.',
                'tennhom.unique' => 'Tên nhóm đã tồn tại.',
                'mota.required' => 'Nhập mô tả.',
                'permissions.required' => 'Chọn quyền chức năng.'
            ]
        );

        \DB::beginTransaction();
        try {

            $role = role::find($id);
            $role->name = $request->get('tennhom');
            $role->display_name = $request->get('mota');
            $trangthai = $role->save();
            $permissions = $request->input('permissions');
            if ($trangthai) {

                $res = role_permission::where('role_id', $id)->delete();
                if ($res) {
                    foreach ($permissions as $key => $permission) {
                        $per = new role_permission([
                            'role_id' => $id,
                            'permission_id' => $permission
                        ]);
                        $per->save();
                        //echo ($permission);
                    }
                }
            }
            \DB::commit();
            return redirect('quantri/role')->with('success', 'Sửa thành công!');
        }catch (PDOException  $e){
            // echo $e->getMessage();
            \DB::rollBack();
        }
        //return redirect('danhmuc/role')->with('success', 'Thêm mới thành công!');

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
        //dd($id);
        $permission = Menus::find($id);
        \DB::beginTransaction();
        try {
            $res = role_permission::where('role_id', $id)->delete();
            if ($res) {
                $role = role::find($id);
                $role->delete();
            }
            \DB::commit();
            return redirect('quantri/role')->with('success', 'Xóa thành công!');
        }catch (PDOException  $e){
            \DB::rollBack();
            echo $e->getMessage();
        }

    }
}
