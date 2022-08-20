@extends('layouts.master')
@section('title')
    تعديل مندوب شحن / ({{$shipping->name}})
@endsection
@section('css')

@endsection

@section('content')
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>أضافة مندوب شحن</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/' . $page='dashboard') }}">لوحة التحكم</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0);">الشحن</a></li>
                <li class="breadcrumb-item active"><a href="{{url('/'.$page='product/create')}}">تعديل مندوب شحن</a></li>
            </ol>
        </div>
    </div>
    @if ($errors->any())
        <div class="card">
            <div class="card-body">
                <div class="alert alert-light alert-dismissible alert-alt fade show">
                    <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                    </button>
                    @foreach ($errors->all() as $error)
                        <div><strong>Error!</strong> {{ $error }}</div>

                    @endforeach

                </div>
            </div>
        </div>

    @endif
    <div class="row">
        <div class="col-xl-12 col-xxl-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">تعديل مندوب شحن / ({{$shipping->name}})</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('shipping.update','test') }}" enctype="multipart/form-data" method="POST">
                        {{ method_field('patch') }}
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">أسم المندوب / شركة الشحن</label>
                                    <input type="text" class="form-control" name="name" value="{{$shipping->name}}" required>
                                    <input type="hidden" class="form-control" name="id" value="{{$shipping->id}}">
                                    @error('name')
                                    <span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">رقم الهاتف</label>
                                    <input type="tel" class="form-control" name="phone" value="{{$shipping->phone}}" required>
                                    @error('phone')
                                    <span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">ملاحظات</label>
                                    <textarea class="form-control" rows="4" name="description">{{$shipping->description}}</textarea>
                                    @error('description')
                                    <span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="table-responsive col-lg-12 col-md-12 col-sm-12">
                                <table class="table table-bordered table-responsive-sm">
                                    <thead>
                                    <tr>
                                        <th>مناطق الشحن</th>
                                        <th>سعر الشحن</th>
                                        <th>عمليات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($shipping->shippingArea as $key => $item)
                                        <tr>
                                            <td>
                                                <select class="form-control" id="sel2" name="area[]" required>
                                                    <option>اختار منطقة الشحن</option>
                                                    @foreach($shippingArea as $area)
                                                        <option
                                                            value="{{$area->id}}"
                                                            @if ($area->id == old('area', $item->area))
                                                            selected="selected"
                                                            @endif
                                                        >{{$area->name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control" placeholder="سعر الشحن" name="price[]" required value="{{$item->price}}">
                                                <input type="hidden" class="form-control"  name="item_id[]" required value="{{$item->id}}">
                                            </td>
                                            <td class="text-center">
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <td class="text-center" colspan="4">
                                        <a id="add" class="btn btn-primary">{{__('Add')}}</a>
                                    </td>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <button type="submit" class="btn btn-primary">{{__('Update')}}</button>
                                <a href="{{url('/'.$page='shipping')}}" class="btn btn-light">{{__('Cancel')}}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('body').on('click','.remove',function(e){
            e.preventDefault();
            var last = $("tbody tr").length;
            if(last == 1){

            }else{
                $(this).parent().parent().remove();
            }
        });
        $('#add').on('click',function(e){
            e.preventDefault();
            addRow();
        });
        function addRow(){
            var tr = '<tr>' +
                '<td> <select class="form-control" id="sel2" name="area[]" required><option>اختار منطقة الشحن</option> @foreach($shippingArea as $area)<option value="{{$area->id}}">{{$area->name}}</option>@endforeach</select></td>'+
                '<td> <input type="number" class="form-control" placeholder="سعر الشحن" name="price[]" required><input class="form-control" name="item_id[]" type="text" readonly="readonly" hidden></td>'+
                '<td class="text-center"> <a class="btn btn-danger remove">{{__('Delete')}}</a> </td>'+
                '</tr>';
            $("tbody").append(tr);
        }
    </script>
@endsection
