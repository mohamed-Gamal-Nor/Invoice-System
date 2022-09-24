@extends('layouts.master')
@section('title')
       قائمة الارصدة الافتتاحية
@endsection
@section('css')
    <!-- STYLESHEETS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/datatables/css/jquery.dataTables.min.css')}}">
@endsection

@section('content')
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>قائمة الارصدة الافتتاحية</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/' . $page='dashboard') }}">لوحة التحكم</a></li>
                <li class="breadcrumb-item active"><a href="{{url('/'.$page='productStore')}}">الارصدة الافتتاحية</a></li>
                <li class="breadcrumb-item active"><a href="{{url('/'.$page='productStore/create')}}">قائمة الارصدة الافتتاحية</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">قائمة الارصدة الافتتاحية</h4>
                    <a href="{{url('/'.$page='productStore/create')}}" class="btn btn-primary"><i class="las la-plus"></i> أضافة رصيد</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>المنتج</th>
                                <th>المقاس</th>
                                <th>اللون</th>
                                <th>درجة اللون</th>
                                <th>المخزن</th>
                                <th>الكمية</th>
                                <th>تاريخ الانشاء</th>
                                <th>اخر تاريخ تعديل</th>
                                <th>العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=0;?>
                            @foreach($StartBalance as $balance)
                                <?php $i++ ?>
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$balance->products->product_name}}</td>
                                    <td>{{$balance->sizes->name}}</td>
                                    <td>{{$balance->colors->name}}</td>
                                    <td> <span class="badge badge-xl badge-warning" style="background-color: {{$balance->colors->rgb}}">*</span></td>
                                    <td>{{$balance->stores->name}}</td>
                                    <td class="text-danger">{{$balance->qty}}</td>
                                    <td>{{$balance->created_at}}</td>
                                    <td>
                                        @if(empty($balance->updated_at))
                                            <span class="text-primary">لم يتم التعديل ع هذا الرصيد</span>
                                        @else
                                            {{$balance->updated_at->todatestring() }}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route('productStore.edit',$balance->id)}}" class="btn btn-sm btn-primary"><i class="la la-pencil"></i></a>
                                        <button  class="btn btn-sm btn-danger" data-toggle="modal" data-target=".SectionDelete"
                                                 data-id="{{ $balance->id }}"
                                                 data-size="{{ $balance->size}}"
                                                 data-color="{{ $balance->color}}"
                                                 data-store="{{ $balance->store}}"
                                                 data-product="{{ $balance->product}}"
                                        ><i class="la la-trash-o"></i></button>
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
                    <h5 class="modal-title">حذف المندوب</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <form action="{{ route('productStore.destroy','test') }}" method="post">
                    {{ method_field('Delete') }}
                    @csrf
                    <input type="hidden" name="id" id="DeleteId" value="">
                    <input type="hidden" name="size" id="size" value="">
                    <input type="hidden" name="color" id="color" value="">
                    <input type="hidden" name="store" id="store" value="">
                    <input type="hidden" name="product" id="product" value="">
                    <div class="modal-body">

                        <p>هل تريد حذف الرصيد نهائيا؟ </p>
                        <p class="text-danger">ملحوظة : اذا كان هذا المورد مرتبط بعلاقات اخري لن يتم حذفه. </p>
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
            var size = button.data('size')
            var color = button.data('color')
            var store = button.data('store')
            var product = button.data('product')
            var modal = $(this)
            modal.find('#DeleteId').val(id);
            modal.find('#size').val(size);
            modal.find('#color').val(color);
            modal.find('#store').val(store);
            modal.find('#product').val(product);
        })
    </script>

@endsection
