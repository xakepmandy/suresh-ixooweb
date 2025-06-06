@extends('admin.layouts.app')

@section('content')
  <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center">
              {{-- <div class="breadcrumb-title pe-3 text-white">Pages</div> --}}
              <div class="ps-3">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt text-white"></i></a>
                    </li>
                    <li class="breadcrumb-item active text-white" aria-current="page">User Profile</li>
                  </ol>
                </nav>
              </div>
            </div>
            <!--end breadcrumb-->
           
            <div class="profile-cover bg-dark"></div>

            <div class="row">
              <div class="col-12 col-lg-8">
                <div class="card shadow-sm border-0">
                  <div class="card-body">
                      <h5 class="mb-0">My Account</h5>
                      <hr>
                      <form action="{{ route('admin.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')  
                      <div class="card shadow-none border">
                        <div class="card-header">
                          <h6 class="mb-0">USER INFORMATION</h6>
                        </div>
                        <div class="card-body">
                          <div class="row">
                             <div class="col-6">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}">
                             </div>
                             <div class="col-6">
                              <label class="form-label">Email address</label>
                              <input type="text" class="form-control" name="email" value="{{ Auth::user()->email }}">
                            </div>
                             
                         </div>
                        </div>
                      </div>
                      
                      <div class="text-start">
                        <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                      </div>
                       </form>
                  </div>
                </div>
              </div>
              <div class="col-12 col-lg-4">
                <div class="card shadow-sm border-0 overflow-hidden">
                  <div class="card-body">
                      <div class="profile-avatar text-center">
                        <img src="{{asset('assets/images/avatars/avatar-1.png')}}" class="rounded-circle shadow" width="120" height="120" alt="">
                      </div>
                      {{-- <div class="d-flex align-items-center justify-content-around mt-5 gap-3">
                          <div class="text-center">
                            <h4 class="mb-0">45</h4>
                            <p class="mb-0 text-secondary">Friends</p>
                          </div>
                          <div class="text-center">
                            <h4 class="mb-0">15</h4>
                            <p class="mb-0 text-secondary">Photos</p>
                          </div>
                          <div class="text-center">
                            <h4 class="mb-0">86</h4>
                            <p class="mb-0 text-secondary">Comments</p>
                          </div>
                      </div>
                      <div class="text-center mt-4">
                        <h4 class="mb-1">Jhon Deo, 27</h4>
                        <p class="mb-0 text-secondary">Sydney, Australia</p>
                        <div class="mt-4"></div>
                        <h6 class="mb-1">HR Manager - Codervent Technology</h6>
                        <p class="mb-0 text-secondary">University of Information Technology</p>
                      </div>
                      <hr>
                      <div class="text-start">
                        <h5 class="">About</h5>
                        <p class="mb-0">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem.
                      </div> --}}
                  </div>
                  {{-- <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent border-top">
                      Followers
                      <span class="badge bg-primary rounded-pill">95</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                      Following
                      <span class="badge bg-primary rounded-pill">75</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                      Templates
                      <span class="badge bg-primary rounded-pill">14</span>
                    </li>
                  </ul> --}}
                </div>
              </div>
            </div><!--end row-->
@endsection