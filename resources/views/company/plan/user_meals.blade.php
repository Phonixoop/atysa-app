@extends('layouts.company') 
@section('style')
<link href="/assets/libs/select2/select2.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18">ویرایش برنامه {{$user->name}}</h4>
				  
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">ویرایش برنامه {{$user->name}}</a></li>
                    <li class="breadcrumb-item active">ویرایش</li>
                </ol>
            </div>

        </div>
    </div>
</div>

    
   <div class="container">
      <div class="card-block row px-5">
        <div class="col-sm-12 col-lg-12 col-xl-12">
          <div class="table-responsive">
         
            <form method="post" action="/company/users/updateplan" enctype="multipart/form-data" style="width: 100%;">
              @csrf
            <input type="hidden" name="userId" value="{{$user->id}}" />
            <table class="table table-striped dashboard-table ">
              <thead class="">
                <tr >
                  <th class="d-none d-lg-table-cell" style="font-weight: bold" scope="col">هفته</th>
                  <th style="font-weight: bold" scope="col">تاریخ</th>
                  <th style="font-weight: bold" scope="col">روز هفته</th>
                  <th width="150px" style="font-weight: bold" scope="col">غذای روز</th>
                  <th style="font-weight: bold" scope="col">میزان کالری</th>
                </tr>
              </thead>
              <tbody>
                @php 
                  function myDayOfWeekToJalali($number){
                    switch ($number) {
                      case 0:
                        $weekHoroof = 1;
                        break;
                      case 1:
                        $weekHoroof = 2;
                        break;
                      case 2:
                        $weekHoroof = 3;
                        break;
                      case 3:
                        $weekHoroof = 4;
                        break;
                      case 4:
                        $weekHoroof = 5;
                        break;
                      case 5:
                        $weekHoroof = 6;
                        break;
                      case 6:
                        $weekHoroof = 0;
                        break;
                    }
                    return $weekHoroof;
                  }
                  $weekCounter = 0;
                  $startDay = \Morilog\Jalali\CalendarUtils::strftime('%A', strtotime($gregoryDates->startDate));
                  switch ($startDay) {
                    case 'شنبه':
                      $startRowSpan = '5';
                      break;
                    case 'یکشنبه':
                      $startRowSpan = '4';
                      break;
                    case 'دوشنبه':
                      $startRowSpan = '3';
                      break;
                    case 'سه شنبه':
                      $startRowSpan = '2';
                      break;
                    case 'چهارشنبه':
                      $startRowSpan = '1';
                      break;
                    //case 'پنجشنبه':
                      //$startRowSpan = '1';
                      //break;
                  }
                  $week = $weekOfMonth;
                @endphp
                @foreach($gregoryDates as $key=>$row)
              
               @php if($monthNumber != \Morilog\Jalali\Jalalian::fromCarbon($row)->format("m")) continue;  @endphp
              
                @php $row->format('D') == 'Fri' ? $week++ : ''; 
                @endphp
                @if($row->format('D') != 'Fri' && $row->format('D') != 'Thu' && \App\Models\Holiday::where('date',$row)->count() == 0 )
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
                    case 5:
                      $weekHoroof = 'ششم';
                      break;
                  }
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
                        {{$startRowSpan - intval($holidayInWeek[$weekCounter])}}
                      @else
                      {{5 - intval($holidayInWeek[$weekCounter])}}
                      @endif
                    " style="vertical-align: middle; font-weight:bold"> هفته {{$weekHoroof}}</td>
                      @php $weekCounter++ @endphp
                  @endif
                  <td>{{\Morilog\Jalali\CalendarUtils::strftime('Y/m/d', strtotime($row))}}</td>
                  
                  <td style="font-weight: bold" scope="row">{{\Morilog\Jalali\CalendarUtils::strftime('%A', strtotime($row))}}</td>
                  <td>
                    <div class="form-group">
                     
                      <select name="plate[{{$row->format('Y-m-d')}}]" class="form-control">
                        <option value="">---انتخاب نمایید---</option>
                        
                          @if(isset($plan->days[$week][myDayOfWeekToJalali($row->dayOfWeek)]))
                         
                          @php $planDishes = $plan->days[$week][myDayOfWeekToJalali($row->dayOfWeek)];
                              foreach($myDishes as $row2){
                                  array_push($planDishes, $row2);
                              }
                    
                          @endphp
                            @foreach($planDishes as $row2)
                            @php $plate = \App\Models\Plate::find($row2); @endphp
                            <option 
                              @if(isset($user->plan[$row->format('Y-m-d')])) 
                                @if($user->plan[$row->format('Y-m-d')] == $row2)
                                  selected="selected"
                                @endif
                              @endif
                                value="{{$row2}}" data-calory="{{$plate->calory}}">
                              {{$plate->name}}
                            </option>
                            @endforeach
                          @endif
                      </select>
                    </div>
                  </td>
                  <td class="mealCalory">
                    @if(isset($user->plan[$row->format('Y-m-d')]))
                      {{\App\Models\Plate::find($user->plan[$row->format('Y-m-d')])->calory}}
                    @else
                      انتخاب نشده است
                    @endif
                  </td>
                </tr>
                @endif
                @endforeach
                
              </tbody>
            </table>
            <button class="btn btn-primary plan-submit-btn" style="width: 250px; margin:30px 0px">ثبت</button>
            </form>
          </div>
        </div>
      </div>
    </div>
@endsection
@section('script')
<script src="/assets/libs/select2/select2.min.js"></script>
<script src="/assets/libs/tinymce/tinymce.min.js" referrerpolicy="origin"></script>

    <!-- init js -->
    <script src="/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select-multi').select2();
        });
    </script>
@endsection