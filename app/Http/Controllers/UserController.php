<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('', ['only' => ['']]);
        $this->middleware('permission:Users-create', ['only' => ['create','store']]);
        $this->middleware('permission:Users-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:Users-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $users = User::orderBy('id','DESC')->get();
        return view('users.index',compact('users'));
    }

    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('users.add',compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:users,name|string|min:3|max:100',
            'email' => 'required|email|unique:users,email|regex:/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,8}$/',
            'password' => 'required|same:confirm-password|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/',
            "status" => "required|in:0,1",
            'roles_name' => 'required',
            "user_image" => "nullable|mimes:jpg,jpeg,png|max:5000"
        ],[
            'name.required' => 'يجب ادخال اسم المستخدم',
            'name.unique' => 'اسم المستخدم هذا مستخدم من قبل',
            'name.string' => 'اسم المستخدم غير صحيح',
            'name.min' => 'يجب اسم المستخدم لايقل عن ثلاث حروف',
            'name.max' => 'يجب اسم المستخدم لايزيد عن مائة حرف',
            'email.required' => 'يجب ادخال البريد الالكتروني',
            'email.email' => 'يجب ان يكون بريدا اليكترونيا',
            'email.unique' => ' هذا البريد الاليكتروني مستخدم بالفعل',
            'email.regex' => 'هذا البريداليكتروني غير صحيح',
            'password.required' => 'يجب أدخال كلمة مرور',
            'password.same' => 'كلمة المرور غير مطابقة',
            'password.regex' => 'يجب أن تحتوي كلمة المرور علي حروف كبيرةوصغير وارقام ورموز',
            'status.required' => 'يجب اختيار الحالة ',
            'status.in' => 'الحالة التي تم اختيارها غير صحيحة',
            'roles_name.required' => 'يجب اختيار صلاحية ',
            'user_image.mimes' => "يجب ان تكون الصورة بصيغة JPG - PNG - JPEG",
            'user_image.max' => "يجب ان لا يزيد حجم الصورة عن خمسة ميجا",
        ]);
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email  = $request->email;
            $user->password = Hash::make($request->password);
            $user->roles_name = $request->roles_name;
            $user->status = $request->status;
            $user->save();
            $user->sendEmailVerificationNotification();
            $user->assignRole($request->roles_name);
            if (!empty($request->user_image)) {
                $lastID = User::latest()->first()->id;
                $imageName = time() . '.' . $request->user_image->getClientOriginalExtension();
                $request->user_image->storeAs($lastID, $imageName, $disk = 'user_profile');
                $userAfter = User::find($lastID);
                $userAfter->update([
                    'user_image' => $imageName
                ]);

            }
            toastr()->success('تم حفظ بيانات المستخدم بنجاح');
            return redirect()->route('users.index');
        }catch (\Exception $e) {
            toastr()->error(trans('يوجد مشكلة بالنظام الرجاء محاولة مرة اخري او الاتصال بالمهندس'));
            return redirect()->route('users.index');
        };

    }

    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('users.edit',compact('user','roles','userRole'));
    }
    public function profileEdit($id)
    {
        if ($id == Auth::user()->id){
            $user = User::find($id);
            $roles = Role::pluck('name','name')->all();
            $userRole = $user->roles->pluck('name','name')->all();
            return view('users.editProfile',compact('user','roles','userRole'));
        }
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            "status" => "required|in:0,1",
            'roles_name' => 'required',
        ],[
            'status.required' => 'يجب اختيار الحالة ',
            'status.in' => 'الحالة التي تم اختيارها غير صحيحة',
            'roles_name.required' => 'يجب اختيار صلاحية ',
        ]);
        try {
            $user = User::find($request->id);
            $user->update([
                'roles_name' => $request->roles_name,
                'status' => $request->status,
                "updated_at" => date("Y-m-d h:i:s"),
            ]);
            DB::table('model_has_roles')->where('model_id',$id)->delete();
            $user->assignRole($request->roles_name);
            toastr()->success('تم تحديث بيانات المستخدم بنجاح');
            return redirect()->route('users.index');
        }catch (\Exception $e) {
            //toastr()->error($e->getMessage());
            toastr()->error(trans('يوجد مشكلة بالنظام الرجاء محاولة مرة اخري او الاتصال بالمهندس'));
            return redirect()->route('users.index');
        };
    }
    public function updateProfile(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required|unique:users,name,'.$request->id.'|string|min:3|max:100',
            'email' => 'required|email|unique:users,email,'.$request->id.'|regex:/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,8}$/',
            'password' => 'nullable|same:confirm-password|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/',
            "user_image" => "nullable|mimes:jpg,jpeg,png|max:5000"
        ],[
            'name.required' => 'يجب ادخال اسم المستخدم',
            'name.unique' => 'اسم المستخدم هذا مستخدم من قبل',
            'name.string' => 'اسم المستخدم غير صحيح',
            'name.min' => 'يجب اسم المستخدم لايقل عن ثلاث حروف',
            'name.max' => 'يجب اسم المستخدم لايزيد عن مائة حرف',
            'email.required' => 'يجب ادخال البريد الالكتروني',
            'email.email' => 'يجب ان يكون بريدا اليكترونيا',
            'email.unique' => ' هذا البريد الاليكتروني مستخدم بالفعل',
            'email.regex' => 'هذا البريداليكتروني غير صحيح',
            'password.required' => 'يجب أدخال كلمة مرور',
            'password.same' => 'كلمة المرور غير مطابقة',
            'password.regex' => 'يجب أن تحتوي كلمة المرور علي حروف كبيرةوصغير وارقام ورموز',
            'user_image.mimes' => "يجب ان تكون الصورة بصيغة JPG - PNG - JPEG",
            'user_image.max' => "يجب ان لا يزيد حجم الصورة عن خمسة ميجا",
        ]);
        try {
            $user = User::find($request->id);
            $newPassword=null;
            $imageUpdate=null;
            if(!empty($request->password)){
                $newPassword = Hash::make($request->password);
            }else{
                $newPassword = $user->password;
            }

            if(!empty($request->user_image)){
                $imageUpdate = time() . '.' . $request->user_image->getClientOriginalExtension();
                $request->user_image->storeAs($request->id, $imageUpdate, $disk = 'user_profile');
            }else{
                $imageUpdate = $user->user_image;
            }
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $newPassword,
                'user_image' => $imageUpdate,
                "updated_at" => date("Y-m-d h:i:s"),
            ]);
            toastr()->success('تم تحديث الملف الشخصي بنجاح');
            return redirect("./users/profileEdit/".$request->id);
        }catch (\Exception $e) {
            //toastr()->error($e->getMessage());
            toastr()->error(trans('يوجد مشكلة بالنظام الرجاء محاولة مرة اخري او الاتصال بالمهندس'));
            return redirect("./users/profileEdit".$request->id);
        };
    }

    public function destroy(Request $request)
    {
        try {
            Storage::deleteDirectory('public/user_profile/'.$request->id);
            $user = User::findOrFail($request->id)->delete();
            toastr()->success('تم حذف بيانات المستخدم بنجاح');
            return redirect()->route('users.index');
        }catch (\Exception $e) {
            toastr()->error(trans('يوجد مشكلة بالنظام الرجاء محاولة مرة اخري او الاتصال بالمهندس'));
            return redirect()->route('users.index');
        };
    }
}
