@extends('layouts.admin') 
@section('style')
<link href="/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
<link href="/assets/libs/quill/quill.core.css" rel="stylesheet" type="text/css" />
<link href="/assets/libs/quill/quill.bubble.css" rel="stylesheet" type="text/css" />
<link href="/assets/libs/quill/quill.snow.css" rel="stylesheet" type="text/css" />
<link href="https://unpkg.com/persian-datepicker@1.2.0/dist/css/persian-datepicker.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">تعطیلات</a></li>
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
                <form enctype="multipart/form-data" action="/admin/holiday/update" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$single->id}}" />
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">تاریخ </label>
                        <div class="col-md-10">
                            <input class="form-control example1" id="date" name="date" value="{{\Morilog\Jalali\CalendarUtils::strftime('Y-m-d', strtotime($single->date))}}"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">ویرایش</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end col -->
</div>
@endsection
@section('script')
<script src="/assets/libs/tinymce/tinymce.min.js" referrerpolicy="origin"></script>

    <!-- init js -->
    <script src="/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="https://unpkg.com/persian-date@1.1.0/dist/persian-date.min.js"></script>
    <script src="https://unpkg.com/persian-datepicker@1.2.0/dist/js/persian-datepicker.min.js"></script>
    <script>
        $(document).ready(function() {
            console.log('tae');
            $('.example1').persianDatepicker({
                initialValueType: 'persian',
                format: 'YYYY/M/D'
            });
        });
    </script>
@endsection