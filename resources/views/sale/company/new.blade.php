@extends('layouts.sale') 
@section('style')
<link href="/assets/libs/select2/select2.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
<link href="https://unpkg.com/persian-datepicker@1.2.0/dist/css/persian-datepicker.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18">افزودن شرکت</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">شرکتها</a></li>
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
                <form enctype="multipart/form-data" action="/sale/companies/create" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="type" class="col-md-2 col-form-label">نام شرکت</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" id="name" name="name"/>
                            @error('name')
                                <span class="invalid-feedback" role="alert" style="display: block!important">

                                        <div>{{ $errors->first('name') }}</div>

                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="userId" class="col-md-2 col-form-label">مدیر شرکت</label>
                        <div class="col-md-10">
                            <select class="form-control" name="manager" id="userId">
                                <option value="">-- لطفا انتخاب نمایید --</option>
                                @foreach($managers as $manager)
                                <option value="{{$manager->id}}">{{$manager->name}}</option>
                                @endforeach
                            </select>
                            @error('manager')
                                <span class="invalid-feedback" role="alert" style="display: block!important">

                                        <div>{{ $errors->first('manager') }}</div>

                                </span>
                            @enderror
                        </div>
                        @error('manager')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-md-2 col-form-label">شماره تماس</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" id="phone" name="phone"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="endDate" class="col-md-2 col-form-label">تاریخ پایان قرارداد</label>
                        <div class="col-md-10">
                            <input class="form-control example1" type="text" id="endDate" name="endDate"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="enable" class="col-md-2 col-form-label">قابل استفاده است؟</label>
                        <div class="col-md-10">
                            <select class="form-control" name="enable" id="enable">
                                <option value="true">بله</option>
                                <option value="false">خیر</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">ثبت نام</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end col -->
</div>
@endsection
@section('script')
    <script src="/assets/libs/select2/select2.min.js"></script>
    <script src="/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="https://unpkg.com/persian-date@1.1.0/dist/persian-date.min.js"></script>
    <script src="https://unpkg.com/persian-datepicker@1.2.0/dist/js/persian-datepicker.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#userId').select2();
            $('.example1').persianDatepicker({
                initialValueType: 'persian',
                format: 'YYYY/M/D'
            });
        });
    </script>
@endsection