@extends('admin.layouts.app')
@section('content')
 	<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					{{-- <div class="breadcrumb-title pe-3">Forms</div> --}}
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Change Password</li>
							</ol>
						</nav>
					</div>
				</div>
				<!--end breadcrumb-->
        
				<div class="row">
					<div class="col-xl-6 mx-auto">

                        <div class="card">
                        <div class="card-body">
                            <div class="border p-3 rounded">
                            <h6 class="mb-0 text-uppercase">Change Password</h6>
                            <hr/>
                            <form class="row g-3" action="{{ route('admin.update.password') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="col-12">
                                <label class="form-label">Old Password</label>
                                <input type="text" name="current_password" class="form-control">
                            </div>
                            <div class="col-12">
                                <label class="form-label">New Password</label>
                                <input type="text" name="new_password" class="form-control">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Confirm Password</label>
                                <input type="text" name="new_password_confirmation" class="form-control">
                            </div>
                            <div class="col-12">
                                <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Change Password</button>
                                </div>
                            </div>
                            </form>
                        </div>
                        </div>
                        </div>
					</div>
				</div>
				<!--end row-->


@endsection