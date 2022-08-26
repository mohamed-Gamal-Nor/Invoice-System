<?php

namespace App\Http\Controllers;

use App\Models\colors;
use Illuminate\Http\Request;

class ColorsController extends Controller
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
        $colors = colors::all();
        return view("colors.index",compact('colors'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255|string|unique:colors,name',
            'rgb' => ['required','unique:colors,rgb','regex:/^(#(?:[0-9a-f]{2}){2,4}|#[0-9a-f]{3}|(?:rgba?|hsla?)\((?:\d+%?(?:deg|rad|grad|turn)?(?:,|\s)+){2,3}[\s\/]*[\d\.]+%?\))$/i'],
            'description' => 'nullable|string|max:255',
        ],[
            'name.required' =>'يجب ادخال اسم المقاس',
            'name.unique' =>'اسم المقاس تم ادخاله من قبل',
            'name.max' =>'اسم المقاس كبير جدا',
            'name.string' =>'اسم المقاس غير صحيح',
            'rgb.required' =>'يجب اختيار اللون',
            'rgb.unique' =>'هذا اللون تم اختياره من قبل',
            'rgb.regex' =>'خطأ في اختيار اللون',
            'description.string' =>'ملاحظات غير صحيحة',
            'description.max' =>'ملاحظات كبيرة جداا',
        ]);

        try {
            $colors = new colors();
            $colors->name = $request->name;
            $colors->rgb = $request->rgb;
            $colors->description = $request->description;
            $colors->created_by = auth()->id();
            $colors->save();
            toastr()->success(trans('تم أضافة اللون بنجاح'));
            return redirect()->route('colors.index');
        }catch (\Exception $e) {
            toastr()->error(trans('يوجد مشكلة بالنظام الرجاء محاولة مرة اخري او الاتصال بالمهندس'));
            return redirect()->route('colors.index');
        };

    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255|string|unique:colors,name,'.$request->id,
            'rgb' => ['required','unique:colors,rgb,'.$request->id,'regex:/^(#(?:[0-9a-f]{2}){2,4}|#[0-9a-f]{3}|(?:rgba?|hsla?)\((?:\d+%?(?:deg|rad|grad|turn)?(?:,|\s)+){2,3}[\s\/]*[\d\.]+%?\))$/i'],
            'description' => 'nullable|string|max:255',
        ],[
            'name.required' =>'يجب ادخال اسم المقاس',
            'name.unique' =>'اسم المقاس تم ادخاله من قبل',
            'name.max' =>'اسم المقاس كبير جدا',
            'name.string' =>'اسم المقاس غير صحيح',
            'rgb.required' =>'يجب اختيار اللون',
            'rgb.unique' =>'هذا اللون تم اختياره من قبل',
            'rgb.regex' =>'خطأ في اختيار اللون',
            'description.string' =>'ملاحظات غير صحيحة',
            'description.max' =>'ملاحظات كبيرة جداا',
        ]);
        try {
            $colors = colors::findOrFail($request->id);
            $colors->update([
                "name" => $request->name,
                "rgb" => $request->rgb,
                "description" => $request->description,
                "updated_at" => date("Y-m-d h:i:s"),
            ]);

            toastr()->success(trans('تم تعديل بيانات اللون بنجاح'));
            return redirect()->route('colors.index');

        }catch (\Exception $e) {
            toastr()->error(trans('يوجد مشكلة بالنظام الرجاء محاولة مرة اخري او الاتصال بالمهندس'));
            return redirect()->route('colors.index');
        };
    }
    public function destroy(Request $request)
    {
        try {
            $ProductSection = colors::findOrFail($request->id)->delete();
            toastr()->success(trans('تم حذف اللون بنجاح'));
            return redirect()->route('colors.index');
        }catch (\Exception $e) {
            toastr()->error(trans('يوجد مشكلة بالنظام الرجاء محاولة مرة اخري او الاتصال بالمهندس'));
            return redirect()->route('colors.index');
        };
    }
}
