<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\View;
use Session;
use App\CategoryPost;

class CatePostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $CategoryPosts = CategoryPost::orderBy('order','ASC')->paginate(10);
        return view('admin.category_post.ListCatePost',['CategoryPosts' => $CategoryPosts])->with('no', 1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $CategoryPosts = CategoryPost::get();
        return view('admin.category_post.CategoryPostCreate', ['CategoryPosts' => $CategoryPosts]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $request->validate(
            [
                'name' => 'bail|required|unique:CategoryPost,name|max:255',
                'order' => 'bail|required|numeric',
            ],
            [
                'name.required' => 'Nhập tên danh mục bài viết!',
                'name.unique' => 'Tên danh mục bài viết đã tồn tại!',
                'name.max' => 'Tên danh mục bài viết không quá 255 ký tự!',
                'order.required' => 'Nhập thứ tự hiển thị!',
                'order.numeric' => 'Thứ tự hiển thị phải là số!',
            ]
        );

        $CategoryPost = new CategoryPost([
            'name' => $request->get('name'),
            'slug' => $request->get('slug'),
            'desc' => $request->get('desc'),
            'status' => $request->get('status'),
            'keywords' => $request->get('keywords'),
            'order' => $request->get('order'),
            'parentcateid' => $request->get('parentcateid')
        ]);
        $CategoryPost->save();
        return redirect('danhmuc/CatePost')->with('success', 'Thêm mới thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
          $search = $request->search;
        if ($search == null) 
        {
            $CategoryPosts = CategoryPost::orderBy('order','ASC')->paginate(10);
            return view('admin.category_post.ListCatePost', ['CategoryPosts' => $CategoryPosts])->with('no', 1);
        } 
        else 
        {
            $search = trim(mb_strtoupper($search,'UTF-8'));
            $CategoryPosts = CategoryPost::where(DB::raw('UPPER(name)'), 'like', '%' . $search . '%')
                                        ///->orwhere(DB::raw('UPPER(desc)'), 'like', '%' . $search . '%') --trùng từ khóa DESC
                                        ->orwhere(DB::raw('UPPER(slug)'), 'like', '%' . $search . '%')
                                        ->orwhere(DB::raw('UPPER(keywords)'), 'like', '%' . $search . '%')->paginate(10);
            return view('admin.category_post.ListCatePost',['CategoryPosts' => $CategoryPosts])->with('no', 1);
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
        $CategoryPosts = CategoryPost::get();
        $CategoryPostItem = CategoryPost::findOrFail($id);
        return view('admin.category_post.CategoryPostEdit', compact('CategoryPostItem', 'CategoryPosts'));
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
         $request->validate(
            [
                'name' => 'bail|required|max:255|unique:CategoryPost,name,'.$id,
                'order' => 'bail|required|numeric',
            ],
            [
                'name.required' => 'Nhập tên danh mục bài viết!',
                'name.max' => 'Tên danh mục bài viết không quá 255 ký tự!',
                'name.unique' => 'Tên danh mục bài viết đã tồn tại!',
                'order.required' => 'Nhập thứ tự hiển thị!',
                'order.numeric' => 'Thứ tự hiển thị phải là số!',
            ]
        );

        $CategoryPost = CategoryPost::find($id);
        $CategoryPost->name = $request->get('name');
        $CategoryPost->slug = $request->get('slug');
        $CategoryPost->desc= $request->get('desc');
        $CategoryPost->status= $request->get('status');
        $CategoryPost->keywords= $request->get('keywords');
        $CategoryPost->order= $request->get('order');
        $CategoryPost->parentcateid= $request->get('parentcateid');
        $CategoryPost->save();
        return redirect('danhmuc/CatePost')->with('success', 'Cập nhật thành công!');
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
         $CategoryPost = CategoryPost::find($id);
         $CategoryPost->delete();

         return redirect('danhmuc/CatePost')->with('success', 'Xóa thành công!');
    }
}
