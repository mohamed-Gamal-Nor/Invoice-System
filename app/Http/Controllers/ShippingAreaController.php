<?php

namespace App\Http\Controllers;

use App\Models\shippingArea;
use Illuminate\Http\Request;

class ShippingAreaController extends Controller
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

        $shippingArea = shippingArea::all();
        return view("shippingArea.index",compact('shippingArea'));

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255|string|unique:shipping_areas,name',
            'price' => 'required|numeric',
            'description' => 'nullable|string|max:255',
        ],[
            'name.required' =>'يجب ادخال اسم المندوب',
            'name.unique' =>'اسم المندوب تم ادخاله من قبل',
            'name.max' =>'اسم المندوب كبير جدا',
            'name.string' =>'اسم المندوب غير صحيح',
            'price.required'=>'يجب ادخال سعر الشحن',
            'price.numeric'=>'سعر الشحن غير صحيح',
            'description.string' =>'ملاحظات غير صحيحة',
            'description.max' =>'ملاحظات كبيرة جداا',
        ]);
        try {
            $shipping = new shippingArea();
            $shipping->name = $request->name;
            $shipping->price = $request->price;
            $shipping->description = $request->description;
            $shipping->created_by = auth()->id();
            $shipping->save();
            toastr()->success(trans('تم أضافة المنطقة بنجاح'));
            return redirect()->route('shippingArea.index');
        }catch (\Exception $e) {
            toastr()->error(trans('يوجد مشكلة بالنظام الرجاء محاولة مرة اخري او الاتصال بالمهندس'));
            return redirect()->route('shippingArea.index');
        };
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255|string|unique:shipping_areas,name,'.$request->id,
            'price' => 'required|numeric',
            'description' => 'nullable|string|max:255',
        ],[
            'name.required' =>'يجب ادخال اسم المندوب',
            'name.unique' =>'اسم المندوب تم ادخاله من قبل',
            'name.max' =>'اسم المندوب كبير جدا',
            'name.string' =>'اسم المندوب غير صحيح',
            'price.required'=>'يجب ادخال سعر الشحن',
            'price.numeric'=>'سعر الشحن غير صحيح',
            'description.string' =>'ملاحظات غير صحيحة',
            'description.max' =>'ملاحظات كبيرة جداا',
        ]);
        try {
            $shipping = shippingArea::findOrFail($request->id);
            $shipping->update([
                "name" => $request->name,
                "price" => $request->price,
                "description" => $request->description,
                "updated_at" => date("Y-m-d h:i:s"),
            ]);

            toastr()->success(trans('تم تعديل بيانات المنطقة بنجاح'));
            return redirect()->route('shippingArea.index');

        }catch (\Exception $e) {
            toastr()->error(trans('يوجد مشكلة بالنظام الرجاء محاولة مرة اخري او الاتصال بالمهندس'));
            return redirect()->route('shippingArea.index');
        };
    }


    public function destroy(Request $request)
    {
        try {
            $shipping = shippingArea::findOrFail($request->id)->delete();
            toastr()->success(trans('تم حذف المنطقة بنجاح'));
            return redirect()->route('shippingArea.index');
        }catch (\Exception $e) {
            toastr()->error(trans('يوجد مشكلة بالنظام الرجاء محاولة مرة اخري او الاتصال بالمهندس'));
            return redirect()->route('shippingArea.index');
        };
    }
}
