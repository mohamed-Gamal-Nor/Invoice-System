<div class="card-header">
    <h4 class="card-title">أضافة فاتورة</h4>
    <button  class="btn btn-primary" wire:click="invoiceListForm"><i class="las la-list"></i> قائمة فواتير المشتريات</button>
</div>
<div class="card-body">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="form-group">
                <label class="form-label">المورد *</label>
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
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="form-group">
                <label class="form-label">المخزن *</label>
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
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="form-group">
                <label class="form-label">التاريخ *</label>
                <input type="text" class="form-control" disabled value="{{date('d-m-Y')}}">
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-12">
            <div class="form-group">
                <label class="form-label">المنتج *</label>
                <select id="inputState" class="form-control" wire:model="productId">
                    <option value="">أختار المنتج</option>
                    @forelse($product as $pro)
                        <option value="{{$pro->id}}">{{$pro->product_name}}</option>
                    @empty
                        <option>لم يتم انشاء منتجات</option>
                    @endforelse
                </select>
                @error('productId')
                <small class="mt-5 mb-5 text-danger">{{ trans($message) }}</small>
                @enderror
            </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-12">
            <div class="form-group">
                <label class="form-label">الكمية *</label>
                <input type="number" class="form-control" min="1" wire:model="quantity">
                @error('quantity')
                <small class="mt-5 mb-5 text-danger">{{ trans($message) }}</small>
                @enderror
            </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-12">
            <div class="form-group">
                <label class="form-label">السعر *</label>
                <input type="number" class="form-control" min="1" wire:model="price">
                @error('price')
                <small class="mt-5 mb-5 text-danger">{{ trans($message) }}</small>
                @enderror
            </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-12">
            <div class="form-group">
                <label class="form-label">اللون *</label>
                <select id="inputState" class="form-control" wire:model="productColor">
                    <option value="">أختار اللون</option>
                    @forelse($color as $col)
                        <option value="{{$col->id}}">{{$col->name}}</option>
                    @empty
                        <option>لم يتم انشاء الوان</option>
                    @endforelse
                </select>
                @error('color')
                <small class="mt-5 mb-5 text-danger">{{ trans($message) }}</small>
                @enderror
            </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-12">
            <div class="form-group">
                <label class="form-label">المقاس *</label>
                <select id="inputState" class="form-control" wire:model="productSize">
                    <option value="">أختار ألمقاس</option>
                    @forelse($size as $si)
                        <option value="{{$si->id}}">{{$si->name}}</option>
                    @empty
                        <option>لم يتم انشاء مقاسات</option>
                    @endforelse
                </select>
                @error('size')
                <small class="mt-5 mb-5 text-danger">{{ trans($message) }}</small>
                @enderror
            </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-12">
            <div class="form-group">
                <label class="form-label">وحدة القياس *</label>
                <input type="text" class="form-control bg-green " disabled value="{{$unit}}">
            </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-12">
            <div class="form-group">
                <label class="form-label">نسبة الخصم</label>
                <input type="text" class="form-control" disabled value="{{date('d-m-Y')}}">
            </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-12">
            <div class="form-group">
                <label class="form-label">قيمة الخصم</label>
                <input type="text" class="form-control" disabled value="{{date('d-m-Y')}}">
            </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-12">
            <div class="form-group">
                <label class="form-label">نسبة الضريبة</label>
                <input type="text" class="form-control" disabled value="{{date('d-m-Y')}}">
            </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-12">
            <div class="form-group">
                <label class="form-label">قيمة الضريبة</label>
                <input type="text" class="form-control" disabled value="{{date('d-m-Y')}}">
            </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-12">
            <div class="form-group">
                <label class="form-label">صافي الاجمالي</label>
                <input type="text" class="form-control" disabled value="{{date('d-m-Y')}}">
            </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-12">
            <div class="form-group text-center">
                <label class="form-label d-block">أضافة الصنف</label>
                <button type="button" class="btn btn-info">أضافة الصنف <span class="btn-icon-right"><i class="fa fa-plus"></i></span>
                </button>
            </div>
        </div>
    </div>
</div>
