<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menus;

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
        $chucnangs = Menus::paginate(8);
        return view('admin.menu.Menu',['chucnangs' => $chucnangs] )->with('no', 1);
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
        return view('admin.menu.MenuCreate', ['chucnangs' => $chucnangs, 'nhomCNS' => $nhomCNS]);
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
                'oder' => 'bail|required|numeric'
            ],
            [
                'name.required' => 'Nhập tên chức năng.',
                'Link.required' => 'Nhập đường dẫn mặc định.',
                'oder.required' => 'Nhập thứ tự hiển thị.',
                'oder.numeric' => 'Thứ tự là dạng số.',
                'name.unique' => 'Tên chức năng đã tồn tại.',
                'Link.unique' => 'Đường dẫn mặc định đã tồn tại.'
            ]
        );
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
        $menu->save();
        return redirect('quantri/menu')->with('success', 'Thêm mới thành công!');
        //dd($menu);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        return view('admin.menu.Menuedit', ['MenuItem' => $MenuItem, 'nhomCNS' => $nhomCNS]);
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
                'name' => 'bail|required|unique:menus,name,'.$id,
                'Link' => 'bail|required|unique:menus,Link,'.$id,
                'oder' => 'bail|required|numeric'
            ],
            [
                'name.required' => 'Nhập tên chức năng.',
                'name.unique' => 'Tên chức năng đã tồn tại.',
                'Link.required' => 'Nhập đường dẫn mặc định.',
                'Link.unique' => 'Đường dẫn mặc định đã tồn tại.',
                'oder.required' => 'Nhập thứ tự hiển thị.',
                'oder.numeric' => 'Thứ tự là dạng số.',
                
            ]
        );
        $loaihinhchas = explode("_", $request->get('loaihinhcha'));
        $Chucnang = Menus::find($id);
        $Chucnang->name = $request->get('name');
        $Chucnang->Link = $request->get('Link');
        $Chucnang->title = $request->get('title');
        $Chucnang->parent_id = $loaihinhchas[0];
        $Chucnang->description = $request->get('description');
        $Chucnang->oder = $request->get('oder');
        $Chucnang->code = $loaihinhchas[1];
        $Chucnang->save();
        return redirect('quantri/menu')->with('success', 'Cập nhật thành công!');
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
        $Chucnang = Menus::find($id);
        $Chucnang->delete();

        return redirect('quantri/menu')->with('success', 'Xóa thành công!');
    }
}
