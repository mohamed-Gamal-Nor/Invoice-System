@extends('layouts.master')
@section('title')
    تعديل منتج / ({{$product->product_name}})
@endsection
@section('css')
    <style>
        .avatar-upload {
            position: relative;
            max-width: 205px;
            margin: 50px auto;
        }
        .avatar-upload .avatar-edit {
            position: absolute;
            right: 12px;
            z-index: 1;
            top: 10px;
        }
        .avatar-upload .avatar-edit input {
            display: none;
        }
        .avatar-upload .avatar-edit input + label {
            display: inline-block;
            width: 34px;
            height: 34px;
            margin-bottom: 0;
            border-radius: 100%;
            background: #ffffff;
            border: 1px solid transparent;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
            cursor: pointer;
            font-weight: normal;
            transition: all 0.2s ease-in-out;
        }
        .avatar-upload .avatar-edit input + label:hover {
            background: #f1f1f1;
            border-color: #d6d6d6;
        }
        .avatar-upload .avatar-edit input + label:after {
            content: "\f040";
            font-family: "FontAwesome";
            color: #757575;
            position: absolute;
            top: 10px;
            left: 0;
            right: 0;
            text-align: center;
            margin: auto;
        }
        .avatar-upload .avatar-preview {
            width: 192px;
            height: 192px;
            position: relative;
            border-radius: 100%;
            border: 6px solid #f8f8f8;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
        }
        .avatar-upload .avatar-preview > div {
            width: 100%;
            height: 100%;
            border-radius: 100%;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }
    </style>
@endsection

@section('content')
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>تعديل منتج</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/' . $page='dashboard') }}">لوحة التحكم</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0);"> الاقسام & المنتجات</a></li>
                <li class="breadcrumb-item active"><a href="{{url('/'.$page='product/create')}}">تعديل منتج</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-xxl-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">تعديل منتج / ({{$product->product_name}})</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('product.update','test') }}" enctype="multipart/form-data" method="POST">
                        {{ method_field('patch') }}
                        @csrf
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <div class="avatar-upload">
                                        <div class="avatar-edit">
                                            <input type='file' id="imageUpload" name="product_image" accept=".png, .jpg, .jpeg" />
                                            <label for="imageUpload"></label>
                                        </div>
                                        <div class="avatar-preview">
                                            <div id="imagePreview" style="background-image:
                                                @if(empty($product->product_image))
                                                    url({{URL::asset('assets/images/product/imageUpload.png')}});
                                                @else
                                                    url({{URL::asset('storage/product_image/'.$product->id .'/'. $product->product_image)}});
                                                @endif

                                                ">
                                            </div>
                                        </div>
                                    </div>
                                    @error('product_image')
                                    <span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">أسم المنتج</label>
                                    <input type="text" class="form-control" name="product_name" value="{{$product->product_name}}" required>
                                    <input type="hidden" class="form-control" name="id" value="{{$product->id}}">
                                    @error('product_name')
                                    <span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">رقم الموديل</label>
                                    <input type="text" class="form-control" name="product_number" value="{{$product->product_number}}" required>
                                    @error('product_number')
                                    <span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">سعر الشراء</label>
                                    <input type="number" min="1"  class="form-control" name="purchasing_price" required value="{{$product->purchasing_price}}">
                                    @error('purchasing_price')
                                    <span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">سعر البيع</label>
                                    <input type="number" class="form-control" name="selling_price" required value="{{$product->selling_price}}">
                                    @error('selling_price')
                                    <span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">القسم</label>
                                    <select class="form-control " name="section" required>
                                        <option >أختار القسم</option>
                                        @foreach($productSection as $section)
                                            <option value="{{$section->id}}"
                                                    @if($section->id == $product->section)
                                                    selected
                                                    @endif
                                            >{{$section->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('section')
                                    <span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">وحدة القياس</label>
                                    <select class="form-control " name="unit" required>
                                        <option >وحدة القياس</option>
                                        @foreach($unit as $un)
                                            <option value="{{$un->id}}"
                                                    @if($un->id == $product->unit)
                                                    selected
                                                @endif
                                            >{{$un->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('unit')
                                    <span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">ملاحظات</label>
                                    <textarea class="form-control" rows="4" name="description">{{$product->description}}</textarea>
                                    @error('description')
                                    <span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <button type="submit" class="btn btn-primary">{{__('Update')}}</button>
                                <a href="{{url('/'.$page='product')}}" class="btn btn-light">{{__('Cancel')}}</a>
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
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imageUpload").change(function() {
            readURL(this);
        });
    </script>
@endsection
