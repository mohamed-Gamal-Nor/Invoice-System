@extends('layouts.master')
@section('title')
    قائمة مناديب الشحن
@endsection
@section('css')
    <!-- STYLESHEETS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/datatables/css/jquery.dataTables.min.css')}}">
@endsection

@section('content')
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>قائمة مناديب الشحن</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/' . $page='dashboard') }}">لوحة التحكم</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0);"> الشحن</a></li>
                <li class="breadcrumb-item active"><a href="{{url('/'.$page='shipping')}}">قائمة مناديب الشحن</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">قائمة مناديب الشحن</h4>
                    <a href="{{url('/'.$page='shipping/create')}}"  class="btn btn-primary" ><i class="las la-plus"></i> أضافة مندوب / شركة الشحن</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم المندوب / شركة الشحن</th>
                                <th>رقم الهاتف</th>
                                <th>ملاحظات</th>
                                <th>عدد الاوردرات المسلمة</th>
                                <th>عدد الاوردرات المرتجع</th>
                                <th>عدد المناطق</th>
                                <th>أنشا بواسطة</th>
                                <th>تاريخ الانشاء</th>
                                <th>اخر تاريخ تعديل</th>
                                <th>العمليات</th>
                            </tr>
                            </thead>
                            <tbody class="text-center">
                            <?php $i=0;?>
                            @foreach($shipping as $ship)
                                <?php $i++?>
                                <tr>
                                    <td><strong>{{$i}}</strong></td>
                                    <td>{{$ship->name}}</td>
                                    <td>{{$ship->phone}}</td>
                                    <td>

                                        @if(empty($ship->description))
                                            <span class="text-primary">لا يوجد ملاحظات لعرضها</span>
                                        @else
                                            {{$ship->description}}
                                        @endif
                                    </td>
                                    <td>0.00</td>
                                    <td>0.00</td>
                                    <td>{{$ship->shippingArea->count()}}</td>
                                    <td>{{$ship->user->name}}</td>
                                    <td >{{$ship->created_at->todatestring() }}</td>
                                    <td>
                                        @if(empty($ship->updated_at))
                                            <span class="text-primary">لم يتم التعديل ع هذا القسم</span>
                                        @else
                                            {{$ship->updated_at->todatestring() }}
                                        @endif

                                    </td>
                                    <td>
                                        <a  href="{{ route('shipping.edit', $ship->id) }}"  class="btn btn-sm btn-primary" ><i class="la la-pencil"></i></a>

                                        <button  class="btn btn-sm btn-danger" data-toggle="modal" data-target=".SectionDelete" data-id="{{ $ship->id }}"><i class="la la-trash-o"></i></button>
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

    <!--Model Edit-->
    <div class="modal fade product-section-edit" tabindex="-1" role="dialog" aria-hidden="true" id="product-section-edit">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تعديل مندوب / شركة شحن</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <form action="{{route('shipping.update','test')}}" method='post'>
                    {{ method_field('patch') }}
                    {{ csrf_field() }}
                    <div class="modal-body">

                        <div class="form-group">
                            <label>أسم المندوب</label>
                            <input type="hidden" id="id" name="id">
                            <input type="text" class="form-control input-default" name="name" id="name" >
                        </div>
                        <div class="form-group">
                            <label>رقم الهاتف</label>
                            <input type="phone" class="form-control input-default" name="phone" id="phone" >
                        </div>
                        <div class="form-group">
                            <label>ملاحظات</label>
                            <textarea class="form-control" rows="4"  id="description" name="description"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('Update')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--Model Edit-->
    <!-- Modal Delete-->
    <div class="modal fade SectionDelete" id="SectionDelete">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">حذف المندوب</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <form action="{{ route('shipping.destroy','test') }}" method="post">
                    {{ method_field('Delete') }}
                    @csrf
                    <input type="hidden" name="id" id="DeleteId" value="">
                    <div class="modal-body">

                        <p>هل تريد حذف المدوب نهائيا؟ </p>
                        <p class="text-danger">ملحوظة : اذا كان هذا المندوب مرتبط بعلاقات اخري لن يتم حذفه. </p>
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
        $('#product-section-edit').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var Shipping_name = button.data('shipping_name')
            var Shipping_phone = button.data('shipping_phone')
            var description = button.data('description')
            var modal = $(this)
            modal.find('#id').val(id);
            modal.find('#name').val(Shipping_name);
            modal.find('#phone').val(Shipping_phone);
            modal.find('#description').val(description);
        })
    </script>
    <script>
        $('#SectionDelete').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var modal = $(this)
            modal.find('#DeleteId').val(id);
        })
    </script>
@endsection
