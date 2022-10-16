@extends('layouts.admin') 
@section('style')
<link href="/assets/libs/select2/select2.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18">تغییر نام پلن</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">پلن ها</a></li>
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
                <form enctype="multipart/form-data" action="/admin/plans/update" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input class="form-control" value="{{$single->id}}" type="hidden" id="planId" name="planId"/>
                    <div class="form-group row">
                        <label for="type" class="col-md-2 col-form-label">نام پلن</label>
                        <div class="col-md-10">         
                            <input class="form-control" value="{{$single->name}}" type="text" id="name" name="name"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">تغییر نام</button>
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

    <!-- init js -->
    <script src="/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select-multi').select2();
        });
    </script>
@endsection