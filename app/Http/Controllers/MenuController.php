<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission;
use App\Menus;
use DB;
class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $chucnangs1 = Menus::paginate(5);
        $chucnangs = Menus::all();
        return view('admin.menu.menus',['chucnangs' => $chucnangs, 'chucnangs1' => $chucnangs1])->with('no', 1);
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
        return view('admin.menu.MenusCreate', ['chucnangs' => $chucnangs, 'nhomCNS' => $nhomCNS]);
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
                'name' => 'bail|required|unique:menus,name',
                'Link' => 'bail|required|unique:menus,Link',
                'oder' => 'bail|required|numeric',
                'addmore.*.name' => 'bail|required|unique:permissions,name',
                'addmore.*.display_name' => 'bail|required'
            ],
            [
                'name.required' => 'Nhập tên chức năng.',
                'Link.required' => 'Nhập đường dẫn mặc định.',
                'oder.required' => 'Nhập thứ tự hiển thị.',
                'oder.numeric' => 'Thứ tự là dạng số.',
                'name.unique' => 'Tên chức năng đã tồn tại.',
                'Link.unique' => 'Đường dẫn mặc định đã tồn tại.',
                'addmore.*.display_name.required' => 'Nhập mô tả action.',
                'addmore.*.name.required' => 'Nhập tên action.',
                'addmore.*.name.unique' => 'Tên action là duy nhất.'
            ]
        );
        \DB::beginTransaction();
        try {
        $loaihinhchas = explode("_", $request->get('loaihinhcha'));
        $menu = new Menus([
            'name' => $request->get('name'),
            'Link' => $request->get('Link'),
            'title' => $request->get('title'),
            'parent_id' => $loaihinhchas[0],
            'description' => $request->get('description'),
            'oder' => $request->get('oder'),
            'code' => $loaihinhchas[1]
        ]);
            $actions = $request->addmore;
            //dd($menu, $actions);
            $saveMenu = $menu->save();
            $idMenu = $menu->id;
            if ($saveMenu) {
                for ($i = 0; $i < count($actions); $i++) {
                    $permission = new Permission([
                        'name' => $actions[$i]['name'],
                        'display_name' => $actions[$i]['display_name'],
                        'menus_id' => $idMenu
                    ]);
                    $permission->save();
                }
            }
            \DB::commit();
        return redirect('quantri/menu')->with('success', 'Thêm mới thành công!');
        } catch (PDOException  $e) {
            // echo $e->getMessage();
            \DB::rollBack();
        }
        //dd($request);

        //return redirect('quantri/menu')->with('success', 'Thêm mới thành công!');
        //dd($menu);
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
        $chucnangs = Menus::all();
        $search = $request->search;
        if ($search == null) {
            $chucnangs1 = Menus::paginate(5);
            return view('admin.menu.menus',['chucnangs' => $chucnangs, 'chucnangs1' => $chucnangs1])->with('no', 1);
        } 
        else 
        {
            $search = trim(mb_strtoupper($search,'UTF-8'));
            $chucnangs1 = Menus::where(DB::raw('UPPER(name)'), 'like', '%' .$search. '%')
                        ->orwhere(DB::raw('UPPER(title)'), 'like', '%' . $search . '%')
                        ->orwhere(DB::raw('UPPER(description)'), 'like', '%' . $search . '%')->paginate(5);
            return view('admin.menu.menus',['chucnangs' => $chucnangs, 'chucnangs1' => $chucnangs1])->with('no', 1);
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
        $MenuItem = Menus::findOrFail($id);
        $nhomCNS = Menus::whereNull('parent_id')->get();
        $permissions = Permission::where('menus_id',$id)->get();
        //dd($MenuItem, $permissions);
        return view('admin.menu.MenusEdit', ['MenuItem' => $MenuItem, 'nhomCNS' => $nhomCNS, 'permissions' => $permissions]);
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
        // $permissions = $request->addmore;
        // for ($i = 0; $i < count($permissions); $i++) {
        //     if ($permissions[$i]['name'] == "moi") {
        //         # code...
        //     }
        //     $permission = new Permission([
        //         'name' => $permissions[$i]['name'],
        //         'display_name' => $permissions[$i]['display_name'],
        //         'menus_id' => 0
        //     ]);
        //     $permission->save();
        // }
        // dd($request);
        $request->validate(
            [
                'name' => 'bail|required|unique:menus,name,'. $id,
                'Link' => 'bail|required|unique:menus,Link,'. $id,
                'oder' => 'bail|required|numeric',
                'addmore.*.name' => 'required',
                'addmore.*.display_name' => 'required'
            ],
            [
                'name.required' => 'Nhập tên chức năng.',
                'Link.required' => 'Nhập đường dẫn mặc định.',
                'oder.required' => 'Nhập thứ tự hiển thị.',
                'oder.numeric' => 'Thứ tự là dạng số.',
                'name.unique' => 'Tên chức năng đã tồn tại.',
                'Link.unique' => 'Đường dẫn mặc định đã tồn tại.',
                'addmore.*.display_name.required' => 'Nhập mô tả Action.',
                'addmore.*.name.required' => 'Nhập tên action.'
            ]
        );
        if (!empty($request->addmore)) {
            //$actions = $request->addmore;
            //dd($actions);
            // $actions = $request->addmore;
            // $str = "";
            // foreach ($actions as $key => $action) {
            //     # code...
            //     $str =$str."_". $action['name'];

            // }
            // dd($str);
            \DB::beginTransaction();
            try {
        $loaihinhchas = explode("_", $request->get('loaihinhcha'));
        $Chucnang = Menus::find($id);
        $Chucnang->name = $request->get('name');
        $Chucnang->Link = $request->get('Link');
        $Chucnang->title = $request->get('title');
        $Chucnang->parent_id = $loaihinhchas[0];
        $Chucnang->description = $request->get('description');
        $Chucnang->oder = $request->get('oder');
        $Chucnang->code = $loaihinhchas[1];
                //dd($Chucnang);
                $savemenu = $Chucnang->save();
                if ($savemenu) {
                    $actions = $request->addmore;
                    $res = Permission::where('menus_id', $id)->delete();
                    if ($res) {
                        foreach ($actions as $key => $action) {
                            $permission = new Permission([
                                'name' => $action['name'],
                                'display_name' => $action['display_name'],
                                'menus_id' => $id
                            ]);
                            $permission->save();
                        }
                    }
                }
                \DB::commit();
                return redirect('quantri/menu')->with('success', 'Sửa thành công!');
            } catch (PDOException  $e) {
                // echo $e->getMessage();
                \DB::rollBack();
            }
        }else{
            return redirect('quantri/menu.edit/'.$id)->with('success', 'Khởi tạo Action cho chức năng!');
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
        \DB::beginTransaction();
        try {
            $res = Permission::where('menus_id', $id)->delete();
            if ($res) {
        $Chucnang = Menus::find($id);
        $Chucnang->delete();
            }
            //dd($Chucnang);
            \DB::commit();
        return redirect('quantri/menu')->with('success', 'Xóa thành công!');
        } catch (PDOException  $e) {
            // echo $e->getMessage();
            \DB::rollBack();
        }
    }
}
