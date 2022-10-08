@extends('layouts.logistic') 
@section('style')
<link href="/assets/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="/assets/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="/assets/libs/datatables/select.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="/assets/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="/assets/libs/select2/select2.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18">شرکت ها</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">شرکت ها</a></li>
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
                            <th>تعداد غذاهای سفارش داده شده</th>
                            <th>هات باکس ها</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($all as $key=>$row)
                        <tr>
                            <form action="/logistic/companies/hotbox" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{$row->id}}" />
                            {{-- <td>{{$row->id}}</td> --}}
                            <td>{{$row->name}}</td>
                            <td>{{App\Models\User::where('companyId',$row->id)->where('type',5)->count()}}</td>
                            <td>
                                <select multiple="multiple" class="form-control select-multi" name="hotboxes[]">
                                @foreach($hotboxes as $row2)
                                    <option 
                                    @if(isset($row->hotboxes) && $row->hotboxes != null)
                                        @foreach ($row->hotboxes as $item)
                                            {{trim($item) == trim($row2->name) ? 'selected=selected' : ''}}
                                        @endforeach
                                    @endif
                                    value="{{trim($row2->name)}}">{{trim($row2->name)}}</option>
                                @endforeach
                                </select>
                            </td>
                            <td>
                                <button type="submit" class="btn btn-secondary waves-effect waves-light">ویرایش</button>
                                <a href="/admin/companies/users/daily/{{$row->id}}" class="btn btn-success waves-effect waves-light">ریز سفارش های امروز</a>
                            </td>
                            </form>
                        </tr>
                        @endforeach
                    </tbody> 
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <!-- Required datatable js -->
    <script src="/assets/libs/select2/select2.min.js"></script>
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
            $(document).ready(function() {
                $('.select-multi').select2();
            });
        });
    </script>
@endsection