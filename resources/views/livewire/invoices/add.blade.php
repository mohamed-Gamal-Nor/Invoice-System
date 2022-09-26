<div class="row">
    <div class="col-xl-12 col-xxl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">أضافة فاتورة</h4>
                <button  class="btn btn-primary" wire:click="invoiceListForm"><i class="las la-list"></i> قائمة فواتير المشتريات</button>
            </div>
            <div class="card-body">
                <div class="multisteps-form">
                    <ol class="step-indicator ps mb-5">
                        <li class="@if($current_step === 1 || $current_step === 2 || $current_step === 3) active @endif" wire:click="setp1()">
                            <div class="step"><i class="las la-file-invoice"></i></div>
                            <div class="caption hidden-xs hidden-sm pb-0"><span>بيانات فاتورة المشتريات</span></div>
                        </li>
                        <li class="@if($current_step === 2|| $current_step === 3 ) active @endif" wire:click="setp2()">
                            <div class="step"><i class="las la-cart-plus"></i></div>
                            <div class="caption hidden-xs hidden-sm pb-0"><span>أضافة الاصناف والكميات</span></div>
                        </li>
                        <li class=" @if($current_step === 3) active @endif" wire:click="setp3()">
                            <div class="step"><i class="las la-print"></i></div>
                            <div class="caption hidden-xs hidden-sm pb-0"><span>مراجعة وطباعة</span></div>
                        </li>
                    </ol>
                    <div class="row">
                        @if($current_step === 1)
                                <div class="col-12 col-lg-12">
                                    <h3 class="multisteps-form__title text-center text-danger">بيانات فاتورة المشتريات <i class="las la-file-invoice"></i></h3>
                                    <hr>
                                    <div class="multisteps-form__content">
                                        <div class="form-row mt-4">
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label"> المورد<span class="text-danger">*</span></label>
                                                    <select class="form-control" wire:model="supplierIdCreate">
                                                        <option value="">اختار المورد</option>
                                                        @forelse($supplier as $sup)
                                                            <option value="{{$sup->id}}">{{$sup->name}}</option>
                                                        @empty
                                                            <option>لم يتم انشاء موردين</option>
                                                        @endforelse
                                                    </select>
                                                    @error('supplierIdCreate')
                                                    <small class="mt-5 mb-5 text-danger">{{ trans($message) }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 mt-4 mt-sm-0">
                                                <div class="form-group">
                                                    <label class="form-label">المخزن<span class="text-danger">*</span></label>
                                                    <select id="inputState" class="form-control" wire:model="storageIdCreate">
                                                        <option value="">أختار المخزن</option>
                                                        @forelse($storage as $sto)
                                                            <option value="{{$sto->id}}">{{$sto->name}}</option>
                                                        @empty
                                                            <option>لم يتم انشاء مخازن</option>
                                                        @endforelse
                                                    </select>
                                                    @error('storageIdCreate')
                                                    <small class="mt-5 mb-5 text-danger">{{ trans($message) }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row mt-4">
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label">التاريخ</label>
                                                    <input type="text" class="form-control" disabled value="{{date('d-m-Y')}}">
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 mt-4 mt-sm-0">
                                                <label class="form-label">عدد الاصناف <span class="text-danger">*</span></label>
                                                <input type="number" max="100" min="1" class="form-control" wire:model="item_count">
                                                @error('item_count')
                                                <small class="mt-5 mb-5 text-danger">{{ trans($message) }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <span class="text-primary">(*) ألزامي</span>
                                        <div class="button-row d-flex float-right clearfix">
                                            <button class="btn btn-primary mr-1 ml-1" wire:click="setp2()">{{__('Next')}}</button>
                                        </div>
                                        <div wire:loading wire:target="setp3" class="font-weight-bold font-xxl text-primary">
                                            <span> تحميل</span>
                                            <i class="fas fa-circle-notch fa-spin"></i>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @if($current_step === 2)
                            <div class="col-12 col-lg-12">
                                <h3 class="multisteps-form__title text-center text-danger">أضافة الاصناف والكميات<i class="las la-cart-plus"></i></h3>
                                <hr>
                                <div class="multisteps-form__content">
                                    <div class="table-responsive">
                                        <table class="table primary-table-bordered table-bordered table-striped verticle-middle table-responsive-sm">
                                            <thead class="thead-light text-center">
                                            <tr>
                                                <th>#</th>
                                                <th>المنتج</th>
                                                <th>الوحدة</th>
                                                <th>اللون</th>
                                                <th>المقاس</th>
                                                <th>الكمية</th>
                                                <th>السعر</th>
                                                <th>نسبة الخصم</th>
                                                <th>قيمة الخصم</th>
                                                <th>نسبة الضرائب</th>
                                                <th>قيمة الضرائب</th>
                                                <th>صافي الاجمالي</th>
                                            </tr>
                                            </thead>
                                            <tbody class="text-center">
                                                @for($i=1; $item_count>=$i;$i++)
                                                    <tr>
                                                        <td>{{$i}}</td>
                                                        <td>
                                                            <select class="form-control"  wire:model="productId.{{$i}}">
                                                                <option value="0">اختار المنتج</option>
                                                                @forelse($products as $sup)
                                                                    <option value="{{$sup->id}}">{{$sup->product_name}}</option>
                                                                @empty
                                                                    <option>لم يتم انشاء موردين</option>
                                                                @endforelse
                                                            </select>
                                                            @error('productId.'.$i)
                                                            <small class="mt-5 mb-5 text-danger">{{ trans($message) }}</small>
                                                            @enderror
                                                        </td>
                                                        <td>
                                                            @if(!empty($productId[$i]))
                                                                <span style="display: none">{{$unitId = DB::table('products')->where('id', '=', $productId[$i])->value('unit')}}</span>
                                                                @foreach($units as $un)
                                                                    @if($unitId == $un->id)
                                                                        {{$un->name}}
                                                                    @endif
                                                                @endforeach
                                                            @else
                                                                <span class="text-dark">اختار المنتج</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <select class="form-control"  wire:model="productColor.{{$i}}">
                                                                <option value="0">اختار اللون</option>
                                                                @forelse($colors as $color)
                                                                    <option class="text-light" value="{{$color->id}}" style="background-color: {{$color->rgb}}">{{$color->name}} </option>
                                                                @empty
                                                                    <option>لم يتم انشاء الوان</option>
                                                                @endforelse
                                                            </select>
                                                            @error('productColor.'.$i)
                                                            <small class="mt-5 mb-5 text-danger">{{ trans($message) }}</small>
                                                            @enderror
                                                        </td>
                                                        <td>
                                                            <select class="form-control"  wire:model="productSize.{{$i}}" >
                                                                <option value="0">اختار المقاس</option>
                                                                @forelse($sizes as $size)
                                                                    <option value="{{$size->id}}" >{{$size->name}}</option>
                                                                @empty
                                                                    <option>لم يتم انشاء مقاسات</option>
                                                                @endforelse
                                                            </select>
                                                            @error('productSize.'.$i)
                                                            <small class="mt-5 mb-5 text-danger">{{ trans($message) }}</small>
                                                            @enderror
                                                        </td>
                                                        <td>
                                                            <div class="input-group">
                                                                <input class="form-control" type="number" min="1" max="100000" wire:model="quantity.{{$i}}">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text"><i class="las la-balance-scale-right"></i></span>
                                                                </div>
                                                            </div>
                                                            @error('quantity.'.$i)
                                                            <small class="mt-5 mb-5 text-danger">{{ trans($message) }}</small>
                                                            @enderror
                                                        </td>
                                                        <td>
                                                            <div class="input-group">
                                                                <input class="form-control" type="number" min="0.1" max="100000" wire:model="price.{{$i}}">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">EGP</span>
                                                                </div>
                                                            </div>
                                                            @error('price.'.$i)
                                                            <small class="mt-5 mb-5 text-danger">{{ trans($message) }}</small>
                                                            @enderror
                                                        </td>
                                                        <td>
                                                            <div class="input-group">
                                                                <input class="form-control" type="number" min="0.1" max="100"  wire:model="discVat.{{$i}}">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                            </div>
                                                            @error('discVat.'.$i)
                                                            <small class="mt-5 mb-5 text-danger">{{ trans($message) }}</small>
                                                            @enderror
                                                        </td>
                                                        <td>
                                                            @if(!empty($quantity[$i]) and !empty($price[$i]) and !empty($discVat[$i]))
                                                                <span class="text-danger">{{number_format(($quantity[$i]*$price[$i])*$discVat[$i]/100,2)}}</span>
                                                            @else
                                                                <span class="text-danger">{{number_format(0,2)}}</span>
                                                            @endif

                                                        </td>
                                                        <td>
                                                            <div class="input-group">
                                                                <input class="form-control" type="number" min="0.1" max="100"  wire:model="rateVat.{{$i}}">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                            </div>
                                                            @error('rateVat.'.$i)
                                                            <small class="mt-5 mb-5 text-danger">{{ trans($message) }}</small>
                                                            @enderror
                                                        </td>
                                                        <td>
                                                            @if(!empty($quantity[$i]) and !empty($price[$i]) and !empty($rateVat[$i]))
                                                                <span class="text-danger">{{number_format(($quantity[$i]*$price[$i])*$rateVat[$i]/100,2)}}</span>
                                                            @else
                                                                <span class="text-danger">{{number_format(0,2)}}</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if(!empty($total[$i]))
                                                                <span class="text-danger">{{number_format($total[$i],2) }}</span>
                                                            @else
                                                                <span class="text-danger">{{number_format(0,2)}}</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endfor
                                            </tbody>
                                            <tfoot>
                                                <tr class="text-center bg-light">
                                                    <td colspan=4" class="font-weight-bold text-danger">إجمالي عدد القطع بالفاتورة</td>
                                                    <td>{{$sumQuantity}}</td>
                                                    <td colspan="2" class="font-weight-bold text-danger">يفضل عدم تكرار المنتج مرتين</td>
                                                    <td colspan="2"><button class="btn btn-success ml-auto" wire:click="add()"><i class="la la-plus"></i></button></td>
                                                    <td colspan="2"><button class="btn btn-warning ml-auto" wire:click="empty()">مسح الكل</button></td>
                                                    <td colspan="2"><button class="btn btn-danger ml-auto" wire:click="deleteRow()"><i class="la la-trash"></i></button></td>
                                                </tr>
                                                <tr class="text-center">
                                                    <td colspan="8"></td>
                                                    <td colspan="2" class="font-weight-bold text-danger">صافي الاجمالي</td>
                                                    <td colspan="2" class="font-weight-bold text-danger">{{number_format($sumTotal,2) }}</td>
                                                </tr>
                                                <tr class="text-center">
                                                    <td colspan="8"></td>
                                                    <td colspan="2" class="font-weight-bold text-danger">نسبة خصم علي اجمالي الفاتورة</td>
                                                    <td colspan="1">
                                                        <div class="input-group">
                                                            <input class="form-control" type="number" min="0.1" max="100" wire:model="disVatInvoice">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">%</span>
                                                            </div>
                                                        </div>
                                                        @error('disVatInvoice')
                                                        <small class="mt-5 mb-5 text-danger">{{ trans($message) }}</small>
                                                        @enderror
                                                    </td>
                                                    <td colspan="1" class="font-weight-bold text-danger">{{number_format($sumTotal * $disVatInvoice/100,2) }}</td>
                                                </tr>
                                                <tr class="text-center">
                                                    <td colspan="8"></td>
                                                    <td colspan="2" class="font-weight-bold text-danger">نسبة الضريبة علي اجمالي الفاتورة</td>
                                                    <td colspan="1">
                                                        <div class="input-group">
                                                            <input class="form-control" type="number" min="0.1" max="100" wire:model="RateVatInvoice">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">%</span>
                                                            </div>
                                                        </div>
                                                        @error('RateVatInvoice')
                                                        <small class="mt-5 mb-5 text-danger">{{ trans($message) }}</small>
                                                        @enderror
                                                    </td>
                                                    <td colspan="2" class="font-weight-bold text-danger">{{number_format($sumTotal * $RateVatInvoice/100,2) }}</td>
                                                </tr>
                                                <tr class="text-danger text-center font-weight-bold">
                                                    <td colspan="1">ملاحظات</td>
                                                    <td colspan="7">
                                                        <textarea class="form-control" wire:model="note"></textarea>
                                                    </td>
                                                    <td colspan="2" class="bg-light">اجمالي الفاتورة</td>
                                                    <td colspan="2">{{number_format(($sumTotal)+($sumTotal * $RateVatInvoice/100)-($sumTotal * $disVatInvoice/100),2) }}</td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="text-center">
                                        @error('ErrorDuplicated')
                                        <p class="font-weight-bold  text-danger">{{ trans($message) }}</p>
                                        @enderror
                                    </div>
                                    <span class="text-primary">(*) ألزامي</span>
                                    <div class="button-row d-flex float-right clearfix">
                                        <button class="btn btn-danger mr-1 ml-1" wire:click="back(1)">{{__('Previous')}}</button>
                                        <button class="btn btn-primary mr-1 ml-1" wire:click="setp3()">{{__('Next')}}</button>
                                    </div>
                                    <div wire:loading wire:target="setp3" class="font-weight-bold font-xxl text-primary">
                                        <span> تحميل</span>
                                        <i class="fas fa-circle-notch fa-spin"></i>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

