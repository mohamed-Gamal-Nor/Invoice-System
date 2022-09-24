<div class="row">
    <div class="col-xl-12 col-xxl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">أضافة فاتورة</h4>
                <button  class="btn btn-primary" wire:click="invoiceListForm"><i class="las la-list"></i> قائمة فواتير المشتريات</button>
            </div>
            <div class="card-body">
                <div class="multisteps-form">
                    <!--progress bar-->
                    <div class="row">
                        <div class="col-12 col-lg-12 ml-auto mr-auto mb-5">
                            <div class="multisteps-form__progress">
                                <button class="multisteps-form__progress-btn @if($current_step === 1 || $current_step === 2 || $current_step === 3) js-active @endif" wire:click="setp1()">بيانات فاتورة المشتريات</button>
                                <button class="multisteps-form__progress-btn @if($current_step === 2|| $current_step === 3 ) js-active @endif" wire:click="setp2()">أضافة الاصناف والكميات</button>
                                <button class="multisteps-form__progress-btn @if($current_step === 3) js-active @endif" wire:click="setp3()">مراجعة وطباعة</button>
                            </div>
                        </div>
                    </div>
                    <!--form panels-->
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
                                        <div class="button-row d-flex mt-4">
                                            <span class="text-primary">(*) ألزامي</span>
                                            <button class="btn btn-primary ml-auto js-btn-next" wire:click="setp2()">{{__('Next')}}</button>

                                        </div>
                                        <span wire:loading wire:target="setp2" class="font-weight-bold font-xxl text-primary"> <i class="fa fa-spinner"></i>تحميل</span>
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
                                            <thead class="thead-light">
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
                                                                <option value="">اختار المنتج</option>
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
                                                                <span class="text-dark">لم يتم اختيار المنتج</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <select class="form-control"  wire:model="productColor.{{$i}}">
                                                                <option value="">اختار اللون</option>
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
                                                            <select class="form-control"  wire:model="productSize.{{$i}}">
                                                                <option value="">اختار المقاس</option>
                                                                @forelse($sizes as $size)
                                                                    <option value="{{$size->id}}">{{$size->name}}</option>
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
                                                        <td>1</td>
                                                    </tr>
                                                @endfor
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="button-row d-flex mt-4">
                                        <span class="text-primary">(*) ألزامي</span>
                                        <button class="btn btn-primary ml-auto js-btn-next" wire:click="setp3()">{{__('Next')}}</button>
                                    </div>
                                    <span wire:loading wire:target="setp3" class="font-weight-bold font-xxl text-primary"> <i class="fa fa-spinner"></i>تحميل</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

