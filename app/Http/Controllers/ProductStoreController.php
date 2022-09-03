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
        //
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
                        'start_balance'=>$request->balance[$siz],
                        'end_balance'=>$request->balance[$siz],
                        "created_at" => date("Y-m-d h:i:s"),
                    ]);
                }else{
                    array_push($errorBox,[$request->size[$siz],$request->color[$siz],$request->balance[$siz]]);
                }
            }
            if (empty($errorBox)){
                toastr()->success(trans('تم أضافة الارصدة بنجاح'));
                return redirect()->route('productStore.create');
            }else{
                toastr()->warning(trans('تم حفظ بعض الارصدة التي كانت غير موجودة والارصدة التي تكررت لم تحفظ'));
                return redirect()->to('/productStore/create')->with('data', $errorBox);
            }

        }catch (\Exception $e) {
            toastr()->error($e->getMessage());
            //toastr()->error(trans('يوجد مشكلة بالنظام الرجاء محاولة مرة اخري او الاتصال بالمهندس'));
            return redirect()->route('productStore.create');
        };


    }


    public function show(product_store $product_store)
    {
        //
    }


    public function edit(product_store $product_store)
    {
        //
    }


    public function update(Request $request, product_store $product_store)
    {
        //
    }

    public function destroy(product_store $product_store)
    {
        //
    }
}
