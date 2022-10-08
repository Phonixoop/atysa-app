@extends('layouts.company') 
@section('style')
<link href="/assets/libs/select2/select2.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18">انتخاب دسر و پیش غذا و نوشابه ها</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">دسر و پیش غذا و نوشابه ها</a></li>
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
                <form enctype="multipart/form-data" action="/company/plans/update" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-12">
                        @if($plan != null)
                            <table class="table table-striped text-center week-meal-table">
                                <thead>
                                  <tr>
                                    <th>روز هفته</th>
                                    <th>تاریخ</th>
                                    <th>دسر ، پیش غذا و نوشیدنی های روز</th>
                                    <th>تعداد</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr class="table-light" id="saturday">
                                    @php 
                                        $day = '';
                                          if($dayOfWeek == 0){
                                            $now = \Carbon\Carbon::now()->addWeek(1)->format('Y-m-d');
                                          }else{
                                            $now = \Carbon\Carbon::now()->addWeek(1)->addDays(intval(0 - $dayOfWeek))->format('Y-m-d');
                                          }
                                        @endphp
                                    <td>
                                      {{\Morilog\Jalali\CalendarUtils::strftime('Y/m/d', strtotime($now))}}
                                    </td>
                                    <td style="font-weight: bold">شنبه</td>
                                    <td colspan="2">
                                      {{-- {{dd(Auth::user()->dessert)}} --}}
                                      <div class="form-group">
                                          @if(isset($plan[0]))
                                          <table width="100%">
                                            @foreach($plan[0] as $key=>$row)
                                            @php $plate = \App\Dessert::find($row); @endphp
                                            <tr>
                                              <td>
                                                <div class="form-check" style="text-align: right">
                                                  <input name="dessert[{{$now}}][{{$key}}][name]" class="form-check-input" type="checkbox" value="{{$row}}" id="check-{{$key}}"
                                                  @if(isset(Auth::user()->dessert[$now][$key]['name'])) 
                                                      @if(Auth::user()->dessert[$now][$key]['name'] == $row)
                                                        checked
                                                      @endif
                                                  @endif
                                                  >
                                                  <label class="form-check-label" for="check-{{$key}}" style="margin-right:30px">
                                                    {{$plate->name}}
                                                  </label>
                                                </div>
                                              </td>
                                              <td>
                                                <input type="number" style="width:500px!important;float:left" class="form-control" name="dessert[{{$now}}][{{$key}}][count]"
                                                value="{{isset(Auth::user()->dessert[$now][$key]['count']) ? Auth::user()->dessert[$now][$key]['count'] : ''}}" />
                                              </td>
                                            </tr>
                                            @endforeach

                                          </table>
                                          @endif
                                      </div>
                                    </td>
                                  </tr>
                            
                                  <tr class="table-light" id="sunday">
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
                                    
                                    <td>
                                      {{\Morilog\Jalali\CalendarUtils::strftime('Y/m/d', strtotime($now))}}
                                    </td>
                                    <td style="font-weight: bold">یکشنبه</td>
                                    <td colspan="2">
                                      {{-- {{dd(Auth::user()->dessert)}} --}}
                                      <div class="form-group">
                                          @if(isset($plan[1]))
                                          <table width="100%">
                                            @foreach($plan[1] as $key=>$row)
                                            @php $plate = \App\Dessert::find($row); @endphp
                                            <tr>
                                              <td>
                                                <div class="form-check" style="text-align: right">
                                                  <input name="dessert[{{$now}}][{{$key}}][name]" class="form-check-input" type="checkbox" value="{{$row}}" id="check-{{$key}}"
                                                  @if(isset(Auth::user()->dessert[$now][$key]['name'])) 
                                                      @if(Auth::user()->dessert[$now][$key]['name'] == $row)
                                                        checked
                                                      @endif
                                                  @endif
                                                  >
                                                  <label class="form-check-label" for="check-{{$key}}" style="margin-right:30px">
                                                    {{$plate->name}}
                                                  </label>
                                                </div>
                                              </td>
                                              <td>
                                                <input type="number" style="width:500px!important;float:left" class="form-control" name="dessert[{{$now}}][{{$key}}][count]"
                                                value="{{isset(Auth::user()->dessert[$now][$key]['count']) ? Auth::user()->dessert[$now][$key]['count'] : ''}}" />
                                              </td>
                                            </tr>
                                            @endforeach

                                          </table>
                                          @endif
                                      </div>
                                    </td>
                                  </tr>
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
                                  <tr class="table-light" id="monday">
                                    <td>
                                      {{\Morilog\Jalali\CalendarUtils::strftime('Y/m/d', strtotime($now))}}
                                    </td>
                                    <td style="font-weight: bold; vertical-align:middle">دوشنبه</td>
                                    <td colspan="2">
                                      {{-- {{dd(Auth::user()->dessert)}} --}}
                                      <div class="form-group">
                                          @if(isset($plan[2]))
                                          <table width="100%">
                                            @foreach($plan[2] as $key=>$row)
                                            @php $plate = \App\Dessert::find($row); @endphp
                                            <tr>
                                              <td>
                                                <div class="form-check" style="text-align: right">
                                                  <input name="dessert[{{$now}}][{{$key}}][name]" class="form-check-input" type="checkbox" value="{{$row}}" id="check-{{$key}}"
                                                  @if(isset(Auth::user()->dessert[$now][$key]['name'])) 
                                                      @if(Auth::user()->dessert[$now][$key]['name'] == $row)
                                                        checked
                                                      @endif
                                                  @endif
                                                  >
                                                  <label class="form-check-label" for="check-{{$key}}" style="margin-right:30px">
                                                    {{$plate->name}}
                                                  </label>
                                                </div>
                                              </td>
                                              <td>
                                                <input type="number" style="width:500px!important;float:left" class="form-control" name="dessert[{{$now}}][{{$key}}][count]"
                                                value="{{isset(Auth::user()->dessert[$now][$key]['count']) ? Auth::user()->dessert[$now][$key]['count'] : ''}}" />
                                              </td>
                                            </tr>
                                            @endforeach

                                          </table>
                                          @endif
                                      </div>
                                    </td>
                                    
                                  </tr>
                            
                                  <tr class="table-light" id="tuesday">
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
                                    <td>
                                      {{\Morilog\Jalali\CalendarUtils::strftime('Y/m/d', strtotime($now))}}
                                    </td>
                                    <td style="font-weight: bold">سه شنبه</td>
                                    <td colspan="2">
                                      {{-- {{dd(Auth::user()->dessert)}} --}}
                                      <div class="form-group">
                                          @if(isset($plan[3]))
                                          <table width="100%">
                                            @foreach($plan[3] as $key=>$row)
                                            @php $plate = \App\Dessert::find($row); @endphp
                                            <tr>
                                              <td>
                                                <div class="form-check" style="text-align: right">
                                                  <input name="dessert[{{$now}}][{{$key}}][name]" class="form-check-input" type="checkbox" value="{{$row}}" id="check-{{$key}}"
                                                  @if(isset(Auth::user()->dessert[$now][$key]['name'])) 
                                                      @if(Auth::user()->dessert[$now][$key]['name'] == $row)
                                                        checked
                                                      @endif
                                                  @endif
                                                  >
                                                  <label class="form-check-label" for="check-{{$key}}" style="margin-right:30px">
                                                    {{$plate->name}}
                                                  </label>
                                                </div>
                                              </td>
                                              <td>
                                                <input type="number" style="width:500px!important;float:left" class="form-control" name="dessert[{{$now}}][{{$key}}][count]"
                                                value="{{isset(Auth::user()->dessert[$now][$key]['count']) ? Auth::user()->dessert[$now][$key]['count'] : ''}}" />
                                              </td>
                                            </tr>
                                            @endforeach

                                          </table>
                                          @endif
                                      </div>
                                    </td>
                                    
                                  </tr>
                            
                                  <tr class="table-light" id="wednesday">
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
                                    <td>
                                      {{\Morilog\Jalali\CalendarUtils::strftime('Y/m/d', strtotime($now))}}
                                    </td>
                                    <td style="font-weight: bold">چهار شنبه</td>
                                    <td colspan="2">
                                      {{-- {{dd(Auth::user()->dessert)}} --}}
                                      <div class="form-group">
                                          @if(isset($plan[4]))
                                          <table width="100%">
                                            @foreach($plan[4] as $key=>$row)
                                            @php $plate = \App\Dessert::find($row); @endphp
                                            <tr>
                                              <td>
                                                <div class="form-check" style="text-align: right">
                                                  <input name="dessert[{{$now}}][{{$key}}][name]" class="form-check-input" type="checkbox" value="{{$row}}" id="check-{{$key}}"
                                                  @if(isset(Auth::user()->dessert[$now][$key]['name'])) 
                                                      @if(Auth::user()->dessert[$now][$key]['name'] == $row)
                                                        checked
                                                      @endif
                                                  @endif
                                                  >
                                                  <label class="form-check-label" for="check-{{$key}}" style="margin-right:30px">
                                                    {{$plate->name}}
                                                  </label>
                                                </div>
                                              </td>
                                              <td>
                                                <input type="number" style="width:500px!important;float:left" class="form-control" name="dessert[{{$now}}][{{$key}}][count]"
                                                value="{{isset(Auth::user()->dessert[$now][$key]['count']) ? Auth::user()->dessert[$now][$key]['count'] : ''}}" />
                                              </td>
                                            </tr>
                                            @endforeach

                                          </table>
                                          @endif
                                      </div>
                                    </td>
                                    
                                  </tr>
                            
                                  <tr class="table-light" id="thursday">
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
                                    <td>
                                      {{\Morilog\Jalali\CalendarUtils::strftime('Y/m/d', strtotime($now))}}
                                    </td>
                                    <td style="font-weight: bold">پنجشنبه</td>
                                    <td colspan="2">
                                      {{-- {{dd(Auth::user()->dessert)}} --}}
                                      <div class="form-group">
                                          @if(isset($plan[5]))
                                          <table width="100%">
                                            @foreach($plan[5] as $key=>$row)
                                            @php $plate = \App\Dessert::find($row); @endphp
                                            <tr>
                                              <td>
                                                <div class="form-check" style="text-align: right">
                                                  <input name="dessert[{{$now}}][{{$key}}][name]" class="form-check-input" type="checkbox" value="{{$row}}" id="check-{{$key}}"
                                                  @if(isset(Auth::user()->dessert[$now][$key]['name'])) 
                                                      @if(Auth::user()->dessert[$now][$key]['name'] == $row)
                                                        checked
                                                      @endif
                                                  @endif
                                                  >
                                                  <label class="form-check-label" for="check-{{$key}}" style="margin-right:30px">
                                                    {{$plate->name}}
                                                  </label>
                                                </div>
                                              </td>
                                              <td>
                                                <input type="number" style="width:500px!important;float:left" class="form-control" name="dessert[{{$now}}][{{$key}}][count]"
                                                value="{{isset(Auth::user()->dessert[$now][$key]['count']) ? Auth::user()->dessert[$now][$key]['count'] : ''}}" />
                                              </td>
                                            </tr>
                                            @endforeach

                                          </table>
                                          @endif
                                      </div>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                              @else
                                <h4> برای این تاریخ پیش غذایی درج نشده است </h4>
                              @endif
                        </div>
                    </div>
                    <div class="form-group row">
                    @if($plan != null)
                        <button type="submit" class="btn btn-primary waves-effect waves-light">ثبت</button>
                    @endif
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
          $('input[type=number]').prop('disabled', true);
          $('input[type=number]').each(function(){
            if(this.value){
              $(this).prop('disabled', false);
            }
          });
          $('.select-multi').select2();
          $('input[type=checkbox]').change(function(){
            var me = $(this);
            var attr = me.attr("name").replace('[name]','[count]');
            if($(this).is(':checked')){
              $('input[type="number"][name="'+ attr+'"]').prop('disabled',false);
            }else{
              $('input[type="number"][name="'+ attr+'"]').prop('disabled',true);
            }
          })
        });
    </script>
@endsection