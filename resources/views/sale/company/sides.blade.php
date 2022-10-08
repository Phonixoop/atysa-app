@extends('layouts.sale') 
@section('style')
<link href="/assets/libs/select2/select2.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18">ویرایش دسر و پیش غذاها</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">دسر و پیش غذاها</a></li>
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
                <form enctype="multipart/form-data" action="/sale/companies/updatesidedishes" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="userId" value="{{$user->id}}"/>
                    <div class="form-group row">
                        <label for="month" class="col-md-2 col-form-label">ماه</label>
                        <div class="col-md-10">
                            {{-- <input class="form-control" type="text" id="month" name="month" value="{{$single->month}}"/> --}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="endDate" class="col-md-2 col-form-label">برنامه</label>
                        <div class="col-md-10">
                            <table class="table text-center week-meal-table">
                                <thead>
                                  <tr>
                                    <th>روز هفته</th>
                                    <th>غذای روز</th>
                                    <th>تاریخ</th>
                                    <th>تعداد</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr class="table-light" id="saturday">
                                    <td>شنبه</td>
                                    <td>
                                      <div class="form-group">
                                        @php 
                                        $day = '';
                                          if($dayOfWeek == 0){
                                            $now = \Carbon\Carbon::now()->addWeek(1)->format('Y-m-d');
                                          }else{
                                            $now = \Carbon\Carbon::now()->addWeek(1)->addDays(intval(0 - $dayOfWeek))->format('Y-m-d');
                                          }
                                        @endphp
                                        <select name="dessert[{{$now}}][name]" class="form-control">
                                          <option value="">---انتخاب نمایید---</option>
                                          @if(isset($plan[0]))
                                            @foreach($plan[0] as $row)
                                            @php $plate = \App\Dessert::find($row); @endphp
                                            
                                            <option 
                                              @if(isset($user->dessert[$now]['name'])) 
                                                @if($user->dessert[$now]['name'] == $row)
                                                    selected="selected"
                                                @endif
                                              @endif
                                                value="{{$row}}" >{{$plate->name}}</option>
                                            @endforeach
                                          @endif
                                        </select>
                                      </div>
                                    </td>
                                    <td>
                                        {{\Morilog\Jalali\CalendarUtils::strftime('Y/m/d', strtotime($now))}}
                                    </td>
                                    <td class="mealCalory">
                                        <input class="form-control" name="dessert[{{$now}}][count]"
                                        value="{{isset($user->dessert[$now]['count']) ? $user->dessert[$now]['count'] : ''}}" />

                                    </td>
                                  </tr>
                            
                                  <tr class="table-light" id="sunday">
                                    <td>یکشنبه</td>
                                    <td>
                                      <div class="form-group">
                                        
                                        @php 
                                          $day = '';
                                          if($dayOfWeek == 1){
                                            $now = \Carbon\Carbon::now()->addWeek(1)->format('Y-m-d');
                                          }elseif($dayOfWeek > 1){
                                            $now = \Carbon\Carbon::now()->addWeek(1)->addDays(intval(1 - $dayOfWeek))->format('Y-m-d');
                                            
                                            
                                          }else{
                                            $now = \Carbon\Carbon::now()->addWeek(1)->addDays(intval(1 - $dayOfWeek))->format('Y-m-d');
                                          }
                                        @endphp
                                        <select name="dessert[{{$now}}][name]" class="form-control">
                                          <option value="">---انتخاب نمایید---</option>
                                          @if(isset($plan[1]))
                                            @foreach($plan[1] as $row)
                                            @php $plate = \App\Dessert::find($row); @endphp
                                            <option 
                                              @if(isset($user->dessert[$now]['name'])) 
                                              @if($user->dessert[$now]['name'] == $row)
                                                selected="selected"
                                              @endif
                                              @endif
                                                value="{{$row}}" >{{$plate->name}}</option>
                                            @endforeach
                                          @endif
                                        </select>
                                      </div>
                                    </td>
                                    <td>
                                        {{\Morilog\Jalali\CalendarUtils::strftime('Y-m-d', strtotime($now))}}
                                    </td>
                                    <td class="mealCalory">
                                        <input class="form-control" name="dessert[{{$now}}][count]"
                                        value="{{isset($user->dessert[$now]['count']) ? $user->dessert[$now]['count'] : ''}}" />

                                    </td>
                                    
                                  </tr>
                            
                                  <tr class="table-light" id="monday">
                                    <td>دوشنبه</td>
                                    <td>
                                      <div class="form-group">
                                        @php 
                                          $day = '';
                                          if($dayOfWeek == 2){
                                            $now = \Carbon\Carbon::now()->addWeek(1)->format('Y-m-d');
                                          }elseif($dayOfWeek > 2){
                                            $now = \Carbon\Carbon::now()->addWeek(1)->addDays(intval(2 - $dayOfWeek))->format('Y-m-d');
                                            
                                            
                                          }else{
                                            $now = \Carbon\Carbon::now()->addWeek(1)->addDays(intval(2 - $dayOfWeek))->format('Y-m-d');
                                          }
                                        @endphp
                                        <select name="dessert[{{$now}}][name]" class="form-control">
                                          <option value="">---انتخاب نمایید---</option>
                                          @if(isset($plan[2]))
                                            @foreach($plan[2] as $row)
                                            @php $plate = \App\Dessert::find($row); @endphp
                                            <option 
                                              @if(isset($user->dessert[$now]['name'])) 
                                              @if($user->dessert[$now]['name'] == $row)
                                                selected="selected"
                                              @endif
                                              @endif
                                                value="{{$row}}" >{{$plate->name}}</option>
                                            @endforeach
                                          @endif
                                        </select>
                                      </div>
                                    </td>
                                    <td>
                                        {{\Morilog\Jalali\CalendarUtils::strftime('Y-m-d', strtotime($now))}}
                                    </td>
                                    <td class="mealCalory">
                                        <input class="form-control" name="dessert[{{$now}}][count]"
                                        value="{{isset($user->dessert[$now]['count']) ? $user->dessert[$now]['count'] : ''}}" />

                                    </td>
                                    
                                  </tr>
                            
                                  <tr class="table-light" id="tuesday">
                                    <td>سه شنبه</td>
                                    <td>
                                      <div class="form-group">
                                        @php 
                                          $day = '';
                                          if($dayOfWeek == 3){
                                            $now = \Carbon\Carbon::now()->addWeek(1)->format('Y-m-d');
                                          }elseif($dayOfWeek > 3){
                                            $now = \Carbon\Carbon::now()->addWeek(1)->addDays(intval(3 - $dayOfWeek))->format('Y-m-d');
                                            
                                            
                                          }else{
                                            $now = \Carbon\Carbon::now()->addWeek(1)->addDays(intval(3 - $dayOfWeek))->format('Y-m-d');
                                          }
                                        @endphp
                                        <select name="dessert[{{$now}}][name]" class="form-control">
                                          <option value="">---انتخاب نمایید---</option>
                                          @if(isset($plan[3]))
                                            @foreach($plan[3] as $row)
                                            @php $plate = \App\Dessert::find($row); @endphp
                                            <option 
                                              @if(isset($user->dessert[$now]['name'])) 
                                              @if($user->dessert[$now]['name'] == $row)
                                                selected="selected"
                                              @endif
                                              @endif
                                                value="{{$row}}" >{{$plate->name}}</option>
                                            @endforeach
                                          @endif
                                        </select>
                                      </div>
                                    </td>
                                    <td>
                                        {{\Morilog\Jalali\CalendarUtils::strftime('Y-m-d', strtotime($now))}}
                                    </td>
                                    <td class="mealCalory">
                                        <input class="form-control" name="dessert[{{$now}}][count]"
                                        value="{{isset($user->dessert[$now]['count']) ? $user->dessert[$now]['count'] : ''}}" />

                                    </td>
                                    
                                  </tr>
                            
                                  <tr class="table-light" id="wednesday">
                                    <td>چهار شنبه</td>
                                    <td>
                                      <div class="form-group">
                                        @php 
                                          $day = '';
                                          if($dayOfWeek == 4){
                                            $now = \Carbon\Carbon::now()->addWeek(1)->format('Y-m-d');
                                          }elseif($dayOfWeek > 4){
                                            $now = \Carbon\Carbon::now()->addWeek(1)->addDays(intval(4 - $dayOfWeek))->format('Y-m-d');
                                            
                                            
                                          }else{
                                            $now = \Carbon\Carbon::now()->addWeek(1)->addDays(intval(4 - $dayOfWeek))->format('Y-m-d');
                                          }
                                        @endphp
                                        <select name="dessert[{{$now}}][name]" class="form-control">
                                          <option value="">---انتخاب نمایید---</option>
                                          @if(isset($plan[4]))
                                            @foreach($plan[4] as $row)
                                            @php $plate = \App\Dessert::find($row); @endphp
                                            <option 
                                              @if(isset($user->dessert[$now]['name'])) 
                                              @if($user->dessert[$now]['name'] == $row)
                                                selected="selected"
                                              @endif
                                              @endif
                                                value="{{$row}}" >{{$plate->name}}</option>
                                            @endforeach
                                          @endif
                                        </select>
                                      </div>
                                    </td>
                                    <td>
                                        {{\Morilog\Jalali\CalendarUtils::strftime('Y-m-d', strtotime($now))}}
                                    </td>
                                    <td class="mealCalory">
                                        <input class="form-control" name="dessert[{{$now}}][count]"
                                        value="{{isset($user->dessert[$now]['count']) ? $user->dessert[$now]['count'] : ''}}" />

                                    </td>
                                    
                                  </tr>
                            
                                  <tr class="table-light" id="thursday">
                                    <td>پنجشنبه</td>
                                    <td>
                                      <div class="form-group">
                                        @php 
                                          $day = '';
                                          if($dayOfWeek == 5){
                                            $now = \Carbon\Carbon::now()->addWeek(1)->format('Y-m-d');
                                          }elseif($dayOfWeek > 5){
                                            $now = \Carbon\Carbon::now()->addWeek(1)->addDays(intval(5 - $dayOfWeek))->format('Y-m-d');
                                            
                                            
                                          }else{
                                            $now = \Carbon\Carbon::now()->addWeek(1)->addDays(intval(5 - $dayOfWeek))->format('Y-m-d');
                                          }
                                        @endphp
                                        <select name="dessert[{{$now}}][name]" class="form-control">
                                          <option value="">---انتخاب نمایید---</option>
                                          @if(isset($plan[5]))
                                            @foreach($plan[5] as $row)
                                            @php $plate = \App\Dessert::find($row); @endphp
                                            <option 
                                              @if(isset($user->dessert[$now]['name'])) 
                                              @if($user->dessert[$now]['name'] == $row)
                                                selected="selected"
                                              @endif
                                              @endif
                                                value="{{$row}}" >{{$plate->name}}</option>
                                            @endforeach
                                          @endif
                                        </select>
                                      </div>
                                    </td>
                                    <td>
                                        {{\Morilog\Jalali\CalendarUtils::strftime('Y-m-d', strtotime($now))}}
                                    </td>
                                    <td class="mealCalory">
                                        <input class="form-control" name="dessert[{{$now}}][count]"
                                        value="{{isset($user->dessert[$now]['count']) ? $user->dessert[$now]['count'] : ''}}" />

                                    </td>
                                  </tr>
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