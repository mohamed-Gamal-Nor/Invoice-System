@extends('layouts.master')
@section('title')
    أضافة الارصدة الافتتاحية
@endsection
@section('css')

@endsection

@section('content')
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>أضافة الارصدة الافتتاحية</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/' . $page='dashboard') }}">لوحة التحكم</a></li>
                <li class="breadcrumb-item active"><a href="{{url('/'.$page='productStore')}}">الارصدة الافتتاحية</a></li>
                <li class="breadcrumb-item active"><a href="{{url('/'.$page='productStore/create')}}">أضافة الارصدة الافتتاحية</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-xxl-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">أضافة الارصدة الافتتاحية</h5>
                    @if(!empty(session()->get('data')))
                        <h5 class="card-title text-danger">يوجد اصناف تم ادخالها من قبل</h5>
                    @endif
                </div>
                <div class="card-body">
                    <form action="{{ route('productStore.store') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">اختار المنتج</label>
                                    <select class="form-control" id="sel2" name="product" required>
                                        <option>اختار المنتج</option>
                                        @foreach($product as $pro)
                                            <option value="{{$pro->id}}">{{$pro->product_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('product')
                                    <span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">المخزن</label>
                                    <select class="form-control" id="sel2" name="store" required>
                                        <option>اختار المخزن</option>
                                        @foreach($storage as $store)
                                            <option value="{{$store->id}}">{{$store->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('store')
                                    <span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="table-responsive col-lg-12 col-md-12 col-sm-12">
                                <table class="table table-bordered table-responsive-sm">
                                    <thead>
                                    <tr>
                                        <th>المقاس</th>
                                        <th>اللون</th>
                                        <th>الرصيد</th>
                                        <th>عمليات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty(session()->get('data')))
                                        @foreach(session()->get('data') as $err)
                                            @foreach($err as $key=>$value)
                                                <tr class="bg-warning">
                                                    <td >
                                                        <select class="form-control form-control-sm" name="size[]" required>
                                                            <option>المقاس</option>
                                                            @foreach($size as $si)
                                                                <option value="{{$si->id}}" @if($value['size'] == $si->id) selected @endif>{{$si->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select class="form-control form-control-sm" name="color[]" required>
                                                            <option>اللون</option>
                                                            @foreach($colors as $color)
                                                                <option value="{{$color->id}}" @if($value['color'] == $color->id) selected @endif>{{$color->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control" name="balance[]" required min="0" value="{{ $value['balance'] }}">
                                                    </td>
                                                    <td class="text-center">
                                                       <a class="btn btn-danger remove">{{__('Delete')}}</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    @else
                                        <tr>
                                            <td>
                                                <select class="form-control form-control-sm" name="size[]" required>
                                                    <option>المقاس</option>
                                                    @foreach($size as $si)
                                                        <option value="{{$si->id}}">{{$si->name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control form-control-sm" name="color[]" required>
                                                    <option>اللون</option>
                                                    @foreach($colors as $color)
                                                        <option value="{{$color->id}}">{{$color->name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control" name="balance[]" required min="0">
                                            </td>
                                            <td class="text-center">
                                            </td>
                                        </tr>
                                    @endif
                                    </tbody>
                                    <tfoot>
                                    <td class="text-center" colspan="4">
                                        <a id="add" class="btn btn-primary">{{__('Add')}}</a>
                                    </td>

                                    </tfoot>
                                </table>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <button type="submit" class="btn btn-primary">{{__('Save')}}</button>
                                <a href="{{url('/'.$page='productStore')}}" class="btn btn-light">{{__('Cancel')}}</a>
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
                '<td> <select class="form-control" name="size[]" required><option>المقاس</option> @foreach($size as $si)<option value="{{$si->id}}">{{$si->name}}</option>@endforeach</select></td>'+
                '<td> <select class="form-control" name="color[]" required><option>اللون</option> @foreach($colors as $color)<option value="{{$color->id}}">{{$color->name}}</option>@endforeach</select></td>'+
                '<td> <input type="number" class="form-control" name="balance[]" min="0" required> </td>'+
                '<td class="text-center"> <a class="btn btn-danger remove">{{__('Delete')}}</a> </td>'+
                '</tr>';
            $("tbody").append(tr);
        }
    </script>
@endsection
