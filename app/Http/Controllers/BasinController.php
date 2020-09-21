<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Basin;
use \Illuminate\Validation\Rule;

class BasinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         $Basins = Basin::paginate(8);
        return view('admin.basin.ListBasin',['Basins' => $Basins])->with('no', 1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $Basins = Basin::all();
        return view('admin.basin.CreateBasin', ['Basins' => $Basins]);
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
                'riverid' => 'bail|nullable|unique:Basin,riverid|max:50',
                'name' => 'bail|required|unique:Basin,name|max:255',
                'riverbasinarea' =>'nullable|numeric',
                'normalwaterlevel' =>'nullable|numeric',
            ],
            [
                'riverid.unique' => 'Mã lưu vực đã tồn tại!',
                'riverid.max' => 'Mã lưu vực không dài quá 50 ký tự!',
                'name.required' => 'Nhập tên lưu vực!',
                'name.unique' => 'Tên lưu vực đã tồn tại!',
                'name.max' => 'Tên lưu vực không dài quá 255 ký tự!',
                'riverbasinarea.numeric' => 'Diện tích lưu vực sông phải là số.',
                'normalwaterlevel.numeric' => 'Mực nước dâng bình thường phải là số.',
            ]
        );

        $Basin = new Basin([
            'riverid' => $request->get('riverid'),
            'name' => $request->get('name'),
            'parentriverbasinid' => $request->get('parentriverbasinid'),
            'master'=> $request->get('master'),
            'purpose' => $request->get('purpose'),
            'surfaceareanwt' => $request->get('surfaceareanwt'),
            'netcapacity' => $request->get('netcapacity'),
            'deadcapacity' => $request->get('deadcapacity'),
            'risingofnormalwaterlevel' => $request->get('risingofnormalwaterlevel'),
            'deadwaterlevel'=> $request->get('deadwaterlevel'),
            'beginning'=> $request->get('beginning'),
            'termini'=> $request->get('termini'),
            'length'=> $request->get('length'),
            'riverbasinarea'=> $request->get('riverbasinarea'),
            'averageflowrate'=> $request->get('averageflowrate'),
            'capacity'=> $request->get('capacity'),
            'normalwaterlevel'=> $request->get('normalwaterlevel'),
            'standard'=> $request->get('standard'),
            'description' => $request->get('description')
        ]);
        $Basin->save();
        return redirect('danhmuc/Basin')->with('success', 'Thêm mới thành công!');
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
            $Basins = Basin::paginate(8);
            return view('admin.basin.ListBasin', ['Basins' => $Basins])->with('no', 1);
        } 
        else 
        {
            $search = trim(mb_strtoupper($search,'UTF-8'));
            //$Basins = Basin::whereRaw('UPPER(name) LIKE (?)', ["%{$search1}%"])
            $Basins = Basin::where(DB::raw('UPPER(name)'), 'LIKE' , '%'.$search.'%')
            ->orwhere(DB::raw('UPPER(description)'), 'LIKE', '%'.$search.'%')
            ->orwhere(DB::raw('UPPER(master)'), 'LIKE', '%'.$search.'%')
            ->orwhere(DB::raw('UPPER(purpose)'), 'LIKE', '%'.$search.'%')->paginate(8);
            return view('admin.basin.ListBasin', ['Basins' => $Basins])->with('no', 1);
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
        $Basins = Basin::all();
        $Basin = Basin::findOrFail($id);
        return view('admin.basin.EditBasin', ['Basin' => $Basin, 'Basins' => $Basins]);
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
                 'riverid' => 'bail|nullable|unique:Basin,riverid|max:50',
                'name' => 'bail|required|unique:Basin,name|max:255',
                'riverbasinarea' =>'nullable|numeric',
                'normalwaterlevel' =>'nullable|numeric',
            ],
            [
                'riverid.unique' => 'Mã lưu vực đã tồn tại!',
                'riverid.max' => 'Mã lưu vực không dài quá 50 ký tự!',
                'name.required' => 'Nhập tên lưu vực!',
                'name.unique' => 'Tên lưu vực đã tồn tại!',
                'name.max' => 'Tên lưu vực không dài quá 255 ký tự!',
                'riverbasinarea.numeric' => 'Diện tích lưu vực sông phải là số.',
                'normalwaterlevel.numeric' => 'Mực nước dâng bình thường phải là số.',
            ]
        );

        $Basin =  Basin::find($id);
            $Basin ->riverid = $request->get('riverid');
            $Basin ->name = $request->get('name');
            $Basin ->parentriverbasinid = $request->get('parentriverbasinid');
            $Basin ->master = $request->get('master');
            $Basin ->purpose = $request->get('purpose');
            $Basin ->surfaceareanwt = $request->get('surfaceareanwt');
            $Basin ->netcapacity = $request->get('netcapacity');
            $Basin ->deadcapacity = $request->get('deadcapacity');
            $Basin ->risingofnormalwaterlevel = $request->get('risingofnormalwaterlevel');
            $Basin ->deadwaterlevel = $request->get('deadwaterlevel');
            $Basin ->beginning = $request->get('beginning');
            $Basin ->termini = $request->get('termini');
            $Basin ->length = $request->get('length');
            $Basin ->riverbasinarea = $request->get('riverbasinarea');
            $Basin ->averageflowrate = $request->get('averageflowrate');
            $Basin ->capacity = $request->get('capacity');
            $Basin ->normalwaterlevel = $request->get('normalwaterlevel');
            $Basin ->standard = $request->get('standard');
            $Basin ->description = $request->get('description');
        $Basin->save();
        return redirect('danhmuc/Basin')->with('success', 'Cập nhật thành công!');
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
            $Observationstations = Basin::findOrFail($id)->Observationstations()->get();
            if ($Observationstations->isNotEmpty()) 
            {
                return redirect('danhmuc/Basin')->with('alert', 'Xóa không thành công do dữ liệu đã được tham chiếu bảng Trạm quan trắc!');
            } 
            $DischargePoints = Basin::findOrFail($id)->DischargePoints()->get();
            if ($DischargePoints->isNotEmpty()) 
            {
                return redirect('danhmuc/Basin')->with('alert', 'Xóa không thành công do dữ liệu đã được tham chiếu bảng Điểm xả nước thải!');
            } 

            $Basin = Basin::findOrFail($id);
            $Basin->delete();
            return redirect('danhmuc/Basin')->with('success', 'Xóa thành công!');
        }
        catch (\Exception $exception) 
        {
            return back()->withError($exception->getMessage());
        }
    }
}
