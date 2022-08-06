@extends('layouts.master')
@section('title')
    قائمة الاقسام
@endsection
@section('css')
    <!-- STYLESHEETS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/datatables/css/jquery.dataTables.min.css')}}">
@endsection

@section('content')
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>قائمة الاقسام</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/' . $page='dashboard') }}">لوحة التحكم</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0);"> الاقسام & المنتجات</a></li>
                <li class="breadcrumb-item active"><a href="{{url('/'.$page='productSection')}}">قائمة الاقسام</a></li>
            </ol>
        </div>
    </div>
    @if ($errors->any())
    <div class="alert alert-danger left-icon-big alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
        </button>
        <div class="media">
            <div class="alert-left-icon-big">
                <span><i class="mdi mdi-alert"></i></span>
            </div>
            <div class="media-body">
                <h5 class="mt-1 mb-1">رسالة خطأ</h5>
                @foreach ($errors->all() as $error)
                    <p class="text-white">{{ $error }}</p>
                @endforeach

            </div>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">قائمة الاقسام</h4>
                    <button  class="btn btn-primary" data-toggle="modal" data-target=".product-section"><i class="las la-plus"></i> أضافة قسم</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم القسم</th>
                                <th>ملاحظات</th>
                                <th>أنشا بواسطة</th>
                                <th>تاريخ الانشاء</th>
                                <th>اخر تاريخ تعديل</th>
                                <th>العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=0;?>
                            @foreach($ProductSection as $section)
                                <?php $i++?>
                                <tr>
                                    <td><strong>{{$i}}</strong></td>
                                    <td>{{$section->name}}</td>
                                    <td>

                                        @if(empty($section->description))
                                            <span class="text-primary">لا يوجد ملاحظات لعرضها</span>
                                        @else
                                            {{$section->description}}
                                        @endif
                                    </td>
                                    <td>{{$section->user->name}}</td>
                                    <td>{{$section->created_at->todatestring() }}</td>
                                    <td>
                                        @if(empty($section->updated_at))
                                            <span class="text-primary">لم يتم التعديل ع هذا القسم</span>
                                        @else
                                            {{$section->updated_at->todatestring() }}
                                        @endif

                                    </td>
                                    <td>
                                        <button  class="btn btn-sm btn-primary" data-toggle="modal" data-target=".product-section-edit"  data-id="{{ $section->id }}" data-section_name="{{ $section->name }}" data-description="{{ $section->description}}" ><i class="la la-pencil"></i></button>
                                        <button  class="btn btn-sm btn-danger" data-toggle="modal" data-target=".SectionDelete" data-id="{{ $section->id }}"><i class="la la-trash-o"></i></button>
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
    <!--Model Create-->
    <div class="modal fade product-section" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">أضافة قسم جديد</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <form action="{{route('productSection.store')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>أسم القسم</label>
                            <input type="text" class="form-control input-default" name="name">
                        </div>
                        <div class="form-group">
                            <label>ملاحظات</label>
                            <textarea class="form-control" rows="4" id="comment" name="description"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('Save')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--Model Create-->
    <!--Model Edit-->
    <div class="modal fade product-section-edit" tabindex="-1" role="dialog" aria-hidden="true" id="product-section-edit">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تعديل قسم</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <form action="{{route('productSection.update','test')}}" method='post'>
                    {{ method_field('patch') }}
                    {{ csrf_field() }}
                    <div class="modal-body">

                        <div class="form-group">
                            <label>أسم القسم</label>
                            <input type="hidden" id="id" name="id">
                            <input type="text" class="form-control input-default" name="name" id="section_name" >
                        </div>
                        <div class="form-group">
                            <label>ملاحظات</label>
                            <textarea class="form-control" rows="4"  id="description" name="description"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('Save')}}</button>
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
        $('#product-section-edit').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var section_name = button.data('section_name')
            var description = button.data('description')
            var modal = $(this)
            modal.find('#id').val(id);
            modal.find('#section_name').val(section_name);
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
