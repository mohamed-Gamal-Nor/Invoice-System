<?php

namespace App\Http\Controllers;

use App\Models\customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function index()
    {
        $customer= customer::all();
        return view("customer.index",compact('customer'));
    }


    public function create()
    {
        return view('customer.create',);
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            "name"=>'required|string|min:3|max:100',
            "phone_one"=>'required|numeric|digits:11|regex:/(01)[0-5]{1}[0-9]{8}/|unique:customers,phone_one|unique:customers,phone_two|different:phone_two',
            "phone_two"=>'nullable|numeric|digits:11|regex:/(01)[0-5]{1}[0-9]{8}/|unique:customers,phone_two|unique:customers,phone_one|different:phone_one',
            "address_one"=>'required|string|min:3|max:100',
            "address_two"=>'nullable|string|min:3|max:100',
            "email"=>'nullable|email|unique:customers,email|regex:/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,8}$/',
            "description"=>'nullable|string|max:255',
        ],[
            'name.required' => 'يجب ادخال اسم العميل',
            'phone_one.required' => 'يجب ادخال رقم الهاتف الاول للعميل',
            'phone_one.numeric' => 'رقم الهاتف الاول غير صحيح',
            'phone_one.digits' => 'رقم الهاتف الاول يجب ان لايزيد او يقل عن 11 رقم',
            'phone_one.regex' => 'رقم الهاتف الاول غير مطابق للارقام الخاصة بدولة مصر',
            'phone_one.unique' => 'رقم الهاتف الاول تم تسجيله مسبقا',
            'phone_two.numeric' => 'رقم الهاتف الثاني غير صحيح',
            'phone_two.digits' => 'رقم الهاتف الثاني يجب ان لايزيد او يقل عن 11 رقم',
            'phone_two.regex' => 'رقم الهاتف الثاني غير مطابق للارقام الخاصة بدولة مصر',
            'phone_two.unique' => 'رقم الهاتف الثاني تم تسجيله مسبقا',
            'address_one.required' => 'يجب ادخال عنوان العميل الاول',
            'email.email' => 'هذا البريد الاليكتروني غير صحيح',
            'email.unique' => 'هذا البريد الاليكتروني تم ادخاله مسبقا',
            'email.regex' => 'هذا البريد غير مطابق',
        ]);
        try {
            $customer= new customer();
            $customer->name = $request->name;
            $customer->phone_one  = $request->phone_one;
            $customer->phone_two  = $request->phone_two;
            $customer->address_one = $request->address_one;
            $customer->address_two = $request->address_two;
            $customer->email  = $request->email;
            $customer->description = $request->description;
            $customer->created_by = auth()->id();
            $customer->save();
            toastr()->success(trans('تم أضافة العميل  بنجاح'));
            return redirect()->route('customer.create');
        }catch (\Exception $e) {
            toastr()->error($e->getMessage());
            //toastr()->error(trans('يوجد مشكلة بالنظام الرجاء محاولة مرة اخري او الاتصال بالمهندس'));
            return redirect()->route('customer.create');
        };
    }


    public function show($id)
    {
        $customer = customer::find($id);
        return view('customer.show',compact('customer'));
    }

    public function edit($id)
    {
        $customer = customer::find($id);
        return view('customer.edit',compact('customer'));
    }

    public function update(Request $request,$id)
    {
        $this->validate($request, [
            "name"=>'required|string|min:3|max:100',
            "phone_one"=>'required|numeric|digits:11|regex:/(01)[0-5]{1}[0-9]{8}/|unique:customers,phone_one,'.$request->id.'|unique:customers,phone_two,'.$request->id.'|different:phone_two',
            "phone_two"=>'nullable|numeric|digits:11|regex:/(01)[0-5]{1}[0-9]{8}/|unique:customers,phone_two,'.$request->id.'|unique:customers,phone_one,'.$request->id.'|different:phone_one',
            "address_one"=>'required|string|min:3|max:100',
            "email"=>'nullable|email|regex:/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,8}$/|unique:customers,email,'.$request->id,
            "description"=>'nullable|string|max:255',
        ],[
            'name.required' => 'يجب ادخال اسم العميل',
            'phone_one.required' => 'يجب ادخال رقم الهاتف الاول للعميل',
            'phone_one.numeric' => 'رقم الهاتف الاول غير صحيح',
            'phone_one.digits' => 'رقم الهاتف الاول يجب ان لايزيد او يقل عن 11 رقم',
            'phone_one.regex' => 'رقم الهاتف الاول غير مطابق للارقام الخاصة بدولة مصر',
            'phone_one.unique' => 'رقم الهاتف الاول تم تسجيله مسبقا',
            'phone_two.numeric' => 'رقم الهاتف الثاني غير صحيح',
            'phone_two.digits' => 'رقم الهاتف الثاني يجب ان لايزيد او يقل عن 11 رقم',
            'phone_two.regex' => 'رقم الهاتف الثاني غير مطابق للارقام الخاصة بدولة مصر',
            'phone_two.unique' => 'رقم الهاتف الثاني تم تسجيله مسبقا',
            'address_one.required' => 'يجب ادخال عنوان العميل الاول',
            'email.email' => 'هذا البريد الاليكتروني غير صحيح',
            'email.unique' => 'هذا البريد الاليكتروني تم ادخاله مسبقا',
            'email.regex' => 'هذا البريد غير مطابق',
        ]);
        try {
            $customer = customer::findOrFail($request->id);
            $customer->update([
                "name" => $request->name,
                "phone_one" => $request->phone_one,
                "phone_two" => $request->phone_two,
                "address_one" => $request->address_one,
                "address_two" => $request->address_two,
                "email" => $request->email,
                "description" => $request->description,
                "updated_at" => date("Y-m-d h:i:s"),
            ]);
            toastr()->success(trans('تم تعديل بيانات العميل بنجاح'));
            return redirect()->route('customer.index');

        }catch (\Exception $e) {
            toastr()->error(trans('يوجد مشكلة بالنظام الرجاء محاولة مرة اخري او الاتصال بالمهندس'));
            return redirect()->route('customer.index');
        };
    }

    public function destroy(Request $request)
    {
        try {
            $customer = customer::findOrFail($request->id)->delete();
            toastr()->success(trans('تم حذف العميل بنجاح'));
            return redirect()->route('customer.index');
        }catch (\Exception $e) {
            toastr()->error(trans('يوجد مشكلة بالنظام الرجاء محاولة مرة اخري او الاتصال بالمهندس'));
            return redirect()->route('customer.index');
        };
    }
}
