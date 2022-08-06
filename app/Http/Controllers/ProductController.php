<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\ProductSection;
use Illuminate\Http\Request;

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
        $productSection = ProductSection::select('id','name')->get();
        return view('Product.create',compact('productSection'));
    }


    public function store(Request $request)
    {
        echo ($request);
    }


    public function show(product $product)
    {
        //
    }


    public function edit(product $product)
    {
        //
    }


    public function update(Request $request, product $product)
    {
        //
    }


    public function destroy(product $product)
    {
        //
    }
}
