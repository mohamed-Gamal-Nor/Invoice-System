<?php

namespace App\Http\Controllers;

use App\Models\treasury;
use Illuminate\Http\Request;

class TreasuryController extends Controller
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
        $treasury = treasury::all();
        return view("treasury.index",compact('treasury'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255|string|unique:treasuries,name',
            'address' => 'required|max:255|string',
            "start_balance" => "required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/",
            'description' => 'nullable|string|max:255',
        ],[
            'name.required' =>'يجب ادخال اسم المقاس',
            'name.unique' =>'اسم المقاس تم ادخاله من قبل',
            'name.max' =>'اسم المقاس كبير جدا',
            'name.string' =>'اسم المقاس غير صحيح',
            'address.required' =>'يجب ادخال عنوان الخزينة',
            'address.max' =>'عنوان الخزينة لا يزيد عن 255 حرف',
            'address.string' =>'عنوان الخزينة غير صحيح',
            'start_balance.required' =>'يجب ادخال رصيد البداية',
            'start_balance.regex' =>'رصيد البداية غير صحيح',
            'description.string' =>'ملاحظات غير صحيحة',
            'description.max' =>'ملاحظات كبيرة جداا',
        ]);
        try {
            $treasury = new treasury();
            $treasury->name = $request->name;
            $treasury->address = $request->address;
            $treasury->start_balance = $request->start_balance;
            $treasury->description = $request->description;
            $treasury->created_by = auth()->id();
            $treasury->save();
            toastr()->success(trans('تم أضافة الخزنة بنجاح'));
            return redirect()->route('treasury.index');
        }catch (\Exception $e) {
            toastr()->error(trans('يوجد مشكلة بالنظام الرجاء محاولة مرة اخري او الاتصال بالمهندس'));
            return redirect()->route('treasury.index');
        };
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255|string|unique:treasuries,name,'.$request->id,
            'address' => 'required|max:255|string',
            "start_balance" => "required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/",
            'description' => 'nullable|string|max:255',
        ],[
            'name.required' =>'يجب ادخال اسم المقاس',
            'name.unique' =>'اسم المقاس تم ادخاله من قبل',
            'name.max' =>'اسم المقاس كبير جدا',
            'name.string' =>'اسم المقاس غير صحيح',
            'address.required' =>'يجب ادخال عنوان الخزينة',
            'address.max' =>'عنوان الخزينة لا يزيد عن 255 حرف',
            'address.string' =>'عنوان الخزينة غير صحيح',
            'start_balance.required' =>'يجب ادخال رصيد البداية',
            'start_balance.regex' =>'رصيد البداية غير صحيح',
            'description.string' =>'ملاحظات غير صحيحة',
            'description.max' =>'ملاحظات كبيرة جداا',
        ]);

        try {
            $treasury = treasury::findOrFail($request->id);
            $treasury->update([
                "name" => $request->name,
                "address" => $request->address,
                "start_balance" => $request->start_balance,
                "description" => $request->description,
                "updated_at" => date("Y-m-d h:i:s"),
            ]);
            toastr()->success(trans('تم تعديل الخزنة بنجاح'));
            return redirect()->route('treasury.index');
        }catch (\Exception $e) {
            toastr()->error(trans('يوجد مشكلة بالنظام الرجاء محاولة مرة اخري او الاتصال بالمهندس'));
            return redirect()->route('treasury.index');
        };
    }
    public function destroy(Request $request)
    {
        try {
            $ProductSection = treasury::findOrFail($request->id)->delete();
            toastr()->success(trans('تم حذف الخزنة بنجاح'));
            return redirect()->route('treasury.index');
        }catch (\Exception $e) {
            toastr()->error(trans('يوجد مشكلة بالنظام الرجاء محاولة مرة اخري او الاتصال بالمهندس'));
            return redirect()->route('treasury.index');
        };
    }
}
