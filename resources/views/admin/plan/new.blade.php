@extends('layouts.admin') 
@section('style')
<link href="/assets/libs/select2/select2.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18">افزودن برنامه غذایی</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">برنامه غذایی</a></li>
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
                <form enctype="multipart/form-data" action="/admin/plans/create" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="month" class="col-md-2 col-form-label">ماه</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" id="month" name="month"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="endDate" class="col-md-2 col-form-label">برنامه</label>
                        <div class="col-md-10">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>شنبه</th>
                                        <th>یکشنبه</th>
                                        <th>دوشنبه</th>
                                        <th>سه شنبه</th>
                                        <th>چهارشنبه</th>
                                        <th>پنجشنبه</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i = 0; $i < 5; $i++)
                                        <tr class="table-active">
                                            <th scope="row">{{$i+1}}</th>
                                            <td>
                                                پیش فرض : 
                                                <select class="form-control" name="default[{{$i}}][0]">
                                                    @foreach ($plates as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                                بشقاب ها : 
                                                <select multiple="multiple" class="form-control select-multi" name="days[{{$i}}][0][]">
                                                    @foreach ($plates as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                                دسر ها : 
                                                <select multiple="multiple" class="form-control select-multi" name="desserts[{{$i}}][0][]">
                                                    @foreach ($dessert as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                پیش فرض : 
                                                <select class="form-control" name="default[{{$i}}][1]">
                                                    @foreach ($plates as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                                بشقاب ها : 
                                                <select multiple="multiple" class="form-control select-multi" name="days[{{$i}}][1][]">
                                                    @foreach ($plates as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                                دسر ها : 
                                                <select multiple="multiple" class="form-control select-multi" name="desserts[{{$i}}][1][]">
                                                    @foreach ($dessert as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                پیش فرض : 
                                                <select class="form-control" name="default[{{$i}}][2]">
                                                    @foreach ($plates as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                                بشقاب ها : 
                                                <select multiple="multiple" class="form-control select-multi" name="days[{{$i}}][2][]">
                                                    @foreach ($plates as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                                دسر ها : 
                                                <select multiple="multiple" class="form-control select-multi" name="desserts[{{$i}}][2][]">
                                                    @foreach ($dessert as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                پیش فرض : 
                                                <select class="form-control" name="default[{{$i}}][3]">
                                                    @foreach ($plates as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                                بشقاب ها :
                                                <select multiple="multiple" class="form-control select-multi" name="days[{{$i}}][3][]">
                                                    @foreach ($plates as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                                دسر ها : 
                                                <select multiple="multiple" class="form-control select-multi" name="desserts[{{$i}}][3][]">
                                                    @foreach ($dessert as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                پیش فرض : 
                                                <select class="form-control" name="default[{{$i}}][4]">
                                                    @foreach ($plates as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                                بشقاب ها :
                                                <select multiple="multiple" class="form-control select-multi" name="days[{{$i}}][4][]">
                                                    @foreach ($plates as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                                دسر ها : 
                                                <select multiple="multiple" class="form-control select-multi" name="desserts[{{$i}}][4][]">
                                                    @foreach ($dessert as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                پیش فرض : 
                                                <select class="form-control" name="default[{{$i}}][5]">
                                                    @foreach ($plates as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                                بشقاب ها :
                                                <select multiple="multiple" class="form-control select-multi" name="days[{{$i}}][5][]">
                                                    @foreach ($plates as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                                دسر ها : 
                                                <select multiple="multiple" class="form-control select-multi" name="desserts[{{$i}}][5][]">
                                                    @foreach ($dessert as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="form-group row">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">ثبت</button>
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