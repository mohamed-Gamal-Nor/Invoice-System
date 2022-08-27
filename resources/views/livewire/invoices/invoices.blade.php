<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">قائمة المقاسات</h4>
                <button  class="btn btn-primary" data-toggle="modal" data-target=".product-section"><i class="las la-plus"></i> أضافة مقاس</button>
            </div>
            @if($invoicesList)
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example2" class="display" style="width:100%">
                            <thead>
                            <tr>
                                <th>رقم الفاتورة</th>
                                <th>تاريخ الفاتورة</th>
                                <th>اجمالي الفاتورة</th>
                                <th>المورد</th>
                                <th>المخزن</th>
                                <th>أنشا بواسطة</th>
                                <th>اخر تعديل بواسطة</th>
                                <th>العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($invoices as $invoice)
                                <tr>
                                    <td>{{$invoice->id}}</td>
                                    <td>{{$invoice->date}}</td>
                                    <td class="text-danger">{{number_format($invoice->sub_total,2) }} EGP</td>
                                    <td>{{$invoice->supplier->name}}</td>
                                    <td>{{$invoice->storage->name}}</td>
                                    <td>{{$invoice->user->name}}</td>
                                    <td>
                                        @if(!empty($invoice->last_update))
                                            {{$invoice->userUpdate->name}}
                                        @endif
                                        لم يتم التعديل ع هذة الفاتورة
                                    </td>
                                    <td>
                                        <button  class="btn btn-sm btn-primary" ><i class="la la-pencil"></i></button>
                                        <button  class="btn btn-sm btn-success" ><i class="la la-eye"></i></button>
                                        <button  class="btn btn-sm btn-danger"><i class="la la-trash-o"></i></button>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                            </tfoot>
                        </table>
                        {{ $invoices->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
