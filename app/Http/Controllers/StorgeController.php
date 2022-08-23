<?php

namespace App\Http\Controllers;

use App\Models\storge;
use Illuminate\Http\Request;

class StorgeController extends Controller
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
        $storage = storge::all();
        return view("storage.index",compact('storage'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255|string|unique:product_sections,name',
            'address' => 'required|max:255|string',
            'description' => 'nullable|string|max:255',
        ],[
            'name.required' =>'يجب ادخال اسم المخزن',
            'name.unique' =>'اسم المخزن تم ادخاله من قبل',
            'name.max' =>'اسم المخزن كبير جدا',
            'name.string' =>'اسم المخزن غير صحيح',
            'address.required' =>'يجب ادخال العنوان',
            'address.max' =>'العنوان كبير جدا',
            'address.string' =>'العنوان غير صحيح',
            'description.string' =>'ملاحظات غير صحيحة',
            'description.max' =>'ملاحظات كبيرة جداا',
        ]);
        try {
            $storage = new storge();
            $storage->name = $request->name;
            $storage->address = $request->address;
            $storage->description = $request->description;
            $storage->created_by = auth()->id();
            $storage->save();
            toastr()->success(trans('تم أضافة المخزن بنجاح'));
            return redirect()->route('store.index');
        }catch (\Exception $e) {
            toastr()->error(trans('يوجد مشكلة بالنظام الرجاء محاولة مرة اخري او الاتصال بالمهندس'));
            return redirect()->route('store.index');
        };
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255|string|unique:product_sections,name,'.$request->id,
            'address' => 'required|max:255|string',
            'description' => 'nullable|string|max:255',
        ],[
            'name.required' =>'يجب ادخال اسم المخزن',
            'name.unique' =>'اسم المخزن تم ادخاله من قبل',
            'name.max' =>'اسم المخزن كبير جدا',
            'name.string' =>'اسم المخزن غير صحيح',
            'address.required' =>'يجب ادخال العنوان',
            'address.max' =>'العنوان كبير جدا',
            'address.string' =>'العنوان غير صحيح',
            'description.string' =>'ملاحظات غير صحيحة',
            'description.max' =>'ملاحظات كبيرة جداا',
        ]);
        try {
            $storage = storge::findOrFail($request->id);
            $storage->update([
                "name" => $request->name,
                "address" => $request->address,
                "description" => $request->description,
                "updated_at" => date("Y-m-d h:i:s"),
            ]);

            toastr()->success(trans('تم تعديل بيانات المخزن بنجاح'));
            return redirect()->route('store.index');

        }catch (\Exception $e) {
            toastr()->error(trans('يوجد مشكلة بالنظام الرجاء محاولة مرة اخري او الاتصال بالمهندس'));
            return redirect()->route('store.index');
        };

    }

    public function destroy(Request $request)
    {
        try {
            $storge = storge::findOrFail($request->id)->delete();
            toastr()->success(trans('تم حذف المخزن بنجاح'));
            return redirect()->route('store.index');
        }catch (\Exception $e) {
            toastr()->error(trans('يوجد مشكلة بالنظام الرجاء محاولة مرة اخري او الاتصال بالمهندس'));
            return redirect()->route('store.index');
        };
    }
}
