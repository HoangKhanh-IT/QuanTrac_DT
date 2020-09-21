<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $Categorys = Category::paginate(8);
        return view( 'admin.category.Category',['Categorys' => $Categorys])->with('no', 1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.category.CategoryCreate');
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
                'name' => 'bail|required|unique:Category,name|max:255'
            ],
            [
                'name.required' => 'Nhập tên.',
                'name.unique' => 'Tên đã tồn tại.',
                'name.max' => 'Tên loại trạm không quá 255 ký tự.',
            ]
        );
        $Category = new Category([
            'name' => $request->get('name')
        ]);
        $Category->save();
        return redirect('danhmuc/Category')->with('success', 'Thêm mới thành công!');
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
            # code...
            $Categorys = Category::paginate(8);
           return view( 'admin.category.Category',['Categorys' => $Categorys])->with('no', 1);
        } 
        else 
        {
             $search = trim(mb_strtoupper($search,'UTF-8'));
            $Categorys = Category::where(DB::raw('UPPER(name)'), 'like', '%' . $search . '%')->paginate(8);
           return view( 'admin.category.Category',['Categorys' => $Categorys])->with('no', 1);
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
        $Category = Category::findOrFail($id);
        return view('admin.category.CategoryEdit', ['Category' => $Category]);
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
                'name' => 'bail|required|max:255|unique:Category,name,'.$id
            ],
            [
                'name.required' => 'Nhập tên loại trạm.',
                'name.max' => 'Tên loại trạm không quá 255 ký tự.',
                'name.unique' => 'Tên loại trạm đã tồn tại.'
            ]
        );
        $Category = Category::find($id);
        $Category->name = $request->get('name');
        $Category->save();
        return redirect('danhmuc/Category')->with('success', 'Cập nhật thành công!');
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
        $Observationstations = Category::find($id)->Observationstations()->get();
        if ($Observationstations->isNotEmpty()) {
            return redirect('danhmuc/Category')->with('alert', 'Xóa không thành công do dữ liệu còn tồn tại ở bảng Trạm quan trắc!');
            //dd('Khong Rong');
            //dd($standardParameters->id);
        } else {
        $Category = Category::find($id);
        $Category->delete();

        return redirect('danhmuc/Category')->with('success', 'Xóa thành công!');
            //dd('Rong');
        }
    }
}
