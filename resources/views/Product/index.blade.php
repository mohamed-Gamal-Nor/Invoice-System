@extends('layouts.master')
@section('title')
    قائمة المنتجات
@endsection
@section('css')
    <!-- STYLESHEETS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/datatables/css/jquery.dataTables.min.css')}}">
@endsection

@section('content')
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>قائمة المنتجات</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/' . $page='dashboard') }}">لوحة التحكم</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0);"> الاقسام & المنتجات</a></li>
                <li class="breadcrumb-item active"><a href="{{url('/'.$page='product')}}">قائمة المنتجات</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">قائمة المنتجات</h4>
                    <a href="{{url('/'.$page='product/create')}}" class="btn btn-primary"><i class="las la-plus"></i> أضافة منتج</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach($products as $product)
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row m-b-30">
                            <div class="col-md-4">
                                <div class="new-arrival-product mb-3">
                                    <div class="new-arrivals-img-contnent">
                                        <img class="img-fluid"
                                             @if(empty($product->product_image))
                                                src="{{URL::asset('assets/images/product/imageUpload.png')}}"
                                             @else
                                                src="{{URL::asset('storage/product_image/'.$product->id .'/'. $product->product_image)}}"
                                             @endif
                                             alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="new-arrival-content position-relative">
                                    <h4>{{$product->product_name}}</h4>
                                    <p class="price">{{ number_format($product->selling_price, 2) }} EGP</p>
                                    <p>Model number: <span class="item"> {{$product->product_number}} <i class="fa fa-check-circle text-success"></i></span></p>
                                    <p>Purchasing price: <span class="item">{{ number_format($product->purchasing_price, 2) }} EGP <i class="fa fa-check-circle text-success"></i></span></p>
                                    <p>profit value: <span class="item">{{ number_format($product->selling_price - $product->purchasing_price, 2) }} EGP <i class="fa fa-check-circle text-success"></i></span></p>
                                    <p>Created By: <span class="item">{{ $product->user->name}} <i class="fa fa-check-circle text-success"></i></span></p>
                                    <p>Created At: <span class="item">{{ $product->created_at->todatestring()}} <i class="fa fa-check-circle text-success"></i></span></p>
                                    <p>Last Update: <span class="item">
                                            @if(!empty($product->updated_at))
                                                {{ $product->updated_at->todatestring()}}
                                            @else
                                                لم يتم تعديل هذا المنتج
                                            @endif

                                            <i class="fa fa-check-circle text-success"></i></span></p>
                                    <p class="text-content text-center">
                                        @if(empty($product->description))
                                            لا توجد ملاحظات علي هذا المنتج
                                        @else
                                            {{$product->description}}
                                        @endif

                                    </p>
                                    <p class="text-content text-center">
                                        <a href="{{ route('product.edit', $product->id) }}" class="btn btn-primary" ><i class="la la-pencil"></i> تعديل المنتج</a>
                                        <button  class="btn btn-danger" data-toggle="modal" data-target=".SectionDelete" data-id="{{ $product->id }}"><i class="la la-trash"></i> حذف المنتج </button>
                                    </p>
                                    <div class="comment-review star-rating text-right">
                                        <p> القسم: <span class="item">{{$product->Productsection->name}}</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- Modal Delete-->
    <div class="modal fade SectionDelete" id="SectionDelete">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">حذف المنتج</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <form action="{{ route('product.destroy','test') }}" method="post">
                    {{ method_field('Delete') }}
                    @csrf
                    <input type="hidden" name="id" id="DeleteId" value="">
                    <div class="modal-body">

                        <p>هل تريد حذف المنتج نهائيا؟ </p>
                        <p class="text-danger">ملحوظة : اذا كان هذا المنتج مرتبط بعلاقات اخري لن يتم حذفه. </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">الغاء</button>
                        <button type="submit"  class="btn btn-danger">تاكيد الحذف</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <!-- Datatable -->
    <script type="text/javascript" src="{{ URL::asset('assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/js/plugins-init/datatables.init.js') }}"></script>
    <script>
        $('#SectionDelete').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var modal = $(this)
            modal.find('#DeleteId').val(id);
        })
    </script>
@endsection
