<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if($printStatus)
        <link rel="stylesheet" href="{{asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    @endif
</head>
<style>
    body{
        direction: rtl !important;
    }
    header{
        width: 100% !important;
        text-align: center !important;
    }
    h1 {
        border-top: 1px solid  #5D6975;
        border-bottom: 1px solid  #5D6975;
        color: #5D6975;
        font-size: 2.4em;
        font-weight: normal;
        text-align: center;
    }
</style>
<body>
@if(!$printStatus)
    <div id="excel">
        <header>
            <div style="text-align: center">
                <img style="width: 50px; margin: 0" src="{{asset('assets/images/logo.png')}}">
            </div>
            <h1>فاتورة مشتريات موردين</h1>
            <div style="text-align: center;direction: rtl">
                <h3 >رقم الفاتورة / <span> {{$invoiceData->id}}</span>  رقم الاذن / <span> {{$invoiceData->id}}</span></h3>
                <h3>تاريخ الفاتورة / <span> {{$invoiceData->date}}</span></h3>
                <h3>كود المورد / <span>  {{$invoiceData->supplier_id }}</span></h3>
                <h3>اسم المورد / <span> {{$invoiceData->supplier->name }}</span></h3>
                <h3>مخزن الاضافة / <span>  {{$invoiceData->storage->name }}</span></h3>

            </div>
        </header>
        <hr style="margin-bottom: 5px">
        <main>
            <table style="width: 100%;" >
                <thead style="text-align: center;border-collapse: collapse;">
                <tr>
                    <th style="width: 5%;height: 20px">#</th>
                    <th style="width: 20%">اسم الصنف</th>
                    <th style="width: 5%">اللون</th>
                    <th style="width: 5%">المقاس</th>
                    <th style="width: 5%">الكمية</th>
                    <th style="width: 10%">السعر</th>
                    <th style="width: 10%">نسبة الخصم</th>
                    <th style="width: 10%">قيمة الخصم</th>
                    <th style="width: 10%">نسبة الضريبة</th>
                    <th style="width: 10%">قيمة الضريبة</th>
                    <th style="width: 10%">الاجمالي</th>
                </tr>
                </thead>
                <tbody>
                <?php $i =0?>
                @foreach($invoiceData->items as $item)
                    <?php $i++?>
                    <tr style="font-size: 7px">
                        <td style="width: 5%;height: 15px">{{$i}}</td>
                        <td style="width: 20%">{{$item->productData->product_name}}</td>
                        <td style="width: 5%">{{$item->colorData->name}}</td>
                        <td style="width: 5%">{{$item->sizeData->name}}</td>
                        <td style="width: 5%">{{$item->quantity}}</td>
                        <td style="width: 10%">{{number_format($item->price,2)}} <span>ج.م</span></td>
                        <td style="width: 10%">{{number_format($item->discount_vat,2)}}%</td>
                        <td style="width: 10%">{{number_format(($item->quantity*$item->price)*$item->discount_vat/100,2)}} <span>ج.م</span></td>
                        <td style="width: 10%">{{number_format($item->rate_vat,2)}}%</td>
                        <td style="width: 10%">{{number_format(($item->quantity*$item->price)*$item->rate_vat/100,2)}} <span>ج.م</span></td>
                        <td style="width: 10%">{{number_format($item->total,2)}} <span>ج.م</span></td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr >
                    <td style="height: 30px"></td>
                </tr>
                <tr>
                    <td colspan="7" style="height: 20px"></td>
                    <td colspan="2"><strong>الاجمالي</strong></td>
                    <td colspan="2" style="text-align: left">{{number_format($invoiceData->sub_total,2)}} <span>ج.م</span></td>
                </tr>
                <tr>
                    <td colspan="7" style="height: 20px"></td>
                    <td colspan="2"><strong>نسبة الخصم ({{number_format($invoiceData->discount_vat,2)}}%)</strong></td>
                    <td colspan="2" style="text-align: left">{{number_format($invoiceData->sub_total *($invoiceData->discount_vat /100) ,2)}}  <span>ج.م</span></td>
                </tr>
                <tr>
                    <td colspan="7" style="height: 20px"></td>
                    <td colspan="2"><strong>نسبة الضريبة ({{number_format($invoiceData->rate_vat,2)}}%)</strong></td>
                    <td colspan="2" style="text-align: left">{{number_format($invoiceData->sub_total *($invoiceData->rate_vat /100) ,2)}}  <span>ج.م</span></td>
                </tr>
                <tr>
                    <td colspan="7" style="height: 20px"></td>
                    <td colspan="2"><strong>صافي الاجمالي</strong></td>
                    <td colspan="2" style="text-align: left">
                        <strong>
                            {{number_format((($invoiceData->sub_total) + ($invoiceData->sub_total *($invoiceData->rate_vat /100)) - ($invoiceData->sub_total *($invoiceData->discount_vat /100))),2)}}<span>ج.م</span>
                        </strong>
                    </td>
                </tr>
                </tfoot>
            </table>
            <div id="notices">
                <div>ملاحظات:</div>
                <div class="notice">@if(!empty($invoiceData->note)){{$invoiceData->note }}@endif</div>
            </div>
        </main>
        <footer>
            <table style="width: 100%;margin-top: 20px">
                <thead>
                <tr style="text-align: center">
                    <th style="width: 33%;height: 20px">توقيع اول</th>
                    <th style="width: 33%">توقيع تاني</th>
                    <th style="width: 33%">توقيع ثالث</th>
                </tr>
                </thead>
                <tbody>
                <tr style="text-align: center">
                    <td style="width: 33%;height: 20px">.............................</td>
                    <td style="width: 33%">.............................</td>
                    <td style="width: 33%">.............................</td>
                </tr>
                </tbody>
            </table>
        </footer>
    </div>

@else
    <div class="col-lg-12 " style="direction: rtl;" id="element-to-print">
        <div class="card mt-3">
            <header>
                <div style="text-align: center">
                    <img style="width: 50px; margin: 5px 5px" src="{{asset('assets/images/logo.png')}}">
                </div>
                <h1>فاتورة مشتريات موردين</h1>
                <div style="text-align: center;direction: rtl">
                    <h3 >رقم الفاتورة / <span> {{$invoiceData->id}}</span>  رقم الاذن / <span> {{$invoiceData->id}}</span></h3>
                    <h3>تاريخ الفاتورة / <span> {{$invoiceData->date}}</span></h3>
                    <h3>كود المورد / <span>  {{$invoiceData->supplier_id }}</span></h3>
                    <h3>اسم المورد / <span> {{$invoiceData->supplier->name }}</span></h3>
                    <h3>مخزن الاضافة / <span>  {{$invoiceData->storage->name }}</span></h3>
                    @if(!empty($invoiceData->note))
                        <h3>ملاحظات / <span>{{$invoiceData->note }}</span></h3>
                    @endif
                </div>
            </header>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped verticle-middle table-responsive-sm">
                        <thead>
                        <tr class="text-right">
                            <th >#</th>
                            <th>اسم الصنف</th>
                            <th>اللون</th>
                            <th>المقاس</th>
                            <th>الكمية</th>
                            <th>السعر</th>
                            <th>نسبة الخصم</th>
                            <th>قيمة الخصم</th>
                            <th>نسبة الضريبة</th>
                            <th>قيمة الضريبة</th>
                            <th>الاجمالي</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i =0?>
                        @foreach($invoiceData->items as $item)
                            <?php $i++?>
                            <tr class="text-right">
                                <td>{{$i}}</td>
                                <td>{{$item->productData->product_name}}</td>
                                <td>{{$item->colorData->name}}</td>
                                <td>{{$item->sizeData->name}}</td>
                                <td>{{$item->quantity}}</td>
                                <td>{{number_format($item->price,2)}} <span>ج.م</span></td>
                                <td>{{number_format($item->discount_vat,2)}}%</td>
                                <td>{{number_format(($item->quantity*$item->price)*$item->discount_vat/100,2)}} <span>ج.م</span></td>
                                <td>{{number_format($item->rate_vat,2)}}%</td>
                                <td>{{number_format(($item->quantity*$item->price)*$item->rate_vat/100,2)}} <span>ج.م</span></td>
                                <td>{{number_format($item->total,2)}} <span>ج.م</span></td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-sm-6"> </div>
                    <div class="col-lg-6 col-sm-6 ml-auto">
                        <table class="table table-clear">
                            <tbody>
                            <tr>
                                <td class="left"><strong>الاجمالي</strong></td>
                                <td class="right">{{number_format($invoiceData->sub_total,2)}} <span>ج.م</span></td>
                            </tr>
                            <tr>
                                <td class="left"><strong>نسبة الخصم ({{number_format($invoiceData->discount_vat,2)}}%)</strong></td>
                                <td class="right">{{number_format($invoiceData->sub_total *($invoiceData->discount_vat /100) ,2)}}  <span>ج.م</span></td>
                            </tr>
                            <tr>
                                <td class="left"><strong>نسبة الضريبة ({{number_format($invoiceData->rate_vat,2)}}%)</strong></td>
                                <td class="right">{{number_format($invoiceData->sub_total *($invoiceData->rate_vat /100) ,2)}}  <span>ج.م</span></td>
                            </tr>
                            <tr>
                                <td class="left"><strong>صافي الاجمالي</strong></td>
                                <td class="right">
                                    <strong>
                                        {{number_format((($invoiceData->sub_total) + ($invoiceData->sub_total *($invoiceData->rate_vat /100)) - ($invoiceData->sub_total *($invoiceData->discount_vat /100))),2)}}<span>ج.م</span>
                                    </strong>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
                <table style="width: 100%;margin-top: 20px">
                    <thead>
                    <tr style="text-align: center">
                        <th style="width: 33%;height: 20px">توقيع اول</th>
                        <th style="width: 33%">توقيع تاني</th>
                        <th style="width: 33%">توقيع ثالث</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr style="text-align: center">
                        <td style="width: 33%;height: 20px">.............................</td>
                        <td style="width: 33%">.............................</td>
                        <td style="width: 33%">.............................</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @if($printStatus)
        <script type="text/javascript">
            window.print();
        </script>
    @endif


@endif
@if($excelSheet)
    <script type="text/javascript" src="{{ URL::asset('assets/vendor/global/global.min.js') }}"></script>
    <script type="text/javascript">
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('div[id=excel]').html()));
        window.close();
    </script>
@endif
</body>
</html>
