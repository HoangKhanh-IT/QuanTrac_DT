<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Qualityindex;

class QualityindexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $Qualityindexs = Qualityindex::paginate(8);
        return view('admin.qualityindex.Qualityindex', ['Qualityindexs' => $Qualityindexs])->with('no', 1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.qualityindex.QualityindexCreate');
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
                'name' => 'bail|required|max:255|unique:Qualityindex,name',
                'belowvalue' => 'bail|nullable|numeric',
                'abovevalue' => 'bail|nullable|numeric',
                'colorcode' => 'required',
                'purpose' => 'bail|required|max:255',
            ],
            [
                'name.required' => 'Nhập tên chỉ số.',
                'name.max' => 'Tên không dài quá 255 ký tự!',
                'name.unique' => 'Tên đã tồn tại!',
                'belowvalue.numeric' => 'Giá trị cận dưới là số.',
                'abovevalue.numeric' => 'Giá trị cận trên là số.',
                'colorcode.required' => 'Nhập mã màu.',
                'purpose.required' => 'Nhập mục đích.',
                'purpose.max' => 'Nhập mục đích không dài quá 255 ký tự!',
            ]
        );

        $Qualityindexs = new Qualityindex([
            'name' => $request->get('name'),
            'belowvalue' => $request->get('belowvalue'),
            'abovevalue' => $request->get('abovevalue'),
            'colorcode' => $request->get('colorcode'),
            'purpose' => $request->get('purpose'),
        ]);
        $Qualityindexs->save();
        return redirect('danhmuc/Qualityindex')->with('success', 'Thêm mới thành công!');
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
            $Qualityindexs = Qualityindex::paginate(8);
            return view('admin.qualityindex.Qualityindex', ['Qualityindexs' => $Qualityindexs])->with('no', 1);
        } 
        else 
        {
            $search = trim(mb_strtoupper($search,'UTF-8'));
            $Qualityindexs = Qualityindex::where(DB::raw('UPPER(name)'), 'like', '%' .$search. '%')
                            ->orwhere(DB::raw('UPPER(purpose)'), 'like', '%' . $search . '%')->paginate(8);
             return view('admin.qualityindex.Qualityindex', ['Qualityindexs' => $Qualityindexs])->with('no', 1);
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
        $Qualityindex = Qualityindex::findOrFail($id);
        return view('admin.qualityindex.QualityindexEdit',['Qualityindex' => $Qualityindex]);
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
                'name' => 'bail|required|max:255|unique:Qualityindex,name,'.$id,
                 'belowvalue' => 'bail|nullable|numeric',
                'abovevalue' => 'bail|nullable|numeric',
                'colorcode' => 'required',
                'purpose' => 'bail|required|max:255',
            ],
            [
                'name.required' => 'Nhập tên chỉ số.',
                'name.max' => 'Tên không dài quá 255 ký tự!',
                'name.unique' => 'Tên đã tồn tại!',
                'belowvalue.numeric' => 'Giá trị cận dưới là số.',
                'abovevalue.numeric' => 'Giá trị cận trên là số.',
                'colorcode.required' => 'Nhập mã màu.',
                'purpose.required' => 'Nhập mục đích.',
                'purpose.max' => 'Nhập mục đích không dài quá 255 ký tự!',
            ]
        );
        $Qualityindex = Qualityindex::findOrFail($id);
        $Qualityindex->name = $request->get('name');
        $Qualityindex->belowvalue = $request->get('belowvalue');
        $Qualityindex->abovevalue = $request->get('abovevalue');
        $Qualityindex->colorcode = $request->get('colorcode');
        $Qualityindex->purpose = $request->get('purpose');
        $Qualityindex->save();
        return redirect('danhmuc/Qualityindex')->with('success', 'Cập nhật thành công!');
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
            $Observations = Qualityindex::findOrFail($id)->Observations()->get();
            if ($Observations->isNotEmpty()) 
            {
                return redirect('danhmuc/Qualityindex')->with('alert', 'Xóa không thành công do dữ liệu đã được tham chiếu đến bảng Kết quả quan trắc!');
            } 
            $Qualityindex = Qualityindex::find($id);
            $Qualityindex->delete();
            return redirect('danhmuc/Qualityindex')->with('success', 'Xóa thành công!');
        }
        catch (\Exception $exception) 
        {
            return back()->withError($exception->getMessage());
        }
    }
}
