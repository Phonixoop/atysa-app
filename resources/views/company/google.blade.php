@extends('layouts.company') 
@section('style')
<link href="https://static.neshan.org/sdk/leaflet/1.4.0/leaflet.css" rel="stylesheet" type="text/css">


<!-- Responsive datatable examples -->
<link href="/assets/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18">نقشه</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">نقشه</a></li>
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
                <div id="map" style="height:600px; z-index:1!important;"></div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <!-- Required datatable js -->
    
<script src="https://static.neshan.org/sdk/leaflet/1.4.0/leaflet.js" type="text/javascript"></script>
    
    <script type="text/javascript">
    @if(isset($hotbox->lang))
      var myMap = new L.Map('map', {
        key: 'web.33hR7MpwG5OVgatgcennzPcc76741EERLTQ0uZna',
        maptype: 'neshan',
        poi: true,
        traffic: false,
        center: [{{$hotbox->lat}}, {{$hotbox->lang}}],
        zoom: 14
      });
      var marker = L.marker([{{$hotbox->lat}}, {{$hotbox->lang}}]).addTo(myMap);
   @endif
    </script>
@endsection