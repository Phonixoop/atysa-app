@extends('layouts.company') 
@section('style')
<link href="/assets/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="/assets/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
<script src="https://cdn.bootcss.com/flv.js/1.5.0/flv.min.js"></script>
<style>
    Video {
        border: 1px double black;
        width: 322px;
        height: 242px;
    }
</style>

<!-- Responsive datatable examples -->
<link href="/assets/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18">دوربین ها</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">دوربین ها</a></li>
                    <li class="breadcrumb-item active">مشاهده همه</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<div class="row" >
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <video id="videoElement2" muted="muted" preload="none">                
                </video>
                <video id="videoElement" muted="muted" preload="none">
                </video>
                <video id="videoElement3" muted="muted" preload="none">                
                </video>
                <video id="videoElement4" muted="muted" preload="none">                
                </video>
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
        window.addEventListener("load", fn, false);
  
        function fn() {
          if (flvjs.isSupported()) {
            var videoElement = document.getElementById("videoElement");
            var flvPlayer = flvjs.createPlayer({
              type: "flv",
              url: "https://atysa.ir:8443/Catering/FrontLine.flv?sign={{$md}}",
            });
            flvPlayer.attachMediaElement(videoElement);
            flvPlayer.load();
            flvPlayer.play();

            var videoElement = document.getElementById("videoElement2");
            var flvPlayer = flvjs.createPlayer({
              type: "flv",
              url: "https://atysa.ir:8443/Catering/RiceLine.flv?sign={{$md2}}",
            });
            flvPlayer.attachMediaElement(videoElement);
            flvPlayer.load();
            flvPlayer.play();

            var videoElement = document.getElementById("videoElement3");
            var flvPlayer = flvjs.createPlayer({
              type: "flv",
              url: "https://atysa.ir:8443/Catering/HotBoxLine.flv?sign={{$md3}}",
            });
            flvPlayer.attachMediaElement(videoElement);
            flvPlayer.load();
            flvPlayer.play();

            var videoElement = document.getElementById("videoElement4");
            var flvPlayer = flvjs.createPlayer({
              type: "flv",
              url: "https://atysa.ir:8443/Catering/WashingLine.flv?sign={{$md4}}",
            });
            flvPlayer.attachMediaElement(videoElement);
            flvPlayer.load();
            flvPlayer.play();
          }
        }
      </script>
    
@endsection