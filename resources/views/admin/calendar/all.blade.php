@extends('layouts.admin') 
@section('style')
<link href="/assets/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="/assets/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="/assets/libs/datatables/select.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="/assets/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18">امروز</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">امروز</a></li>
                    <li class="breadcrumb-item active">مشاهده همه</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                @if(Session::has('removed'))
                <div class="alert alert-success" role="alert">
                    Removed Successfully
                </div>
                @endif
                @if(Session::has('updated'))
                <div class="alert alert-success" role="alert">
                    Updated Successfully
                </div>
                @endif
                <table id="datatable2" class="table table-bordered dt-responsive datatable" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            {{-- <th>#</th> --}}
                            <th>نام شرکت</th>
                            <th>تعداد قورمه سبزی</th>
                            <th>تعداد قیمه</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>

                    <tbody>
                        {{-- @foreach($all as $key=>$row) --}}
                        <tr>
                            {{-- <td>{{$row->id}}</td> --}}
                            <td>تست 1</td>
                            <td>5</td>
                            <td>12</td>
                            <td>
                                <a href="/admin/calendar/view" class="btn btn-secondary waves-effect waves-light">چاپ</a>
                            </td>
                        </tr>
                        <tr>
                            {{-- <td>{{$row->id}}</td> --}}
                            <td>تست 1</td>
                            <td>5</td>
                            <td>12</td>
                            <td>
                                <a href="/admin/calendar/view" class="btn btn-secondary waves-effect waves-light">چاپ</a>
                            </td>
                        </tr>
                        <tr>
                            {{-- <td>{{$row->id}}</td> --}}
                            <td>تست 1</td>
                            <td>5</td>
                            <td>12</td>
                            <td>
                                <a href="/admin/calendar/view" class="btn btn-secondary waves-effect waves-light">چاپ</a>
                            </td>
                        </tr>
                        {{-- @endforeach --}}
                    </tbody> 
                </table>
                <h3>مجموع</h3>
                <table id="datatable2" class="table table-bordered dt-responsive datatable" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            {{-- <th>#</th> --}}
                            <th>نام غذا</th>
                            <th>ساده</th>
                            <th>VIP</th>
                        </tr>
                    </thead>

                    <tbody>
                        {{-- @foreach($all as $key=>$row) --}}
                        <tr>
                            {{-- <td>{{$row->id}}</td> --}}
                            <td>قیمه</td>
                            <td>5</td>
                            <td>12</td>
                        </tr>
                        <tr>
                            {{-- <td>{{$row->id}}</td> --}}
                            <td>قورمه سبزی</td>
                            <td>5</td>
                            <td>12</td>
                        </tr>
                        {{-- @endforeach --}}
                    </tbody> 
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <!-- Required datatable js -->
    <script src="/assets/libs/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/libs/datatables/dataTables.bootstrap4.js"></script>
    <!-- Buttons examples -->
    <script src="/assets/libs/datatables/dataTables.buttons.min.js"></script>
    <script src="/assets/libs/datatables/buttons.bootstrap4.min.js"></script>
    {{-- <script src="/assets/libs/jszip/jszip.min.js"></script>
    <script src="/assets/libs/pdfmake/build/pdfmake.min.js"></script>
    <script src="/assets/libs/pdfmake/build/vfs_fonts.js"></script> --}}
    <script src="/assets/libs/datatables/buttons.html5.min.js"></script>
    <script src="/assets/libs/datatables/buttons.print.min.js"></script>
    <!-- Responsive examples -->
    <script src="/assets/libs/datatables/dataTables.responsive.min.js"></script>
    <script src="/assets/libs/datatables/responsive.bootstrap4.min.js"></script>

    <!-- Datatable init js -->
    <script src="/assets/js/pages/datatables.init.js"></script>
    <script src="/assets/js/app.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#datatable2').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/fa.json'
                }
            });
        });
    </script>
@endsection