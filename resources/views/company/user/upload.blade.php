@extends('layouts.company') 
@section('style')
<link href="/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18">کاربران</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">کاربران</a></li>
                    <li class="breadcrumb-item active">افزودن</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
    
        <div class="card">
            <div class="card-body">
                <form enctype="multipart/form-data" action="/company/users/upload" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if($errors->any())
                        <p  class="text-danger mb-4 mt-3">{{$errors->first()}}</p>
                    @endif
                    <div class="form-group row">
                        <p>برای افزودن همه کارمندان با یک فایل ، فایل مربوطه را مطابق فایل نمونه تکمیل و بارگذاری نمایید.</p>
                        <p>&nbsp;<a href="/sample.csv">دانلود فایل نمونه</a>&nbsp;</p>
                        <p> - <a href="/sample.csv">مشاهده ی ویدئوی آموزشی</a></p>
                    </div>
                    <div class="form-group row">
                        <label for="file" class="col-md-2 col-form-label">فایل csv</label>
                        <div class="col-md-10">
                            <input class="form-control" type="file" id="file" name="file"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">بارگذاری</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end col -->
</div>
@endsection
@section('footer')
    <script src="/assets/libs/select2/js/select2.min.js"></script>
    <script src="/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#userId').select2();
        });
    </script>
@endsection