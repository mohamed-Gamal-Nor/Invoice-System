<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
class InvoicesController extends Controller
{

    public function index()
    {
        return view('invoices.index');
    }
    public function pdf($id)
    {
        $printStatus = false;
        $excelSheet =false;
        $invoiceData = invoices::find($id);

        $html = view('invoices.pdfInvoice',['invoiceData'=>$invoiceData,'printStatus'=>$printStatus,'excelSheet'=>$excelSheet])->render(); // file render
        $pdfarr = [
            'title'=>'اهلا بكم ',
            'data'=>$html, // render file blade with content html
            'header'=>['show'=>false], // header content
            'footer'=>['show'=>false], // Footer content
            'font'=>'aefurat', //  dejavusans, aefurat ,aealarabiya ,times
            'font-size'=>8, // font-size
            'text'=>'', //Write
            'rtl'=>true, //true or false
            'creator'=>env('APP_NAME'), // creator file - you can remove this key
            'keywords'=>env('APP_NAME'), // keywords file - you can remove this key
            'subject'=>env('APP_NAME'), // subject file - you can remove this key
            'filename'=>'Invoice Supplier Number '.$id.'.pdf', // filename example - invoice.pdf
            'display'=>'stream', // stream , download , print
        ];
        \PDF::HTML($pdfarr);
      return view('invoices.pdfInvoice',compact('invoiceData','printStatus'));
    }
    public function print($id)
    {
        $printStatus = true;
        $excelSheet =false;
        $invoiceData = invoices::find($id);
        return view('invoices.pdfInvoice',compact('invoiceData','printStatus','excelSheet'));
    }
    public function excel($id)
    {
        $printStatus = false;
        $excelSheet =true;
        $invoiceData = invoices::find($id);
        return view('invoices.pdfInvoice',compact('invoiceData','printStatus','excelSheet'));
    }


}
