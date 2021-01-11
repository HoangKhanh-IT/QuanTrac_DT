<?php

namespace App\Http\Middleware;

use App\Permission;
use Closure;
use DB;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission = null)
    {
        $listRoleUser = DB::table('users')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->where('users.id', auth()->id())
            ->select('roles.*')
            ->get()->pluck('id')->toArray();
        $listRoleUser = DB::table('roles')
            ->join('role_permission', 'roles.id', '=', 'role_permission.role_id')
            ->join('permissions', 'role_permission.permission_id', '=', 'permissions.id')
            ->whereIn('roles.id', $listRoleUser)
            ->select('permissions.*')
            ->get()->pluck('id')->unique();
        $checkPermission = Permission::where('name', $permission)->value('id');

        if ($listRoleUser->contains($checkPermission)) {
            return $next($request);
        }
        return redirect()
        ->back()->with('auth', 'Bạn không có quyền vào chức năng này');
        //return abort(401);
        //dd($checkPermission);

    }
}
