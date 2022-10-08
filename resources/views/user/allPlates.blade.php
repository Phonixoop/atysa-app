@extends('layouts.user') 
@section('header')
@endsection
@section('content')
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>بشقاب های من</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/">
                                <i data-feather="home"></i
                            ></a>
                        </li>
                        <li class="breadcrumb-item">بشقاب های من</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
<div class="row px-5">  
    @csrf
  <table class="table table-striped text-center my-plate-table">
    <thead class="">
      <tr>
        <th style="font-weight: bold">نام بشقاب</th>
        <th style="font-weight: bold">کالری</th>
        <th style="font-weight: bold">عملیات</th>
      </tr>
    </thead>
    <tbody>
        @if(count($plates) > 0)
        @foreach ($plates as $item)
            <tr class="below-calory " id=1>
                <td class="font-weight-bold">{{$item->name}}</td>
                <td class="mealCalory myPlateCalory">{{$item->calory}}</td>
                <td>
                    {{-- <a href="/user/plate/{{$item->id}}" class="btn btn-pill btn-success btn-air-success btn-sm" >مشاهده</a> --}}
                    <form method="post" action="/user/deleteplate">
                        @csrf
                        <input type="hidden" name="plateId" value="{{$item->id}}"/>
                        <button class="btn btn-pill btn-danger btn-air-danger btn-sm" >حذف</button>
                    </form>
                </td>
          </tr>
        @endforeach
        @else
        <tr class="below-calory " id=1>
            <td class="font-weight-bold" colspan="3">
                شما بشقابی برای خود نساخته اید
            </td>
        </tr>
        @endif
    </tbody>
  </table>
</div>
</div>
@endsection 
@section('footer')
<script>
    var defaultCalory = parseInt( $('#maxDailyCalory').text());
    console.log(defaultCalory)
    var tableLenght =($('.my-plate-table tr').length)
    for(i=1 ; i<tableLenght; i++){
        var calory = parseInt($( "#" + i  +' .myPlateCalory').text());
        if(calory > defaultCalory){
            $('#'+i).removeAttr('class').addClass('over-calory');
        }else if(calory <= defaultCalory){
            $('#'+i).removeAttr('class').addClass('below-calory'); 
        }
    }
</script>
@endsection