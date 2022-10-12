@extends('layouts.user') @section('header') @endsection @section('content')
<!-- Title bar of the content-->
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>برنامه این ماه شما</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/">
                                <i data-feather="home"></i
                            ></a>
                        </li>
                        <li class="breadcrumb-item">داشبورد</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
 
      <div class="card-block row px-5">
        <div class="col-sm-12 col-lg-12 col-xl-12">
          <div class="table-responsive">
            @csrf
            <table class="table table-striped dashboard-table ">
              <thead class="">
                <tr >
                  <th class="d-none d-lg-table-cell" style="font-weight: bold" scope="col">هفته</th>
                  <th style="font-weight: bold" scope="col">تاریخ</th>
                  <th style="font-weight: bold" scope="col">روز هفته</th>
                  <th style="font-weight: bold" scope="col">غذای روز</th>
                  <th style="font-weight: bold" scope="col">میزان کالری</th>
                </tr>
              </thead>
              <tbody>
                @php
                $weekCounter = 0;
                  $startDay = \Morilog\Jalali\CalendarUtils::strftime('%A', strtotime($gregoryDates->startDate));
                  switch ($startDay) {
                    case 'شنبه':
                      $startRowSpan = '6';
                      break;
                    case 'یکشنبه':
                      $startRowSpan = '5';
                      break;
                    case 'دوشنبه':
                      $startRowSpan = '4';
                      break;
                    case 'سه شنبه':
                      $startRowSpan = '3';
                      break;
                    case 'چهارشنبه':
                      $startRowSpan = '2';
                      break;
                    case 'پنجشنبه':
                      $startRowSpan = '1';
                      break;
                  }
                  $week = 0;
                @endphp
                @foreach($gregoryDates as $key=>$row)
                @php $row->format('D') == 'Fri' && $key !=0 ? $week++ : ''; 
                
                @endphp
                @if($row->format('D') != 'Fri' && \App\Models\Holiday::where('date',$row)->count() == 0)
                @php 
                  switch ($week) {
                    case 0:
                      $weekHoroof = 'اول';
                      break;
                    case 1:
                      $weekHoroof = 'دوم';
                      break;
                    case 2:
                      $weekHoroof = 'سوم';
                      break;
                    case 3:
                      $weekHoroof = 'چهارم';
                      break;
                    case 4:
                      $weekHoroof = 'پنجم';
                      break;
                    case 4:
                      $weekHoroof = 'ششم';
                      break;
                  }
                  // dd($row->startOfMonth());
                $dirooz = \Carbon\Carbon::parse($row)->subDays(1);
                $parirooz = \Carbon\Carbon::parse($row)->subDays(2);
                @endphp
                <tr >
                  @if($row->format('D') == 'Sat' || $gregoryDates->startDate == $row || 
                  ($key != 0 && \App\Models\Holiday::where('date',$dirooz)->count() != 0 && $dirooz->format('D') == 'Sat') 
                  || 
                  ( $key > 1 && \App\Models\Holiday::where('date',$dirooz)->count() != 0 && \App\Models\Holiday::where('date',$parirooz)->count() != 0 && $parirooz->format('D') == 'Sat')
                  )
                    <td class="d-none d-lg-table-cell" rowspan="
                      @if($gregoryDates->startDate == $row)
                        {{$startRowSpan - $holidayInWeek[$weekCounter]}}
                      @else
                      {{6 - $holidayInWeek[$weekCounter]}}
                      @endif
                    " style="vertical-align: middle; font-weight:bold"> هفته {{$weekHoroof}}</td>
                      @php $weekCounter++ @endphp
                  @endif
                  <td>{{\Morilog\Jalali\CalendarUtils::strftime('Y/m/d', strtotime($row))}}</td>
                  
                  <td style="font-weight: bold" scope="row">{{\Morilog\Jalali\CalendarUtils::strftime('%A', strtotime($row))}}</td>
                  <td>
                  
                    @if( isset(Auth::user()->plan[$row->format('Y-m-d')]) )
                      @if(isset(\App\Models\Plate::find(Auth::user()->plan[$row->format('Y-m-d')])->name))
                        {{\App\Models\Plate::find(Auth::user()->plan[$row->format('Y-m-d')])->name}}
                      @endif
                    @else
                      @if(isset($defaults[$weekCounter-1][\Morilog\Jalali\CalendarUtils::strftime('w', strtotime($row))]))
                  {{-- //{{\App\Models\Plate::find($defaults[$weekCounter-1][\Morilog\Jalali\CalendarUtils::strftime('w', strtotime($row))])->name --}}
                       عدم انتخاب  (پیش فرض)
                      @endif
                    @endif
                  </td>
                  <td>
                    @if(isset(Auth::user()->plan[$row->format('Y-m-d')]))
                       @if(isset(\App\Models\Plate::find(Auth::user()->plan[$row->format('Y-m-d')])->calory))
                    	  {{\App\Models\Plate::find(Auth::user()->plan[$row->format('Y-m-d')])->calory}}
                       @endif
                    @else
                      @if(isset($defaults[$weekCounter-1][\Morilog\Jalali\CalendarUtils::strftime('w', strtotime($row))]))
                        {{\App\Models\Plate::find($defaults[$weekCounter-1][\Morilog\Jalali\CalendarUtils::strftime('w', strtotime($row))])->calory}}
                      @endif
                    @endif
                  </td>
                </tr>
                @endif
                @endforeach
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection @section('footer') @endsection
