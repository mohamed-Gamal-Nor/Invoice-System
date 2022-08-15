<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductSectionVaild;
use App\Models\ProductSection;
use Illuminate\Http\Request;

class ProductSectionController extends Controller
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
        $ProductSection = ProductSection::all();
        return view("ProductSection.index",compact('ProductSection'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255|string|unique:product_sections,name',
            'description' => 'nullable|string|max:255',
        ],[
            'name.required' =>'يجب ادخال اسم القسم',
            'name.unique' =>'اسم القسم تم ادخاله من قبل',
            'name.max' =>'اسم القسم كبير جدا',
            'name.string' =>'اسم قسم غير صحيح',
            'description.string' =>'ملاحظات غير صحيحة',
            'description.max' =>'ملاحظات كبيرة جداا',
        ]);
        try {
            $section = new ProductSection();
            $section->name = $request->name;
            $section->description = $request->description;
            $section->created_by = auth()->id();
            $section->save();
            toastr()->success(trans('تم أضافة القسم بنجاح'));
            return redirect()->route('productSection.index');
        }catch (\Exception $e) {
            toastr()->error(trans('يوجد مشكلة بالنظام الرجاء محاولة مرة اخري او الاتصال بالمهندس'));
            return redirect()->route('productSection.index');
        };
    }
    public function update(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|max:255|string|unique:product_sections,name,'.$request->id,
            'description' => 'nullable|string|max:255',
        ],[
            'name.required' =>'يجب ادخال اسم القسم',
            'name.unique' =>'اسم القسم تم ادخاله من قبل',
            'name.max' =>'اسم القسم كبير جدا',
            'name.string' =>'اسم قسم غير صحيح',
            'description.string' =>'ملاحظات غير صحيحة',
            'description.max' =>'ملاحظات كبيرة جداا',
        ]);
        try {
            $section = ProductSection::findOrFail($request->id);
            $section->update([
                "name" => $request->name,
                "description" => $request->description,
                "updated_at" => date("Y-m-d h:i:s"),
            ]);

            toastr()->success(trans('تم تعديل بيانات القسم بنجاح'));
            return redirect()->route('productSection.index');

        }catch (\Exception $e) {
            toastr()->error(trans('يوجد مشكلة بالنظام الرجاء محاولة مرة اخري او الاتصال بالمهندس'));
            return redirect()->route('productSection.index');
        };
    }


    public function destroy(Request $request)
    {
        try {
            $ProductSection = ProductSection::findOrFail($request->id)->delete();
            toastr()->success(trans('تم حذف القسم بنجاح'));
            return redirect()->route('productSection.index');
        }catch (\Exception $e) {
            toastr()->error(trans('يوجد مشكلة بالنظام الرجاء محاولة مرة اخري او الاتصال بالمهندس'));
            return redirect()->route('productSection.index');
        };
    }
}
