<div class="row">
    <div class="col-lg-12">
        <div class="card">
            @if($invoicesList)
                <div class="card-header">
                    <h4 class="card-title">قائمة فواتير المشتريات</h4>
                    <button  class="btn btn-primary" wire:click="invoiceCreateForm"><i class="las la-plus"></i> أضافة فاتورة</button>
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col">
                            <label>المورد</label>
                            <select  class="form-control" wire:model="supplierId">
                                <option value="">جميع الموردين</option>
                                @forelse($supplier as $sup)
                                    <option value="{{$sup->id}}">{{$sup->name}}</option>
                                @empty
                                    <option>لم يتم انشاء موردين</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group col">
                            <label>المخزن</label>
                            <select class="form-control" wire:model="storageId">
                                <option value="">جميع المخازن</option>
                                @forelse($storage as $sto)
                                    <option value="{{$sto->id}}">{{$sto->name}}</option>
                                @empty
                                    <option>لم يتم انشاء مخازن</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group col">
                            <label>قيمة الفاتورة</label>
                            <input type="number" class="form-control" wire:model="amount">
                        </div>
                        <div class="form-group col">
                            <label>رقم الفاتورة</label>
                            <input type="number" class="form-control" wire:model="invoiceNumber">
                        </div>
                        <div class="form-group col">
                            <label>من الفترة</label>
                            <input type="date" class="form-control" wire:model="fromDate">
                        </div>
                        <div class="form-group col">
                            <label>الي الفترة</label>
                            <input type="date" class="form-control" wire:model="toDate">
                        </div>
                    </div>
                    <div class="table-responsive">

                        <table class="table primary-table-bordered table-bordered table-striped verticle-middle table-responsive-sm">
                            <thead class="thead-primary">
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
                            @forelse($invoices as $invoice)
                                <tr class="text-center">
                                    <td>{{$invoice->id}}</td>
                                    <td>{{$invoice->date}}</td>
                                    <td class="text-danger">{{number_format($invoice->sub_total,2) }} EGP</td>
                                    <td>{{$invoice->supplier->name}}</td>
                                    <td>{{$invoice->storage->name}}</td>
                                    <td>{{$invoice->user->name}}</td>
                                    <td>
                                        @if(!empty($invoice->last_update))
                                            {{$invoice->userUpdate->name}}
                                            @else
                                            لم يتم التعديل ع هذة الفاتورة
                                        @endif

                                    </td>
                                    <td>
                                        <button  class="btn btn-sm btn-primary" ><i class="la la-pencil"></i></button>
                                        <button  class="btn btn-sm btn-success" ><i class="la la-eye"></i></button>
                                        <button  class="btn btn-sm btn-danger"><i class="la la-trash-o"></i></button>
                                    </td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="8"><img style="width: 40%" src="{{URL::asset('assets/images/svg/empty.svg')}}"></td>
                                </tr>
                            @endforelse
                            </tbody>
                            </tfoot>
                        </table>
                        <div>
                            {{ $invoices->links() }}
                        </div>
                    </div>
                </div>
            @endif
            @if($invoiceCreate)
                    @include('livewire.invoices.add')
            @endif
        </div>
    </div>
</div>
