<?php

namespace App\Http\Controllers;

use App\Models\sizes;
use Illuminate\Http\Request;

class SizesController extends Controller
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
        $sizes = sizes::all();
        return view("sizes.index",compact('sizes'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255|string|unique:sizes,name',
            'description' => 'nullable|string|max:255',
        ],[
            'name.required' =>'يجب ادخال اسم المقاس',
            'name.unique' =>'اسم المقاس تم ادخاله من قبل',
            'name.max' =>'اسم المقاس كبير جدا',
            'name.string' =>'اسم المقاس غير صحيح',
            'description.string' =>'ملاحظات غير صحيحة',
            'description.max' =>'ملاحظات كبيرة جداا',
        ]);
        try {
            $sizes = new sizes();
            $sizes->name = $request->name;
            $sizes->description = $request->description;
            $sizes->created_by = auth()->id();
            $sizes->save();
            toastr()->success(trans('تم أضافة المقاس بنجاح'));
            return redirect()->route('sizes.index');
        }catch (\Exception $e) {
            toastr()->error(trans('يوجد مشكلة بالنظام الرجاء محاولة مرة اخري او الاتصال بالمهندس'));
            return redirect()->route('sizes.index');
        };
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255|string|unique:sizes,name,'.$request->id,
            'description' => 'nullable|string|max:255',
        ],[
            'name.required' =>'يجب ادخال اسم المقاس',
            'name.unique' =>'اسم المقاس تم ادخاله من قبل',
            'name.max' =>'اسم المقاس كبير جدا',
            'name.string' =>'اسم المقاس غير صحيح',
            'description.string' =>'ملاحظات غير صحيحة',
            'description.max' =>'ملاحظات كبيرة جداا',
        ]);
        try {
            $sizes = sizes::findOrFail($request->id);
            $sizes->update([
                "name" => $request->name,
                "description" => $request->description,
                "updated_at" => date("Y-m-d h:i:s"),
            ]);

            toastr()->success(trans('تم تعديل بيانات المقاس بنجاح'));
            return redirect()->route('sizes.index');

        }catch (\Exception $e) {
            toastr()->error(trans('يوجد مشكلة بالنظام الرجاء محاولة مرة اخري او الاتصال بالمهندس'));
            return redirect()->route('sizes.index');
        };
    }
    public function destroy(Request $request)
    {
        try {
            $ProductSection = sizes::findOrFail($request->id)->delete();
            toastr()->success(trans('تم حذف المقاس بنجاح'));
            return redirect()->route('sizes.index');
        }catch (\Exception $e) {
            toastr()->error(trans('يوجد مشكلة بالنظام الرجاء محاولة مرة اخري او الاتصال بالمهندس'));
            return redirect()->route('sizes.index');
        };
    }
}
