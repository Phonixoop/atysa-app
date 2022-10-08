@extends('layouts.company') 
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
            <h4 class="page-title mb-0 font-size-18">نظرات</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">نظرات</a></li>
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
                <table id="datatable2" class="table table-bordered dt-responsive datatable" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>نام غذا</th>
                            <th>ظاهر کلی غذا </th>
                            <th>رنگ غذا </th>
                            <th>بافت غذا</th>
                            <th>چقدر لذت بردید</th>
                            <th>سفارش مجدد</th>
                            <th>موبایل</th>
                            <th>مشتری</th>
                            <th>تاریخ</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($extra as $key=>$row)
                        <tr>
                            <td>{{$row['poll']['id']}}</td>
                            <td>
                                {{$row['food']}}<br/>
                            </td>
                            <td>{{$row['poll']['zaherKolli']}}</td>
                            <td>{{$row['poll']['rangeGhaza']}}</td>
                            <td>
                                {{$row['poll']['bafteGhaza']}}
                            </td>
                            <td>
                                {{$row['poll']['cheghadrLezzat']}}
                            </td>
                            <td>
                                {{$row['poll']['mojaddad']}}
                            </td>
                            <td>
                                {{$row['poll']['mobile']}}
                            </td>
                            <td>
                                {{$row['user']['name']}}<br/>
                            </td>
                            <td>
                                {{\Morilog\Jalali\CalendarUtils::strftime('Y/m/d h:i:s', strtotime($row['poll']['created_at']))}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- <a class="btn btn-primary" style="width:100%" href="/admin/exportpoll" >خروجی گرفتن</a> --}}
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