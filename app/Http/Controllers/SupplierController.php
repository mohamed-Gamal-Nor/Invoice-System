<?php

namespace App\Http\Controllers;

use App\Models\supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /*
    function __construct()
    {

        $this->middleware('permission:', ['only' => ['index']]);
        $this->middleware('permission:', ['only' => ['create','store']]);
        $this->middleware('permission:', ['only' => ['edit','update']]);
        $this->middleware('permission:', ['only' => ['destroy']]);
    }
    */

    public function index()
    {
        $supplier = supplier::all();
        return view('supplier.index',compact('supplier'));
    }


    public function create()
    {
        return view('supplier.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:suppliers,name|string|min:3|max:100',
            'phone' => 'required|numeric|unique:suppliers,phone|digits:11|regex:/(01)[0-5]{1}[0-9]{8}/',
            'address' => 'required|string',
            "start_balance" => "required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/",
            "status" => "required|in:0,1",
            'description' => 'nullable|string|max:255',
        ],[
            'name.required' => 'يجب ادخال اسم المورد',
            'name.unique' => 'اسم المورد هذا مستخدم من قبل',
            'name.string' => 'اسم المورد غير صحيح',
            'name.min' => 'يجب اسم المورد لايقل عن ثلاث حروف',
            'name.max' => 'يجب اسم المورد لايزيد عن مائة حرف',
            'phone.required' => 'يجب ادخال رقم الهاتف',
            'phone.numeric' => 'يجب ان يكون رقم الهاتف صحيحا',
            'phone.unique' => ' هذا رقم  مستخدم بالفعل',
            'phone.regex' => ' رقم الهاتف هذا غير صحيح',
            'address.required' => 'يجب أدخال عنوان المورد',
            'address.string' => 'عنوان المورد غير صحيح',
            'start_balance.required' => 'يجب ادخال رصيد بداية المدة',
            'start_balance.regex' => 'رصيد البداية غير صحيح ',
            'status.in' => 'الحالة التي تم اختيارها غير صحيحة',
            'status.required' => 'يجب اختيار حالة المورد ',
            'description.string' => "الملاحظات غير صحيحة",
            'description.max' => "الملاحاظات لا يجب ان تزيد عن 255 حرف",
        ]);
        try {
            $supplier = new supplier();
            $supplier->name = $request->name;
            $supplier->phone = $request->phone;
            $supplier->address = $request->address;
            $supplier->start_balance = $request->start_balance;
            $supplier->status = $request->status;
            $supplier->description = $request->description;
            $supplier->created_by = auth()->id();
            $supplier->save();
            toastr()->success(trans('تم أضافة المورد بنجاح بنجاح'));
            return redirect()->route('supplier.index');
        }catch (\Exception $e) {
            toastr()->error(trans('يوجد مشكلة بالنظام الرجاء محاولة مرة اخري او الاتصال بالمهندس'));
            return redirect()->route('supplier.index');
        };
    }
    public function edit($id)
    {
        $supplier = supplier::find($id);
        return view('supplier.edit',compact('supplier',));
    }

    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'name' => 'required|string|min:3|max:100|unique:suppliers,name,'.$request->id,
            'phone' => 'required|numeric|digits:11|regex:/(01)[0-5]{1}[0-9]{8}/|unique:suppliers,phone,'.$request->id,
            'address' => 'required|string',
            "start_balance" => "required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/",
            "status" => "required|in:0,1",
            'description' => 'nullable|string|max:255',
        ],[
            'name.required' => 'يجب ادخال اسم المورد',
            'name.unique' => 'اسم المورد هذا مستخدم من قبل',
            'name.string' => 'اسم المورد غير صحيح',
            'name.min' => 'يجب اسم المورد لايقل عن ثلاث حروف',
            'name.max' => 'يجب اسم المورد لايزيد عن مائة حرف',
            'phone.required' => 'يجب ادخال رقم الهاتف',
            'phone.numeric' => 'يجب ان يكون رقم الهاتف صحيحا',
            'phone.unique' => ' هذا رقم  مستخدم بالفعل',
            'phone.regex' => ' رقم الهاتف هذا غير صحيح',
            'address.required' => 'يجب أدخال عنوان المورد',
            'address.string' => 'عنوان المورد غير صحيح',
            'start_balance.required' => 'يجب ادخال رصيد بداية المدة',
            'start_balance.regex' => 'رصيد البداية غير صحيح ',
            'status.in' => 'الحالة التي تم اختيارها غير صحيحة',
            'status.required' => 'يجب اختيار حالة المورد ',
            'description.string' => "الملاحظات غير صحيحة",
            'description.max' => "الملاحاظات لا يجب ان تزيد عن 255 حرف",
        ]);
        try {
            $shipping = supplier::findOrFail($request->id);
            $shipping->update([
                "name" => $request->name,
                "phone" => $request->phone,
                "address" => $request->address,
                "start_balance" => $request->start_balance,
                "status" => $request->status,
                "description" => $request->description,
                "updated_at" => date("Y-m-d h:i:s"),

            ]);
            toastr()->success(trans('تم تعديل بيانات المورد بنجاح'));
            return redirect()->route('supplier.index');

        }catch (\Exception $e) {
            toastr()->error(trans('يوجد مشكلة بالنظام الرجاء محاولة مرة اخري او الاتصال بالمهندس'));
            return redirect()->route('supplier.index');
        };
    }

    public function destroy(Request $request)
    {
        try {
            $ProductSection = supplier::findOrFail($request->id)->delete();
            toastr()->success(trans('تم حذف المورد بنجاح'));
            return redirect()->route('supplier.index');
        }catch (\Exception $e) {
            toastr()->error(trans('يوجد مشكلة بالنظام الرجاء محاولة مرة اخري او الاتصال بالمهندس'));
            return redirect()->route('supplier.index');
        };
    }
}
