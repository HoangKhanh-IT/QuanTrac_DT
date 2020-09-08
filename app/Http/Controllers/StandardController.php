<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Standard;
use App\ObservationType;
use Carbon\Carbon;

class StandardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $Standards = Standard::paginate(10);
        return view( 'admin.standard.Standards',['Standards' => $Standards])->with('no', 1);
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $ObservationTypes = ObservationType::all();
        return view('admin.standard.StandardCreate', ['ObservationTypes' => $ObservationTypes]);
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
                'name' => 'bail|required|max:255|unique:Standard,name',
                'symbol' => 'bail|required|max:100|unique:Standard,symbol',
            ],
            [
                'name.required' => 'Nhập tên quy chuẩn/tiêu chuẩn.',
                'name.max' => 'Tên không dài quá 255 ký tự!',
                'name.unique' => 'Tên đã tồn tại!',
                'symbol.required' => 'Nhập kí hiệu.',
                'symbol.max' => 'Nhập kí hiệu không dài quá 100 ký tự!',
                'symbol.unique' => 'Nhập kí hiệu đã tồn tại!',
            ]
        );
        $date = null;
        $temp = $request->input('dateFrom');
        if($temp!=null && $temp!="")
        {
            $dtemp = explode("-", $temp );
            //$date = date_format(date_create($temp),"d/m/Y");
            $date = Carbon::create($dtemp[2],$dtemp[1],$dtemp[0]);
        }
        $get_attachment = $request->file('attachment');
        $new_attachment = "";
        if($get_attachment)
        {
            $get_name_attachment = $get_attachment->getClientOriginalName();
            $name_attachment = current(explode('.', $get_name_attachment));
            $new_attachment =  $name_attachment.rand(0,99).'.'.$get_attachment->getClientOriginalExtension();
            $get_attachment -> move('public/uploads/standards',$new_attachment);
            //$Standard->attachment = $new_attachment;
        }
        $Standard = new Standard([
            'name' => $request->get('name'),
            'symbol' => $request->get('symbol'),
            'obstypeid' => $request->get('ObservationTypes'),
            'dateoflssue' => $date,
            'organization' => $request->get('organization'),
            'attachment' => $new_attachment 
        ]);
        $Standard->save();
        return redirect('danhmuc/Standard')->with('success', 'Thêm mới thành công!');

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
            $Standards = Standard::paginate(10);
            return view( 'admin.standard.Standards',['Standards' => $Standards])->with('no', 1);
        }
        else 
        {
            $search = trim(mb_strtoupper($search,'UTF-8'));
            $Standards = Standard::select('Standard.*')
            ->where(DB::raw('UPPER("Standard"."name")'), 'like', '%' .$search. '%')
            ->orwhere(DB::raw('UPPER("Standard"."symbol")'), 'like', '%' . $search . '%')
            ->orwhere(DB::raw('UPPER("Standard"."organization")'), 'like', '%' . $search . '%')
            ->join('ObservationType', 'ObservationType.id', '=', 'Standard.obstypeid')
            ->orwhere(DB::raw('UPPER("ObservationType"."name")'), 'like', '%' . $search . '%')->paginate(10);
            return view( 'admin.standard.Standards',['Standards' => $Standards])->with('no', 1);
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
        $ObservationTypes = ObservationType::all();
        $Standard = Standard::findOrFail($id);
        return view('admin.standard.StandardEdit', ['Standard' => $Standard, 'ObservationTypes' => $ObservationTypes]);
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
                'name' => 'bail|required|max:255|unique:Standard,name,'.$id,
                'symbol' => 'bail|required|max:100|unique:Standard,symbol,'.$id,
            ],
            [
                'name.required' => 'Nhập tên quy chuẩn/tiêu chuẩn.',
                'name.max' => 'Tên không dài quá 255 ký tự!',
                'name.unique' => 'Tên đã tồn tại!',
                'symbol.required' => 'Nhập kí hiệu.',
                'symbol.max' => 'Nhập kí hiệu không dài quá 100 ký tự!',
                'symbol.unique' => 'Nhập kí hiệu đã tồn tại!',
            ]
        );
        $date = null;
        $temp = $request->input('dateFrom');
        if($temp!=null && $temp!="")
        {
            $dtemp = explode("-", $temp );
            //$date = date_format(date_create($temp),"d/m/Y");
            $date = Carbon::create($dtemp[2],$dtemp[1],$dtemp[0]);
        }
        $Standard = Standard::find($id);
        $Standard->name = $request->get('name');
        $Standard->symbol = $request->get('symbol');
        $Standard->obstypeid = $request->get('loaihinhcha');
        $Standard->dateoflssue = $date;
        $Standard->organization = $request->get('organization');
        //$Standard->attachment = $request->get('attachment');
        $get_attachment = $request->file('attachment');
        if($get_attachment)
        {
            $get_name_attachment = $get_attachment->getClientOriginalName();
            $name_attachment = current(explode('.', $get_name_attachment));
            $new_attachment =  $name_attachment.rand(0,99).'.'.$get_attachment->getClientOriginalExtension();
            $get_attachment -> move('public/uploads/standards',$new_attachment);
            $Standard->attachment = $new_attachment;
        }
        $Standard->save();
        return redirect('danhmuc/Standard')->with('success', 'Cập nhật thành công!');
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
        $Standard = Standard::find($id);
        $standard_attachment = $Standard->attachment;
        $path = 'public/uploads/standards/'.$standard_attachment;
        if($path)
        {
           unlink($path);
        }
        $Standard->delete();

        return redirect('danhmuc/Standard')->with('success', 'Xóa thành công!');
    }
}
