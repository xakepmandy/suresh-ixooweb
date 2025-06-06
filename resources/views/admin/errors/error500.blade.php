@extends('admin.layouts.app')
@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
              <div class="breadcrumb-title pe-3">Pages</div>
              <div class="ps-3">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">500 Error</li>
                  </ol>
                </nav>
              </div>
              <div class="ms-auto">
                <div class="btn-group">
                  <button type="button" class="btn btn-primary">Settings</button>
                  <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	<a class="dropdown-item" href="javascript:;">Action</a>
                    <a class="dropdown-item" href="javascript:;">Another action</a>
                    <a class="dropdown-item" href="javascript:;">Something else here</a>
                    <div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Separated link</a>
                  </div>
                </div>
              </div>
            </div>
            <!--end breadcrumb-->

            <div class="error-404 d-flex align-items-center justify-content-center">
              <div class="container">
                <div class="card py-5">
                  <div class="row g-0">
                    <div class="col-xl-5">
                      <div class="card-body p-4">
                        <h1 class="display-1"><span class="text-warning">5</span><span class="text-danger">0</span><span class="text-primary">0</span></h1>
                        <h2 class="font-weight-bold display-4">Sorry, unexpected error</h2>
                        <p>Looks like you are lost!
                          <br>May be you are not connected to the internet!</p>
                        <div class="mt-5">	<a href="javascript:;" class="btn btn-lg btn-primary px-md-5 radius-30">Go Home</a>
                          <a href="javascript:;" class="btn btn-lg btn-outline-dark ms-3 px-md-5 radius-30">Back</a>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-7">
                      <img src="assets/images/error/505-error.png" class="img-fluid" alt="">
                    </div>
                  </div>
                  <!--end row-->
                </div>
              </div>
            </div>
@endsection