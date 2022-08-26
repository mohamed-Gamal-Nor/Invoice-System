<?php

namespace App\Http\Controllers;

use App\Models\units;
use Illuminate\Http\Request;

class UnitsController extends Controller
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
        $units = units::all();
        return view("units.index",compact('units'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255|string|unique:units,name',
            'description' => 'nullable|string|max:255',
        ],[
            'name.required' =>'يجب ادخال اسم الوحدة',
            'name.unique' =>'اسم الوحدة تم ادخاله من قبل',
            'name.max' =>'اسم الوحدة كبير جدا',
            'name.string' =>'اسم الوحدة غير صحيح',
            'description.string' =>'ملاحظات غير صحيحة',
            'description.max' =>'ملاحظات كبيرة جداا',
        ]);
        try {
            $units = new units();
            $units->name = $request->name;
            $units->description = $request->description;
            $units->created_by = auth()->id();
            $units->save();
            toastr()->success(trans('تم أضافة الوحدة بنجاح'));
            return redirect()->route('units.index');
        }catch (\Exception $e) {
            toastr()->error(trans('يوجد مشكلة بالنظام الرجاء محاولة مرة اخري او الاتصال بالمهندس'));
            return redirect()->route('units.index');
        };
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255|string|unique:units,name,'.$request->id,
            'description' => 'nullable|string|max:255',
        ],[
            'name.required' =>'يجب ادخال اسم الوحدة',
            'name.unique' =>'اسم الوحدة تم ادخاله من قبل',
            'name.max' =>'اسم الوحدة كبير جدا',
            'name.string' =>'اسم الوحدة غير صحيح',
            'description.string' =>'ملاحظات غير صحيحة',
            'description.max' =>'ملاحظات كبيرة جداا',
        ]);
        try {
            $units = units::findOrFail($request->id);
            $units->update([
                "name" => $request->name,
                "description" => $request->description,
                "updated_at" => date("Y-m-d h:i:s"),
            ]);

            toastr()->success(trans('تم تعديل بيانات المقاس بنجاح'));
            return redirect()->route('units.index');

        }catch (\Exception $e) {
            toastr()->error(trans('يوجد مشكلة بالنظام الرجاء محاولة مرة اخري او الاتصال بالمهندس'));
            return redirect()->route('units.index');
        };
    }
    public function destroy(Request $request)
    {
        try {
            $ProductSection = units::findOrFail($request->id)->delete();
            toastr()->success(trans('تم حذف الوحدة بنجاح'));
            return redirect()->route('units.index');
        }catch (\Exception $e) {
            toastr()->error(trans('يوجد مشكلة بالنظام الرجاء محاولة مرة اخري او الاتصال بالمهندس'));
            return redirect()->route('units.index');
        };
    }
}
