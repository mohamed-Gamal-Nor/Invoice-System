<?php

namespace App\Http\Controllers;

use App\Models\product_store;
use App\Models\product;
use App\Models\storge;
use App\Models\sizes;
use App\Models\colors;
use Illuminate\Http\Request;

class ProductStoreController extends Controller
{

    public function index()
    {
        $StartBalance = product_store::where('status','=',0)->get();
        return view('productStore.index',compact('StartBalance'));
    }


    public function create()
    {
        $product = product::select('id','product_name')->get();
        $storage = storge::select('id','name')->get();
        $size = sizes::select('id','name')->get();
        $colors = colors::select('id','name')->get();
        return view('productStore.create',compact('product','storage','size','colors'));
    }


    public function store(Request $request)
    {



        $this->validate($request, [
            'product' => 'required|exists:products,id',
            'store' => 'required|exists:storges,id',
            'size' => 'required|array|min:1',
            'size.*' => 'required|exists:sizes,id',
            'color' => 'required|array|min:1',
            'color.*' => 'required|exists:colors,id',
            'balance' => 'required|array|min:1',
            'balance.*' => 'required|numeric|min:0',
        ],[
            'product.required'=>"يجب اختيار المنتج",
            'product.exists'=>"هذا المنتج غير موجود",
            'store.required'=>"يجب اختيار المخزن",
            'store.exists'=>"هذا المخزن غير موجود",
            'size.*.required'=>"يجب اختيار المقاس",
            'size.*.exists'=>"هذا المقاس غير موجود",
            'size.*.distinct'=>"تم اختيار المقاس اكثر من مره",
            'color.*.required'=>"يجب اختيار اللون",
            'color.*.exists'=>"هذا اللون غير موجود",
            'color.*.distinct'=>"تم اختيار اللون اكثر من مره",
            'balance.*.required'=>"يجب ادخال الرصيد حتي وان كان صفر",
            'balance.*.numeric'=>"الرصيد يجب ان يكون رقما صحيحا",
            'balance.*.min'=>"اقل قيمة للرصيد هي صفر",
        ]);
        $errorBox=[];
        try {
            foreach($request->size as $siz=>$v){
                $checkRequest=product_store::where('product',$request->product)
                    ->where('size',$request->size[$siz])
                    ->where('color',$request->color[$siz])
                    ->where('store',$request->store)
                    ->count();
                if ($checkRequest == 0){
                    product_store::insert([
                        'product'=>$request->product,
                        "size"=>$request->size[$siz],
                        'color'=>$request->color[$siz],
                        'store'=>$request->store,
                        'qty'=>$request->balance[$siz],
                        'status'=>0,
                        "created_at" => date("Y-m-d h:i:s"),
                    ]);
                }else{
                    $errorBox[] =[
                        'size'=>$request->size[$siz],
                        'color'=>$request->color[$siz],
                        'balance'=>$request->balance[$siz]
                    ];
                }
            }
            if (empty($errorBox)){
                toastr()->success(trans('تم أضافة الارصدة بنجاح'));
                return redirect()->route('productStore.create');

            }else{
                $lastArry=[$errorBox];
                toastr()->warning(trans('تم حفظ بعض الارصدة التي كانت غير موجودة والارصدة التي تكررت لم تحفظ'));
                return redirect()->to('/productStore/create')->with('data', $lastArry);


            }

        }catch (\Exception $e) {
            toastr()->error($e->getMessage());
            //toastr()->error(trans('يوجد مشكلة بالنظام الرجاء محاولة مرة اخري او الاتصال بالمهندس'));
            return redirect()->route('productStore.create');
        };


    }

    public function edit(product_store $product_store)
    {
        //
    }


    public function update(Request $request, product_store $product_store)
    {
        //
    }

    public function destroy(Request $request)
    {
        try {
            $stockIn = product_store::where('product','=',$request->product)
                ->where('size','=',$request->size)
                ->where('color','=',$request->color)
                ->where('store','=',$request->store)
                ->where('status','=',1)
                ->sum('qty');
            $stockOut = product_store::where('product','=',$request->product)
                ->where('size','=',$request->size)
                ->where('color','=',$request->color)
                ->where('store','=',$request->store)
                ->where('status','=',2)
                ->sum('qty');
            if ($stockIn >= $stockOut){
                $product_store = product_store::findOrFail($request->id)->delete();
                toastr()->success(trans('تم حذف الرصيد بنجاح'));
                return redirect()->route('productStore.index');
            }else{
                toastr()->warning(trans('لم يتم حذف الرصيد لان اجمالي الرصيد للمنتج غير كافي'));
                return redirect()->route('productStore.index');
            }
        }catch (\Exception $e) {
            toastr()->error(trans('يوجد مشكلة بالنظام الرجاء محاولة مرة اخري او الاتصال بالمهندس'));
            return redirect()->route('productSection.index');
        };
    }
}
