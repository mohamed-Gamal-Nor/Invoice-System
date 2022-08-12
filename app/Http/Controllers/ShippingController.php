<?php

namespace App\Http\Controllers;

use App\Models\shipping;
use App\Models\shippingArea;
use App\Models\shippingAreaRelarion;
use Illuminate\Http\Request;

class ShippingController extends Controller
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
        $shipping = shipping::all();
        return view("shipping.index",compact('shipping'));
    }
    public function create()
    {
        $shippingArea = shippingArea::select('id','name')->get();
        return view('shipping.create',compact('shippingArea'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255|string|unique:shippings,name',
            'phone' => 'required|numeric|unique:shippings,phone|digits:11|regex:/(01)[0-5]{1}[0-9]{8}/',
            'area.*' => 'required|exists:shipping_areas,id|distinct',
            'price.*' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'description' => 'nullable|string|max:255',
        ],[
            'name.required' =>'يجب ادخال اسم المندوب',
            'name.unique' =>'اسم المندوب تم ادخاله من قبل',
            'name.max' =>'اسم المندوب كبير جدا',
            'name.string' =>'اسم المندوب غير صحيح',
            'phone.required'=>'يجب ادخال رقم هاتف',
            'phone.numeric'=>'رقم الهاتف غير صحيح',
            'phone.unique'=>'رقم الهاتف مستخدم من قبل',
            'phone.digits'=>'رقم الهاتف هذا يجب ان لايقل او يزيد عن 11 رقم',
            'phone.regex'=>'رقم الهاتف غير صحيح',
            'area.*.required'=>'يجب اختيار المناطق',
            'area.*.exists'=>'هذة المنطقة غير مدرجة بالنظام',
            'area.*.distinct'=>'هذة المنطقة تم ادخالها مرتين',
            'price.*.required'=>'يجب أدخال السعر',
            'price.*.regex'=>'هذا السعر غير صحيح',
            'description.string' =>'ملاحظات غير صحيحة',
            'description.max' =>'ملاحظات كبيرة جداا',
        ]);
        try {
            $shipping = new shipping();
            $shipping->name = $request->name;
            $shipping->phone = $request->phone;
            $shipping->description = $request->description;
            $shipping->created_by = auth()->id();
            $shipping->save();
            $lastID = shipping::latest()->first()->id;
            foreach($request->area as $are=>$v){
                $data2 = array(
                    'shipping_name'=>$lastID,
                    "area"=>$request->area[$are],
                    'price'=>$request->price[$are],
                );
                shippingAreaRelarion::insert($data2);
            }
            toastr()->success(trans('تم أضافة المندوب بنجاح'));
            return redirect()->route('shipping.index');
        }catch (\Exception $e) {
            toastr()->error($e->getMessage());
            //toastr()->error(trans('يوجد مشكلة بالنظام الرجاء محاولة مرة اخري او الاتصال بالمهندس'));
            return redirect()->route('shipping.index');
        };

    }
    public function edit($id)
    {
        $shipping = shipping::find($id);
        $shippingArea = shippingArea::select('id','name')->get();
        return view('shipping.edit',compact('shipping','shippingArea'));
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255|string|unique:shippings,name,'.$request->id,
            'phone' => 'required|numeric|digits:11|regex:/(01)[0-5]{1}[0-9]{8}/|unique:shippings,phone,'.$request->id,
            'description' => 'nullable|string|max:255',
        ],[
            'name.required' =>'يجب ادخال اسم المندوب',
            'name.unique' =>'اسم المندوب تم ادخاله من قبل',
            'name.max' =>'اسم المندوب كبير جدا',
            'name.string' =>'اسم المندوب غير صحيح',
            'phone.required'=>'يجب ادخال رقم هاتف',
            'phone.numeric'=>'رقم الهاتف غير صحيح',
            'phone.unique'=>'رقم الهاتف مستخدم من قبل',
            'phone.digits'=>'رقم الهاتف هذا يجب ان لايقل او يزيد عن 11 رقم',
            'phone.regex'=>'رقم الهاتف غير صحيح',
            'description.string' =>'ملاحظات غير صحيحة',
            'description.max' =>'ملاحظات كبيرة جداا',
        ]);
        try {
            $shipping = shipping::findOrFail($request->id);
            $shipping->update([
                "name" => $request->name,
                "phone" => $request->phone,
                "description" => $request->description,
            ]);

            toastr()->success(trans('تم تعديل بيانات المندوب بنجاح'));
            return redirect()->route('shipping.index');

        }catch (\Exception $e) {
            toastr()->error(trans('يوجد مشكلة بالنظام الرجاء محاولة مرة اخري او الاتصال بالمهندس'));
            return redirect()->route('shipping.index');
        };
    }


    public function destroy(Request $request)
    {
        try {
            $shipping = shipping::findOrFail($request->id)->delete();
            toastr()->success(trans('تم حذف المندوب بنجاح'));
            return redirect()->route('shipping.index');
        }catch (\Exception $e) {
            toastr()->error(trans('يوجد مشكلة بالنظام الرجاء محاولة مرة اخري او الاتصال بالمهندس'));
            return redirect()->route('shipping.index');
        };
    }
}
