@extends('layouts.user') 
@section('header')
@endsection
@section('content')
<script src="/main/js/num2persian-min.js" async></script>
<style>

  
  :root 
  {
    --text-green : rgb(25, 158, 163);
  }
  
  .flex 
  {
    display: flex;
  }
  .flex-col {
    flex-direction: column;
  }
  .justify-center 
  {
    justify-content: center
  }
  .items-center 
  {
    align-items: center;
  }
  .gap-3
  {
    gap:3px;
  }
  
</style>
<div class="page-body">
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
          <div class="col-6">
              <h3>سوابق تراکنش ها</h3>
          </div>
          <div class="col-6">
              <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                      <a href="/">
                          <i data-feather="home"></i
                      ></a>
                  </li>
                  <li class="breadcrumb-item">تراکنش ها</li>
              </ol>
          </div>
      </div>
  </div>
  </div>
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6" style="padding:0px; border-radius: 20px; !important; margin:0 auto; background-color: #fcffff;overflow:hideen; ">
        <table dir="rtl" class="table">
            <thead class="thead-dark">
              <tr class="">
                <th scope="col">#</th>
                <th scope="col  ">
                    <div class=" flex justify-center items-center">تاریخ</div>
                </th>
                <th scope="col   ">
                    <div class=" flex justify-center items-center">مقدار پرداختی</div>
                </th>
                <th scope="col ">
                    <div class=" flex justify-center items-center">وضعیت پرداخت</div>
                </th>
              </tr>
            </thead>
            <tbody>
                @foreach($transactions as $key=>$transaction)
                @php $rowStyle = $key % 2 === 0 ? "background-color: #e1eeef; border-radius:20px;" : "background-color: #ffffff" @endphp
                <tr style="{{$rowStyle}}">
                    @php $date = \Morilog\Jalali\Jalalian::fromCarbon(\Carbon\Carbon::parse($transaction["date"])); @endphp
                    <th scope="row">{{$key + 1}}</th>
                    <td >
                        <div class="flex justify-center items-center gap-3">
                            <span style="padding: 2px">{{$date->format("d M Y")}}</span>
                          
                            <span  style="padding: 2px">{{$date->format("H:i:s")}}</span>
                        </div>
                    </td>
                    <td >
                      @php $amount = preg_replace("/\B(?=(\d{3})+(?!\d))/",",",$transaction["amount"]); @endphp 
                        <div class="flex justify-center items-center">{{$amount}} تومان</div>
                    </td>
                    <td  class="flex justify-center items-center">
                 
                        @if($transaction["hasPayed"])
                        <div class="flex justify-center items-center" style="border: #199EA3 1px solid; width: 100px; color:#199EA3; text-align: center; border-radius: 100px; padding:5px 10px;">
                            موفق
                        </div>
                        @else 
                        <div class="flex justify-center items-center"  style="border: #e93939 1px dashed; color:#e93939; width: 100px; text-align: center; border-radius: 100px; padding:5px 10px;">
                            نا موفق
                        </div>
                        @endif     
                    </td>
                  </tr>
                @endforeach
        
            </tbody>
          </table>
      </div>
    </div>
  </div>
  <!-- Container-fluid Ends-->
</div>


@endsection
@section('footer')

@endsection

