<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\View;
use Session;
use App\CategoryPost;
use App\Post;
use Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Posts = Post::orderBy('id','DESC')->paginate(8);
        return view('admin.post.ListPost',['Posts' => $Posts])->with('no', 1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $CategoryPosts =CategoryPost::where('status',0)->orderBy('order','ASC')->get();
        $Posts = Post::get();
        return view('admin.post.CreatePost')->with(compact('CategoryPosts','Posts'));
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
                'title' => 'bail|required|unique:Post,title|max:255',
                'contents' => 'required',
                //'image' => 'bail|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'image' => 'bail|nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'authors' =>  'bail|required|max:255',
                'sources' =>  'bail|required|max:255',
            ],
            [
                'title.required' => 'Nhập tiêu đề bài viết!',
                'title.unique' => 'Tiêu đề bài viết đã tồn tại!',
                'title.max' => 'Tiêu đề bài viết không quá 255 ký tự!',
                'contents.required' => 'Nhập nội dung bài viết!',
                //'image.required' => 'Nhập hình ảnh bài viết!',
                'image.image' => 'Tệp tin phải là hình ảnh!',
                'image.mimes' => 'Định dạng tệp tin ảnh:jpeg,png,jpg,gif,svg !',
                'image.max' => 'Dung lượng tệp tin ảnh tối đa 2mb!',
                'authors.required' => 'Nhập tác giả bài viết!',
                'authors.max' => 'Tác giả bài viết không quá 255 ký tự!',
                'sources.required' => 'Nhập nguồn bài viết!',
                'sources.max' => 'Nguồn bài viết không quá 255 ký tự!',
            ]
        );
        $data =  $request->all();
        $post = new Post();
        $post->title = $data['title'];
        $post->slug =  $data['slug'];
        $post->desc=  $data['desc'];
        $post->metadesc=  $data['metadesc'];
        $post->status=  $data['status'];
        $post->metakeywords=  $data['metakeywords'];
        $post->contents=  $data['contents'];
        $post->catepostid=  $data['catepostid'];
        $post->imagedesc=  $data['imagedesc'];
        $post->authors=  $data['authors'];
        $post->sources=  $data['sources'];
        $get_image = $request->file('image');
        if($get_image)
        {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            //Tạo ảnh thumbnail
            $destinationPath = public_path('/uploads/post/thumbnail');
            $img = Image::make($get_image->path());
            $img->resize(100, 100, function ($constraint) {
            $constraint->aspectRatio();
            })->save($destinationPath.'/'.$new_image);
            //Upload ảnh gốc
            $get_image -> move('public/uploads/post',$new_image);
            $post->image = $new_image;

        }
        $post->save();
        return redirect('quanly/Post')->with('success', 'Thêm mới thành công!');
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
            $Posts = Post::orderBy('id','DESC')->paginate(8);
            return view('admin.post.ListPost', ['Posts' => $Posts])->with('no', 1);
        } 
        else 
        {
            $search = trim(mb_strtoupper($search,'UTF-8'));
            $Posts = Post::select('Post.*')
                ->where(DB::raw('UPPER("Post"."title")'), 'like', '%' .$search. '%')
                ->orwhere(DB::raw('UPPER("Post"."contents")'), 'like', '%' .$search. '%')
                ->orwhere(DB::raw('UPPER("Post"."desc")'), 'like', '%' .$search. '%')
                ->orwhere(DB::raw('UPPER("Post"."metakeywords")'), 'like', '%' .$search. '%')
                ->orwhere(DB::raw('UPPER("Post"."authors")'), 'like', '%' .$search. '%')
                ->join('CategoryPost', 'CategoryPost.id', '=', 'Post.catepostid')
                ->orWhere(DB::raw('UPPER("CategoryPost"."name")'), 'like', '%' . $search . '%')->paginate(8);
            return view('admin.post.ListPost',['Posts' => $Posts])->with('no', 1);
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
        $CategoryPosts =CategoryPost::where('status',0)->orderBy('order','ASC')->get();
        $Posts = Post::get();
        $PostItem = Post::findOrFail($id);
        return view('admin.post.EditPost', compact('PostItem', 'Posts','CategoryPosts'));
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
                'title' => 'bail|required|max:255|unique:Post,title,'.$id,
                'contents' => 'required',
                //'image' => 'bail|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'image' => 'bail|nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'authors' =>  'bail|required|max:255',
                'sources' =>  'bail|required|max:255',
            ],
            [
                'title.required' => 'Nhập tiêu đề bài viết!',
                'title.max' => 'Tiêu đề bài viết không quá 255 ký tự!',
                'title.unique' => 'Tiêu đề bài viết đã tồn tại!',
                'contents.required' => 'Nhập nội dung bài viết!',
                //'image.required' => 'Nhập hình ảnh bài viết!',
                'image.image' => 'Tệp tin phải là hình ảnh!',
                'image.mimes' => 'Định dạng tệp tin ảnh:jpeg,png,jpg,gif,svg !',
                'image.max' => 'Dung lượng tệp tin ảnh tối đa 2mb!',
                'authors.required' => 'Nhập tác giả bài viết!',
                'authors.max' => 'Tác giả bài viết không quá 255 ký tự!',
                'sources.required' => 'Nhập nguồn bài viết!',
                'sources.max' => 'Nguồn bài viết không quá 255 ký tự!',
            ]
        );
        $data =  $request->all();
        $post = Post::find($id);
        // $Post->name = $request->get('title');
        // $Post->slug = $request->get('slug');
        // $Post->desc= $request->get('desc');
        // $Post->status= $request->get('status');
        // $Post->metakeywords= $request->get('metakeywords');
        // $Post->contents= $request->get('contents');

        $post->title = $data['title'];
        $post->slug =  $data['slug'];
        $post->desc=  $data['desc'];
        $post->metadesc=  $data['metadesc'];
        $post->status=  $data['status'];
        $post->metakeywords=  $data['metakeywords'];
        $post->contents=  $data['contents'];
        $post->catepostid=  $data['catepostid'];
        $post->imagedesc=  $data['imagedesc'];
        $post->authors=  $data['authors'];
        $post->sources=  $data['sources'];
        $get_image = $request->file('image');
        if($get_image)
        {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
             //Tạo ảnh thumbnail
            $destinationPath = public_path('/uploads/post/thumbnail');
            $img = Image::make($get_image->path());
            $img->resize(100, 100, function ($constraint) {
            $constraint->aspectRatio();
            })->save($destinationPath.'/'.$new_image);
            //Upload ảnh gốc
            $get_image -> move('public/uploads/post',$new_image);
            $post->image = $new_image;
        }
        $post->save();
        return redirect('quanly/Post')->with('success', 'Cập nhật thành công!');
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
        try
        {
             $Post = Post::findOrFail($id);
             $post_image = $Post->image;
             $path = 'public/uploads/post/'.$post_image;
             if(is_file($path))
             {
                 unlink($path);
             }
             $Post->delete();
             return redirect('quanly/Post')->with('success', 'Xóa thành công!');
        }
        catch (\Exception $exception) 
        {
            return back()->withError($exception->getMessage());
        }
    }
}
