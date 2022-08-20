@extends('layouts.master')
@section('title')
    قائمة العملاء
@endsection
@section('css')
    <!-- STYLESHEETS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/datatables/css/jquery.dataTables.min.css')}}">
@endsection

@section('content')
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>قائمة العملاء</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/' . $page='dashboard') }}">لوحة التحكم</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0);"> العملاء</a></li>
                <li class="breadcrumb-item active"><a href="{{url('/'.$page='customer')}}">قائمة العملاء</a></li>
            </ol>
        </div>
    </div>
    <div class="row">

        <div class="col-lg-12">
            <div class="row tab-content">
                <div id="list-view" class="tab-pane fade active show col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">قائمة العملاء</h4>
                            <a href="{{url('/'.$page='customer/create')}}" class="btn btn-primary"><i class="las la-plus"></i> أضافة عميل</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example3" class="display" style="min-width: 845px">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>اسم العميل</th>
                                        <th>رقم الهاتف اول</th>
                                        <th>رقم الهاتف ثان</th>
                                        <th>البريد الاليكتروني</th>
                                        <th>أنشا بواسطة</th>
                                        <th>تاريخ الانشاء</th>
                                        <th>اخر تاريخ تعديل</th>
                                        <th>العمليات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i=0;?>
                                    @foreach($customer as $custom)
                                        <?php $i++?>
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{$custom->name}}</td>
                                            <td><a href="tel:{{$custom->phone_one}}"><strong>{{$custom->phone_one}}</strong></a></td>
                                            <td>
                                                @if(!empty($custom->phone_two))
                                                    <a href="tel:{{$custom->phone_two}}"><strong>{{$custom->phone_two}}</strong></a>
                                                @else
                                                    <span class="text-danger">لا يوجد رقم هاتف ثان</span>
                                                @endif

                                            </td>
                                            <td><a href="mail:{{$custom->email}}">{{$custom->email}}</a></td>
                                            <td><strong>{{$custom->user->name}}</strong></td>
                                            <td>{{$custom->created_at->todatestring() }}</td>
                                            <td class="text-primary">
                                                @if(!empty($custom->updated_at))
                                                    {{$custom->updated_at->todatestring() }}
                                                @else
                                                    لم يتم تعديل هذا المورد
                                                @endif

                                            </td>
                                            <td>
                                                <a href="{{route('customer.edit',$custom->id)}}" class="btn btn-sm btn-primary"><i class="la la-pencil"></i></a>
                                                <a  href="{{ route('customer.show', $custom->id) }}"  class="btn btn-sm btn-success" ><i class="la la-eye"></i></a>
                                                <button  class="btn btn-sm btn-danger" data-toggle="modal" data-target=".SectionDelete" data-id="{{ $custom->id }}"><i class="la la-trash-o"></i></button>
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
                    <h5 class="modal-title">حذف العميل</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <form action="{{ route('customer.destroy','test') }}" method="post">
                    {{ method_field('Delete') }}
                    @csrf
                    <input type="hidden" name="id" id="DeleteId" value="">
                    <div class="modal-body">

                        <p>هل تريد حذف العميل نهائيا؟ </p>
                        <p class="text-danger">ملحوظة : اذا كان هذا العميل مرتبط بعلاقات اخري لن يتم حذفه. </p>
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
