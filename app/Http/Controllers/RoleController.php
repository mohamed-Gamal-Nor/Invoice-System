<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
class RoleController extends Controller
{

    function __construct()
    {

        $this->middleware('permission:Role-show', ['only' => ['index']]);
        $this->middleware('permission:Role-show', ['only' => ['show']]);
        $this->middleware('permission:Role-create', ['only' => ['create','store']]);
        $this->middleware('permission:Role-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:Role-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $roles = Role::orderBy('id','ASC')->get();
        return view('roles.index',compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::groupBy('table')->get();
        return view('roles.create',compact('permissions'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ],[
            'name.required' => 'يجب ادخال اسم الصلاحية',
            'name.unique' => 'هذا الاسم تم استخدامه من قبل',
            'permission.required' => 'يجب اختيار صلاحية',
        ]);
        try {
            $role = Role::create(['name' => $request->input('name')]);
            $role->syncPermissions($request->input('permission'));
            toastr()->success('تم حفظ بيانات الصلاحية بنجاح');
            return redirect()->route('roles.index');
        }catch (\Exception $e) {
            toastr()->error(trans('يوجد مشكلة بالنظام الرجاء محاولة مرة اخري او الاتصال بالمهندس'));
            return redirect()->route('roles.index');
        };

    }

    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->groupBy('table')
            ->get();
        return view('roles.show',compact('role','rolePermissions'));
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $permissions = Permission::groupBy('table')->get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        return view('roles.edit',compact('role','permissions','rolePermissions'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ],[
            'name.required' => 'يجب ادخال اسم الصلاحية',
            'permission.required' => 'يجب اختيار صلاحية',
        ]);
        try {
            $role = Role::find($id);
            $role->name = $request->input('name');
            $role->save();
            $role->syncPermissions($request->input('permission'));
            toastr()->success('تم تعديل بيانات الصلاحية بنجاح');
            return redirect()->route('roles.index');
        }catch (\Exception $e) {
            toastr()->error(trans('يوجد مشكلة بالنظام الرجاء محاولة مرة اخري او الاتصال بالمهندس'));
            return redirect()->route('roles.index');
        };

    }

    public function destroy($id)
    {
        try {
            DB::table("roles")->where('id',$id)->delete();
            toastr()->success('تم حذف بيانات الصلاحية بنجاح');
            return redirect()->route('roles.index');
        }catch (\Exception $e) {
            toastr()->error(trans('يوجد مشكلة بالنظام الرجاء محاولة مرة اخري او الاتصال بالمهندس'));
            return redirect()->route('roles.index');
        };
    }
}
