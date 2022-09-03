<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\units;
use App\Models\ProductSection;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
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
        $products = product::all();
        return view("Product.index",compact('products'));
    }


    public function create()
    {
        $unit = units::select('id','name')->get();
        $productSection = ProductSection::select('id','name')->get();
        return view('Product.create',compact('productSection',"unit"));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'product_name' => 'required|unique:products,product_name|string|min:3|max:100',
            'product_number' => 'nullable|string|min:3|max:100',
            'purchasing_price' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            "selling_price" => "required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/",
            'section' => 'required|numeric|exists:product_sections,id',
            'unit' => 'required|numeric|exists:units,id',
            "description" => "nullable|string|max:255",
            "product_image" => "nullable|mimes:jpg,jpeg,png|max:5000"
        ],[
            'product_name.required' => 'يجب ادخال اسم المنتج',
            'product_name.unique' => 'اسم المنتج تم استخدامه من قبل',
            'product_name.string' => 'اسم المنتج غير صحيح',
            'product_name.min' => 'اسم المنتج لا يقل عن 3 حروف',
            'product_name.max' => 'اسم المنتج لا يزيد عن 100 حرف',
            'product_number.string' => 'رقم المنتج غير صحيح',
            'product_number.min' => 'رقم المنتج لا يقل عن 3 حروف',
            'product_number.max' => 'رقم المنتج لا يزيد عن 100 حرف',
            'purchasing_price.required' => 'يجب ادخال سعر الشراء',
            'purchasing_price.regex' => 'سعر الشراء غير صحيح',
            'selling_price.required' => 'يجب ادخال سعر البيع',
            'selling_price.regex' => 'سعر البيع غير صحيح',
            'section.required' => 'يجب اختيار القسم الخاص بالمنتج',
            'section.numeric' => 'هذا القسم غير صحيح',
            'section.exists' => 'هذا القسم غير مدرج بالنظام',
            'unit.required' => 'يجب اختيار وحدة القياس الخاص بالمنتج',
            'unit.numeric' => 'هذا وحدة القياس غير صحيح',
            'unit.exists' => 'هذا وحدة القياس غير مدرج بالنظام',
            'description.string' => 'الملاحظات غير صحيح',
            'description.max' => 'الملاحظات لاي تزيد عن 255 حرف',
            'product_image.mimes' => 'برجاء اختيار صورة صحيحة',
            'product_image.max' => 'حجم الصورة لا يزيد عن 5 ميجا',
        ]);
        try {
            $product= new product();
            $product->product_name = $request->product_name;
            $product->product_number = $request->product_number;
            $product->purchasing_price = $request->purchasing_price;
            $product->selling_price = $request->selling_price;
            $product->section = $request->section;
            $product->unit = $request->unit;
            $product->description = $request->description;
            $product->created_by = auth()->id();
            $product->save();
            if (!empty($request->product_image)) {
                $lastID = product::latest()->first()->id;
                $imageName = time() . '.' . $request->product_image->getClientOriginalExtension();
                $request->product_image->storeAs($lastID, $imageName, $disk = 'product_image');
                $userAfter = product::find($lastID);
                $userAfter->update([
                    'product_image' => $imageName
                ]);
            }
            toastr()->success(trans('تم أضافة المنتج  بنجاح'));
            return redirect()->route('product.create');
        }catch (\Exception $e) {

            toastr()->error(trans('يوجد مشكلة بالنظام الرجاء محاولة مرة اخري او الاتصال بالمهندس'));
            return redirect()->route('product.create');
        };
    }


    public function edit($id)
    {
        $product = product::find($id);
        $productSection = ProductSection::select('id','name')->get();
        $unit = units::select('id','name')->get();
        return view('product.edit',compact('product','productSection','unit'));
    }


    public function update(Request $request)
    {
        $this->validate($request, [
            'product_name' => 'required|string|min:3|max:100|unique:products,product_name,'.$request->id,
            'product_number' => 'nullable|string|min:3|max:100',
            'purchasing_price' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            "selling_price" => "required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/",
            'section' => 'required|numeric|exists:product_sections,id',
            "description" => "nullable|string|max:255",
            'unit' => 'required|numeric|exists:units,id',
            "product_image" => "nullable|mimes:jpg,jpeg,png|max:5000"
        ],[
            'product_name.required' => 'يجب ادخال اسم المنتج',
            'product_name.unique' => 'اسم المنتج تم استخدامه من قبل',
            'product_name.string' => 'اسم المنتج غير صحيح',
            'product_name.min' => 'اسم المنتج لا يقل عن 3 حروف',
            'product_name.max' => 'اسم المنتج لا يزيد عن 100 حرف',
            'product_number.string' => 'رقم المنتج غير صحيح',
            'product_number.min' => 'رقم المنتج لا يقل عن 3 حروف',
            'product_number.max' => 'رقم المنتج لا يزيد عن 100 حرف',
            'purchasing_price.required' => 'يجب ادخال سعر الشراء',
            'purchasing_price.regex' => 'سعر الشراء غير صحيح',
            'selling_price.required' => 'يجب ادخال سعر البيع',
            'selling_price.regex' => 'سعر البيع غير صحيح',
            'section.required' => 'يجب اختيار القسم الخاص بالمنتج',
            'section.numeric' => 'هذا القسم غير صحيح',
            'section.exists' => 'هذا القسم غير مدرج بالنظام',
            'unit.required' => 'يجب اختيار وحدة القياس الخاص بالمنتج',
            'unit.numeric' => 'هذا وحدة القياس غير صحيح',
            'unit.exists' => 'هذا وحدة القياس غير مدرج بالنظام',
            'description.string' => 'الملاحظات غير صحيح',
            'description.max' => 'الملاحظات لاي تزيد عن 255 حرف',
            'product_image.mimes' => 'برجاء اختيار صورة صحيحة',
            'product_image.max' => 'حجم الصورة لا يزيد عن 5 ميجا',
        ]);
        try {
            $product = product::findOrFail($request->id);
            $imageUpdate=null;
            if(!empty($request->product_image)){
                $imageUpdate = time() . '.' . $request->product_image->getClientOriginalExtension();
                $request->product_image->storeAs($request->id, $imageUpdate, $disk = 'product_image');
            }else{
                $imageUpdate = $product->product_image;
            }
            $product->update([
                "product_name" => $request->product_name,
                "product_number" => $request->product_number,
                "purchasing_price" => $request->purchasing_price,
                "selling_price" => $request->selling_price,
                "section" => $request->section,
                "unit" => $request->unit,
                "product_image" => $imageUpdate,
                "description" => $request->description,
                "updated_at" => date("Y-m-d h:i:s"),
            ]);
            toastr()->success(trans('تم تعديل المنتج بنجاح'));
            return redirect()->route('product.index');
        }catch (\Exception $e) {

            toastr()->error(trans('يوجد مشكلة بالنظام الرجاء محاولة مرة اخري او الاتصال بالمهندس'));
            return redirect()->route('product.index');
        };

    }


    public function destroy(Request $request)
    {
        try {
            $product = product::findOrFail($request->id)->delete();
            Storage::deleteDirectory('public/product_image/'.$request->id);
            toastr()->success(trans('تم حذف المنتج بنجاح'));
            return redirect()->route('product.index');
        }catch (\Exception $e) {
            toastr()->error(trans('يوجد مشكلة بالنظام الرجاء محاولة مرة اخري او الاتصال بالمهندس'));
            return redirect()->route('product.index');
        };
    }
}
