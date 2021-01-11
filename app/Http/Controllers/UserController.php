<?php

namespace App\Http\Controllers;

use App\District;
use App\User;
use App\Role;
use App\role_user;
use Illuminate\Http\Request;
use App\Http\Controllers;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $Users = User::paginate(8);
        $roles = role::all();
        return view('admin.user.User', ['Users' => $Users,'roles' =>$roles])->with('no', 1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $Districts = District::all();
        $roles = role::all();
        return view('admin.user.UserCreate', ['Districts' => $Districts, 'roles' => $roles]);
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
        //dd($request->get('nhomnguoidung'));
        $request->validate(
            [
                'name' => 'bail|required',
                'username' => 'bail|required|unique:users,username',
                'password' => 'required_with:password_confirmation',
                'password_confirmation' => 'same:password',
                'email' => 'bail|required|regex:/(.+)@(.+)\.(.+)/i'
            ],
            [
                'name.required' => 'Nhập họ tên người dùng.',
                'username.required' => 'Nhập tài khoản người dùng.',
                'username.unique' => 'Tài khoản người dùng đã tồn tại.',
                'password_confirmation.same' => 'Mật khẩu không trùng nhau.',
                'email.required' => 'Nhập địa chỉ email.',
                'email.regex' => 'Địa chỉ email không đúng định dạng.'
            ]
        );
        $Users = new User([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'address' => $request->get('address'),
            'districtid' => $request->get('district'),
            'phonenumber' => $request->get('phonenumber'),
            'username' => $request->get('username')
        ]);
        $save = $Users->save();
        $idUser = $Users ->id;
        if ($save) {
            # code...
            $user_role = new role_user([
                'role_id' => $request->get('nhomnguoidung'),
                'user_id' => $idUser,
            ]);
            $user_role->save();
        }
        return redirect('quantri/users')->with('success', 'Thêm mới thành công!');
        //dd($Users);
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
        //
        $roles = role::all();
        $search = $request->search;
        if ($search == null) {
            $Users = User::paginate(8);
            return view('admin.user.User', ['Users' => $Users,'roles' =>$roles])->with('no', 1);
        } 
        else 
        {
            $search = trim(mb_strtoupper($search,'UTF-8'));
            $Users = User::where(DB::raw('UPPER(name)'), 'like', '%' .$search. '%')
                        ->orwhere(DB::raw('UPPER(username)'), 'like', '%' . $search . '%')
                        ->orwhere(DB::raw('UPPER(email)'), 'like', '%' . $search . '%')->paginate(8);
            return view('admin.user.User', ['Users' => $Users,'roles' =>$roles])->with('no', 1);
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
        $Districts = District::all();
        $User = User::findOrFail($id);
        $roles = role::all();
        $role_user = role_user::where("user_id", $id)->value('role_id');
        //dd($role_user);
        //$pass = Crypt::decryptString($User->password);
        //$pass = Crypt::decrypt($User->password);
        return view('admin.user.UserEdit', ['Districts' => $Districts, 'User'=> $User, 'roles' => $roles, 'role_user' => $role_user]);
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
                'name' => 'bail|required',
                'username' => 'bail|required|unique:users,username, '. $id,
                'password' => 'required_with:password_confirmation',
                'password_confirmation' => 'same:password',
                'email' => 'required|regex:/(.+)@(.+)\.(.+)/i'
            ],
            [
                'name.required' => 'Nhập họ tên người dùng.',
                'username.required' => 'Nhập tài khoản người dùng.',
                'username.unique' => 'Tài khoản người dùng đã tồn tại.',
                'password_confirmation.same' => 'Mật khẩu không trùng nhau.',
                'email.required' => 'Nhập địa chỉ email.',
                'email.regex' => 'Địa chỉ email không đúng định dạng.'
            ]
        );
        $User = User::find($id);
        if (\Illuminate\Support\Facades\Hash::check( $request->get('password'), $User->password)) 
        {
            // Password is not matching
            //dd($User->password, $request->get('password'),'Mat khau khong doi');
            //dd($request->get('password'));
            //dd('Mat khau khong doi');
            $User->name = $request->get('name');
            $User->email = $request->get('email');
            $User->address = $request->get('address');
            $User->districtid = $request->get('district');
            $User->phonenumber = $request->get('phonenumber');
            $User->username = $request->get('username');
            $save = $User->save();
            if ($save) {
                # code...
                $role_users = role_user::where('user_id', $id)->first();
                $role_users->role_id = $request->get('nhomnguoidung');
                $role_users->save();
            }
            return redirect('quantri/users')->with('success', 'Sửa thành công!');
        }
        else 
        {
            // Password is matching
            //dd($User->password, $request->get('password'), 'Mat khau thay doi');
            //dd($User->password);
            //dd($request->get('password'));
            $User->name = $request->get('name');
            $User->email = $request->get('email');
            $User->password = bcrypt($request->get('password'));
            $User->address = $request->get('address');
            $User->districtid = $request->get('district');
            $User->phonenumber = $request->get('phonenumber');
            $User->username = $request->get('username');
            $save = $User->save();
            if ($save) 
            {
                # code...
                $role_users = role_user::where('user_id', $id)->first();
                $role_users->role_id = $request->get('nhomnguoidung');
                $role_users->save();
            }
            return redirect('quantri/users')->with('success', 'Sửa thành công!');
            //dd($request);
            //dd('Mat khau thay doi');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
       
        $User = User::find($id);
        $User->delete();

        return redirect('quantri/users')->with('success', 'Xóa thành công!');
    }
}
