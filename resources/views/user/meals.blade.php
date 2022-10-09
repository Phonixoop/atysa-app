@extends('layouts.user') @section('header') @endsection @section('content')
<!-- Title bar of the content-->
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
          <div class="row">
            <div class="col-md-9 col-xs-12">
              <h3>انتخاب غذای ماه <span style="color:#0d6efd;font-weight:bold">{{$monthName}}</span></h3>
                <p>دوست عزیز در صورت استفاده از رژیم غذایی منحصر به فرد می توانید از بخش <a href="/user/create-plate">ساخت بشقاب سفارشی</a> ، بشقاب مورد نظر خود را ایجاد نموده و از زبانه ی غذای روز انتخاب نمایید.</p>
            </div>
            <div class="col-md-3 col-xs-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/">
                            <i data-feather="home"></i
                        ></a>
                    </li>
                    <li class="breadcrumb-item">انتخاب غذای ماه</li>
                </ol>
            </div>
        </div>
        </div>
    </div>
    @php
     $fee = 0;
     @endphp
    @if($plateFee > 0)
      @php
      $fee =  substr($plateFee, 0, -3);
      @endphp
    <h2 style="position: sticky; top:0; background-color:white; width:100%; padding:10px 5px; border-radius:10px"> قیمت <span data-total-fee  style="color:green; font-size:40px" >0</span> هزار تومان</h2>
    @endif
    <div class="container">
      <div class="card-block row px-5">
        <div class="col-sm-12 col-lg-12 col-xl-12">
          <div class="table-responsive">
            <form method="post" action="/user/plan" style="width: 100%;">
              @csrf
             
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
                              @if(isset(Auth::user()->plan[$row->format('Y-m-d')])) 
                              @if(Auth::user()->plan[$row->format('Y-m-d')] == $row2)
                                selected="selected"
                              @endif
                              @endif
                                value="{{$row2}}" data-calory="{{$plate->calory}}">
                              @if($plate->name)
                                 {{$plate->name}}
                              @endif
                            </option>
                            @endforeach
                          @endif
                      </select>
                    </div>
                  </td>
                  <td class="mealCalory">
                    @if(isset(Auth::user()->plan[$row->format('Y-m-d')]))
                       @if(isset(\App\Models\Plate::find(Auth::user()->plan[$row->format('Y-m-d')])->calory))
                         {{\App\Models\Plate::find(Auth::user()->plan[$row->format('Y-m-d')])->calory}}
                       @endif
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
</div>
@endsection 
@section('footer') 
  <script>
    let obj = {};
    const totalFeeElement =  $('[data-total-fee]');
    // this code is working like cheeze!! . you do not have the ability to change this code
    const fee = {{$fee}}

    let seleectedCount = 0;
    let totalFee = 0;
    $(document).ready(function() {
      $('select').change(function(){
  
        var option = $('option:selected', this).attr('data-calory');
        if(option != null){
          totalFee+=fee;
          seleectedCount++;
          $(this).parent().parent().parent().find('.mealCalory').text(option);
          @if(Auth::user()->calory)
            var myCalory = {{Auth::user()->calory}}
            if(option < myCalory){
              $(this).parent().parent().parent().find('.mealCalory').css('color','green');
            }else{
              $(this).parent().parent().parent().find('.mealCalory').css('color','red');
              alert('کالری این غذا بیشتر از کالری درخواستی شما می باشد.');
            }
          @endif
        }else{
          totalFee-=fee;
          seleectedCount--;
          $(this).parent().parent().parent().find('.mealCalory').text('انتخاب نشده است');
          $(this).parent().parent().parent().find('.mealCalory').css('color','#000');
        }

     
       totalFeeElement.text(totalFee+"");
      });
    });
  </script>
@endsection
