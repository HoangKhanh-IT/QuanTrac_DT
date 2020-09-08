<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\ElectronicBoard;
use App\Observationstation;
use App\Parameter;
use App\StandardParameter;
use App\StdStation;

class ElectronicBoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $ElectronicBoards = ElectronicBoard::paginate(10);
        $ObservationStations = ObservationStation::all();
        return view( 'admin.electronic_board.ElectronicBoard',
            ['ElectronicBoards' => $ElectronicBoards, 'ObservationStations' => $ObservationStations])->with('no', 1);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $Parameters = Parameter::all();
        $ObservationStations = ObservationStation::all();
        $StandardParameters = StandardParameter::all();
        $StdStations = StdStation::all();
        return view(
            'admin.electronic_board.ElectronicBoardCreate',
            ['ObservationStations' => $ObservationStations, 'Parameters' => $Parameters, 'StandardParameters' => $StandardParameters, 'StdStations'=> $StdStations]
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
                'name' => 'bail|required|max:255|unique:ElectronicBoard,name',
                'coordx' => 'bail|required|numeric',
                'coordy' => 'bail|required|numeric',
                'note' => 'bail|required|max:4000'
            ],
            [
                'name.required' => 'Nhập tên.',
                'name.max' => 'Tên không quá 255 ký tự.',
                'name.unique' => 'Tên đã tồn tại.',
                'coordx.required' => 'Nhập tọa độ X.',
                'coordx.numeric' => 'Tọa độ X phải nhập số.',
                'coordy.required' => 'Nhập tọa độ Y.',
                'coordy.numeric' => 'Tọa độ Y phải nhập số.',
                'note.required' => 'Nhập ghi chú.',
                'note.max' => 'Ghi chú không quá 4000 ký tự.',
              
            ]
        );
        //dd($request);
        $ElectronicBoard = new ElectronicBoard([
            'name' => $request->get('name'),
            'coordx' => $request->get('coordx'),
            'coordy' => $request->get('coordy'),
            'stationid' => $request->get('loaihinhcha'),
            'note' => $request->get('note')
        ]);
        $ElectronicBoard->save();
        return redirect('quanly/ElectronicBoard')->with('success', 'Thêm mới thành công!');

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
        $ObservationStations = ObservationStation::all();
        if ($search == null) {
            # code...
            $ElectronicBoards = ElectronicBoard::paginate(10);
            return view( 'admin.electronic_board.ElectronicBoard',
            ['ElectronicBoards' => $ElectronicBoards, 'ObservationStations' => $ObservationStations])->with('no', 1);
        } 
        else 
        {
            $search = trim(mb_strtoupper($search,'UTF-8'));
            $ElectronicBoards = ElectronicBoard::select('ElectronicBoard.*')
                        ->where(DB::raw('UPPER("ElectronicBoard"."name")'), 'like', '%' .$search. '%')
                        ->orwhere(DB::raw('UPPER("ElectronicBoard"."note")'), 'like', '%' . $search . '%')
                        ->join('Observationstation', 'Observationstation.id', '=', 'ElectronicBoard.stationid')
                        ->orWhere(DB::raw('UPPER("Observationstation"."name")'), 'like', '%' . $search . '%')->paginate(10);
            return view( 'admin.electronic_board.ElectronicBoard',
            ['ElectronicBoards' => $ElectronicBoards, 'ObservationStations' => $ObservationStations])->with('no', 1);
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
        $ObservationStations = ObservationStation::all();
        $ElectronicBoard = ElectronicBoard::findorfail($id);
        return view('admin.electronic_board.ElectronicBoardEdit', ['ElectronicBoard' => $ElectronicBoard, 'ObservationStations' => $ObservationStations]);
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
               'name' => 'bail|required|max:255|unique:ElectronicBoard,name,'.$id,
                'coordx' => 'bail|required|numeric',
                'coordy' => 'bail|required|numeric',
                'note' => 'bail|required|max:4000',
            ],
            [
                'name.required' => 'Nhập tên.',
                'name.max' => 'Tên không quá 255 ký tự.',
                'name.unique' => 'Tên đã tồn tại.',
                'coordx.required' => 'Nhập tọa độ X.',
                'coordx.numeric' => 'Tọa độ X phải nhập số.',
                'coordy.required' => 'Nhập tọa độ Y.',
                'coordy.numeric' => 'Tọa độ Y phải nhập số.',
                'note.required' => 'Nhập ghi chú.',
                'note.max' => 'Ghi chú không quá 4000 ký tự.',
            ]
        );

        $ElectronicBoard = ElectronicBoard::find($id);
        $ElectronicBoard->name = $request->get('name');
        $ElectronicBoard->coordx = $request->get('coordx');
        $ElectronicBoard->coordy = $request->get('coordy');
        $ElectronicBoard->stationid = $request->get('loaihinhcha');
        $ElectronicBoard->note = $request->get('note');

        $ElectronicBoard->save();
        return redirect('quanly/ElectronicBoard')->with('success', 'Cập nhật thành công!');
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
        $ElectronicBoard = ElectronicBoard::find($id);
        $ElectronicBoard->delete();
        return redirect('quanly/ElectronicBoard')->with('success', 'Xóa thành công!');
    }
}
