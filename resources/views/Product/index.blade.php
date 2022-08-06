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
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th></th>
                                <th>اسم المنتج</th>
                                <th>رقم الموديل</th>
                                <th>القسم</th>
                                <th>سعر الشراء</th>
                                <th>سعر البيع</th>
                                <th>قيمة الربح</th>
                                <th>العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=0;?>
                            @foreach($products as $product)
                                <?php $i++?>
                                <tr>
                                    <td><strong>{{$i}}</strong></td>
                                    <td>
                                        <img class="" width="35"
                                             src="{{URL::asset('assets/images/avatar/1.png')}}"
                                             alt="User Image"></td></td>
                                    <td>{{$product->product_name}}</td>
                                    <td>{{$product->product_number}}</td>

                                    <td>{{$product->Productsection->name}}</td>
                                    <td>{{ number_format($product->purchasing_price, 2) }}</td>
                                    <td>{{ number_format($product->selling_price, 2) }}</td>
                                    <td class="text-success">{{ number_format($product->selling_price - $product->purchasing_price, 2) }}</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-primary" ><i class="la la-pencil"></i></a>
                                        <button  class="btn btn-sm btn-danger" data-toggle="modal" data-target=".SectionDelete" data-id="{{ $product->id }}"><i class="la la-trash-o"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Delete-->
    <div class="modal fade SectionDelete" id="SectionDelete">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">حذف القسم</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <form action="{{ route('productSection.destroy','test') }}" method="post">
                    {{ method_field('Delete') }}
                    @csrf
                    <input type="hidden" name="id" id="DeleteId" value="">
                    <div class="modal-body">

                        <p>هل تريد حذف القسم نهائيا؟ </p>
                        <p class="text-danger">ملحوظة : اذا كان هذا القسم مرتبط بعلاقات اخري لن يتم حذفه. </p>
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
