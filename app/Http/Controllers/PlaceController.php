<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Location;
use App\LocationType;

class PlaceController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $Locations = Location::paginate(8);
        return view('admin.location.ListLocation',['Locations' => $Locations])->with('no', 1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $LocationTypes = LocationType::all();
        return view('admin.location.CreateLocation', ['LocationTypes' => $LocationTypes]);
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
                'name' => 'bail|required|max:255|unique:Location,name',
            ],
            [
                'name.required' => 'Nhập tên.',
                'name.max' => 'Nhập tên không quá 255 ký tự.',
                'name.unique' => 'Tên đã tồn tại!',
            ]
        );
        $Location = new Location([
            'name' => $request->get('name'),
            'locationtypeid' => $request->get('locationtypeid'),
            'note' => $request->get('note'),
        ]);
        $Location->save();
        return redirect('danhmuc/Place')->with('success', 'Thêm mới thành công!');

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
        if ($search == null) 
        {
            $Locations = Location::paginate(8);
            return view('admin.location.ListLocation',['Locations' => $Locations])->with('no', 1);
        } 
        else 
        {
            $search = trim(mb_strtoupper($search,'UTF-8'));
            $Locations = Location::select('Location.*')
                        ->where(DB::raw('UPPER("Location"."name")'), 'like', '%' .$search. '%')
                        ->orwhere(DB::raw('UPPER("Location"."note")'), 'like', '%' . $search . '%')
                        ->join('LocationType', 'LocationType.id', '=', 'Location.locationtypeid')
                        ->orWhere(DB::raw('UPPER("LocationType"."name")'), 'like', '%' . $search . '%')->paginate(8);
            return view('admin.location.ListLocation',['Locations' => $Locations])->with('no', 1);
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
        $LocationTypes = LocationType::all();
        $Location = Location::findOrFail($id);
        return view('admin.location.EditLocation', ['Location' => $Location, 'LocationTypes' => $LocationTypes]);
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
                 'name' => 'bail|required|max:255|unique:Location,name,'.$id,
            ],
            [
                'name.required' => 'Nhập tên.',
                'name.max' => 'Nhập tên không quá 255 ký tự.',
                'name.unique' => 'Tên đã tồn tại!',
            ]
        );
        $Location = Location::find($id);
        $Location->name = $request->get('name');
        $Location->locationtypeid = $request->get('locationtypeid');
        $Location->note = $request->get('note');
        $Location->save();
        return redirect('danhmuc/Place')->with('success', 'Cập nhật thành công!');
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
            $Observationstations = Location::findOrFail($id)->Observationstations()->get();
            if ($Observationstations->isNotEmpty()) 
            {
                return redirect('danhmuc/Place')->with('alert', 'Xóa không thành công do dữ liệu đã được tham chiếu đến bảng Trạm quan trắc!');
            } 
            $Location = Location::find($id);
            $Location->delete();
            return redirect('danhmuc/Place')->with('success', 'Xóa thành công!');
        }
        catch (\Exception $exception) 
        {
            return back()->withError($exception->getMessage());
        }
    }
}
