@extends('layouts.company') 
@section('style')
<link href="/assets/libs/select2/select2.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18">سفارش غذای مهمان</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">سفارش غذای مهمان</a></li>
                    <li class="breadcrumb-item active">ویرایش</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
    
        <div class="card">
            <div class="card-body">
                <form enctype="multipart/form-data" action="/company/meals/update" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-12">
                            <table class="table text-center week-meal-table">
                                <thead>
                                  <tr>
                                    <th>تاریخ</th>
                                    <th>روز هفته</th>
                                    <th>غذای روز</th>
                                    <th>تعداد</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @php 
                                    $defaultDefference = 12;
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
                                    @endphp
                                    @foreach($gregoryDates as $row)
                                    @if($row->format('D') != 'Fri' && $row->format('D') != 'Thr' && \App\Models\Holiday::where('date',$row)->count() == 0 )
                                    @php $difference = \Carbon\Carbon::now()->diffInHours($row, false); 
                                    @endphp
                                    @if($difference <= 72)
                                    <tr class="table-light" id="saturday">
                                        <td>
                                            {{\Morilog\Jalali\CalendarUtils::strftime('Y/m/d', strtotime($row))}}
                                        </td>
                                        <td style="font-weight: bold">{{\Morilog\Jalali\CalendarUtils::strftime('%A', strtotime($row))}}</td>
                                        <td>
                                            
                                            <div class="form-group">
                                                @php $planDishes = $plan->default[floor((\Morilog\Jalali\CalendarUtils::strftime('d', strtotime($row)) + 1) / 7)][myDayOfWeekToJalali($row->dayOfWeek)];
                                                @endphp
                                                {{App\Models\Plate::find($planDishes)->name}}
                                                <input type="hidden" name="plan[{{$row->format('Y-m-d')}}][0][name]"
                                                value="{{$planDishes}}"
                                                />
                                            </div>
                                            
                                        </td>
                                        <td class="mealCalory">
                                            <input @if($difference <= $defaultDefference) disabled @endif style="float:left; width:500px"
                                            class="form-control" name="plan[{{$row->format('Y-m-d')}}][0][count]"
                                            value="{{isset(Auth::user()->guest[$row->format('Y-m-d')][0]['count']) ? Auth::user()->guest[$row->format('Y-m-d')][0]['count'] : ''}}" 
                                            />

                                        </td>
                                    </tr>
                                    @else
                                    @if(myDayOfWeekToJalali($row->dayOfWeek) < 5)
                                    <tr class="table-light" id="saturday">
                                        <td style="vertical-align:middle">
                                            {{\Morilog\Jalali\CalendarUtils::strftime('Y/m/d', strtotime($row))}}
                                        </td>
                                        <td style="font-weight: bold; vertical-align:middle">{{\Morilog\Jalali\CalendarUtils::strftime('%A', strtotime($row))}}</td>
                                        <td colspan="2">
                                            <table width="100%">    
    											@php $planDishes = $plan->days[floor(
                                                (\Morilog\Jalali\CalendarUtils::strftime('d', strtotime($row)) ) / 7)][myDayOfWeekToJalali($row->dayOfWeek)];
                                                @endphp
                                                @foreach($planDishes as $key=>$row2)
                                                @php $plate = \App\Models\Plate::find($row2); @endphp
                                                <tr>
                                                  <td>
                                                    {{$plate->name}}
                                                    <input type="hidden" name="plan[{{$row->format('Y-m-d')}}][{{$key}}][name]"
                                                    value="{{$row2}}"
                                                    />
                                                  </td>
                                                  <td class="mealCalory">
                                                    <input class="form-control" name="plan[{{$row->format('Y-m-d')}}][{{$key}}][count]" style="float:left; width:500px" 
                                                    value="{{isset(Auth::user()->guest[$row->format('Y-m-d')][$key]['count']) ? Auth::user()->guest[$row->format('Y-m-d')][$key]['count'] : ''}}" 
                                                    />
        
                                                  </td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                    </tr>
                                    @endif
                                    @endif
                                    @endif
                                    @endforeach
                                  
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
<script src="/assets/libs/tinymce/tinymce.min.js" referrerpolicy="origin"></script>

    <!-- init js -->
    <script src="/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select-multi').select2();
        });
    </script>
@endsection