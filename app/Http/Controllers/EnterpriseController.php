<?php

namespace App\Http\Controllers;

use DB;
use App\Enterprise;
use Illuminate\Http\Request;

class EnterpriseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $Enterprises = Enterprise::paginate(10);
        return view('admin.enterprise.Enterprise', ['Enterprises' => $Enterprises])->with('no', 1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.enterprise.EnterpriseCreate');
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
                'name' => 'bail|required|max:255|unique:Enterprise,name',
                'address' => 'bail|required|max:2000',
                'phone' => 'bail|required|max:255',
                'tin' => 'bail|required|numeric',
                'active' => 'required',
            ],
            [
                'name.required' => 'Nhập tên doanh nghiệp.',
                'name.max' => 'Tên không dài quá 255 ký tự!',
                'name.unique' => 'Tên đã tồn tại!',
                'address.required' => 'Nhập địa chỉ',
                'address.max' => 'Nhập địa chỉ không dài quá 2000 ký tự!',
                'phone.required' => 'Nhập số điện thoại',
                'phone.max' => 'Số điện thoại không dài quá 255 ký tự!',
                'tin.required' => 'Nhập mã số thuế',
                'tin.numeric' => 'Mã số thuế phải là số',
                'active.required' => 'Nhập tình trạng',
            ]
        );
        $Enterprise = new Enterprise([
            'name' => $request->get('name'),
            'address' => $request->get('address'),
            'phone' => $request->get('phone'),
            'type' => $request->get('type'),
            'tin' => $request->get('tin'),
            'fax' => $request->get('fax'),
            'email' => $request->get('email'),
            'accountNumber' => $request->get('accountNumber'),
            'active' => $request->get('active'),
            'employees' => $request->get('employees'),
            'totalInvestment' => $request->get('totalInvestment'),
            'profession' => $request->get('profession'),
            'agent' => $request->get('agent'),
            'title' => $request->get('title')
        ]);
        $Enterprise->save();
        return redirect('danhmuc/Enterprise')->with('success', 'Thêm mới thành công!');
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
        if ($search ==null) {
            # code...
             $Enterprises = Enterprise::paginate(10);
            return view('admin.enterprise.Enterprise', ['Enterprises' => $Enterprises])->with('no', 1);
        }
        else
        {
            $search = trim(mb_strtoupper($search,'UTF-8'));
             $Enterprises = Enterprise::where(DB::raw('UPPER(name)'), 'like', '%' .$search. '%')
             ->orwhere(DB::raw('UPPER(address)'), 'like', '%' . $search . '%')
             ->orwhere('tin', 'like', '%' . $search . '%')
             ->orwhere(DB::raw('UPPER(profession)'), 'like', '%' . $search . '%')->paginate(10);
            return view('admin.enterprise.Enterprise', ['Enterprises' => $Enterprises])->with('no', 1);
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
        $Enterprise = Enterprise::findorfail($id);
        return view('admin.enterprise.EnterpriseEdit1', ['Enterprise' => $Enterprise]);
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
               'name' => 'bail|required|max:255|unique:Enterprise,name,'.$id,
                'address' => 'bail|required|max:2000',
                'phone' => 'bail|required|max:255',
                'tin' => 'bail|required|numeric',
                'active' => 'required',
            ],
            [
                'name.required' => 'Nhập tên doanh nghiệp.',
                'name.max' => 'Tên không dài quá 255 ký tự!',
                'name.unique' => 'Tên đã tồn tại!',
                'address.required' => 'Nhập địa chỉ',
                'address.max' => 'Nhập địa chỉ không dài quá 2000 ký tự!',
                'phone.required' => 'Nhập số điện thoại',
                'phone.max' => 'Số điện thoại không dài quá 255 ký tự!',
                'tin.required' => 'Nhập mã số thuế',
                'tin.numeric' => 'Mã số thuế phải là số',
                'active.required' => 'Nhập tình trạng',
            ]
        );
        $Enterprise = Enterprise::find($id);
        $Enterprise->name = $request->get('name');
        $Enterprise->address = $request->get('address');
        $Enterprise->phone = $request->get('phone');
        $Enterprise->type = $request->get('type');
        $Enterprise->tin = $request->get('tin');
        $Enterprise->fax = $request->get('fax');
        $Enterprise->email = $request->get('email');
        $Enterprise->accountNumber = $request->get('accountNumber');
        $Enterprise->active = $request->get('active');
        $Enterprise->employees = $request->get('employees');
        $Enterprise->totalInvestment = $request->get('totalInvestment');
        $Enterprise->profession = $request->get('profession');
        $Enterprise->agent = $request->get('agent');
        $Enterprise->title = $request->get('title');
        $Enterprise->save();
        return redirect('danhmuc/Enterprise')->with('success', 'Cập nhật thành công!');
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
        $Enterprise = Enterprise::find($id);
        $Enterprise->delete();
        return redirect('danhmuc/Enterprise')->with('success', 'Xóa thành công!');
    }

}
