@extends('layouts.user') 
@section('header')
@endsection
@section('content')
<div class="page-body">
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
          <div class="col-6">
              <h3>میزان کالری من</h3>
          </div>
          <div class="col-6">
              <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                      <a href="/">
                          <i data-feather="home"></i
                      ></a>
                  </li>
                  <li class="breadcrumb-item">میزان کالری من</li>
              </ol>
          </div>
      </div>
  </div>
  </div>
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <h5>ویرایش</h5>
          </div>
          <form class="form theme-form" method="post">
            @csrf
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <div class="row">
                    <label class="col-sm-3 col-form-label">کالری مورد نیاز روزانه</label>
                    <div class="col-sm-9">
                      <input value="{{Auth::user()->calory}}" class="form-control" type="number" name="calory"/> 
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer text-end">
              <button class="btn btn-primary" type="submit" data-bs-original-title="" title="">ویرایش</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid Ends-->
</div>
@endsection
@section('footer')

@endsection
