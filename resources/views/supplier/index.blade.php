@extends('layouts.master')
@section('title')
    قائمة الموردين
@endsection
@section('css')
    <!-- STYLESHEETS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/datatables/css/jquery.dataTables.min.css')}}">
@endsection

@section('content')
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>قائمة الموردين</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/' . $page='dashboard') }}">لوحة التحكم</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0);"> الموردين</a></li>
                <li class="breadcrumb-item active"><a href="{{url('/'.$page='supplier')}}">قائمة الموردين</a></li>
            </ol>
        </div>
    </div>
    <div class="row">

        <div class="col-lg-12">
            <div class="row tab-content">
                <div id="list-view" class="tab-pane fade active show col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">قائمة الموردين</h4>
                            <a href="{{url('/'.$page='supplier/create')}}" class="btn btn-primary"><i class="las la-plus"></i> أضافة مورد</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example3" class="display" style="min-width: 845px">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>اسم المورد</th>
                                        <th>رقم الهاتف</th>
                                        <th>العنوان</th>
                                        <th>رصيد البداية</th>
                                        <th>الحالة</th>
                                        <th>أنشا بواسطة</th>
                                        <th>تاريخ الانشاء</th>
                                        <th>اخر تاريخ تعديل</th>
                                        <th>العمليات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i=0;?>
                                    @foreach($supplier as $supp)
                                        <?php $i++?>
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{$supp->name}}</td>
                                            <td><a href="tel:{{$supp->phone}}"><strong>{{$supp->phone}}</strong></a></td>
                                            <td>{{$supp->address}}</td>
                                            <td class="text-success">{{number_format($supp->start_balance,2)}}</td>
                                            <td>
                                                @if(!empty($supp->status))
                                                    <span class="badge badge-success">غير موقوف</span>
                                                @else
                                                    <span class="badge badge-danger"> موقوف</span>
                                                @endif
                                            </td>
                                            <td><strong>{{$supp->user->name}}</strong></td>
                                            <td>{{$supp->created_at->todatestring() }}</td>
                                            <td class="text-primary">
                                                @if(!empty($supp->updated_at))
                                                    {{$supp->updated_at->todatestring() }}
                                                @else
                                                    لم يتم تعديل هذا المورد
                                                @endif

                                            </td>
                                            <td>
                                                <a href="{{route('supplier.edit',$supp->id)}}" class="btn btn-sm btn-primary"><i class="la la-pencil"></i></a>
                                                <button  class="btn btn-sm btn-danger" data-toggle="modal" data-target=".SectionDelete" data-id="{{ $supp->id }}"><i class="la la-trash-o"></i></button>
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
                <form action="{{ route('supplier.destroy','test') }}" method="post">
                    {{ method_field('Delete') }}
                    @csrf
                    <input type="hidden" name="id" id="DeleteId" value="">
                    <div class="modal-body">

                        <p>هل تريد حذف المورد نهائيا؟ </p>
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
            var modal = $(this)
            modal.find('#DeleteId').val(id);
        })
    </script>
@endsection
