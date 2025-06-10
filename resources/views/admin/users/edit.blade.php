@extends('admin.layouts.app')

@section('content')

<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					{{-- <div class="breadcrumb-title pe-3">Forms</div> --}}
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Edit User</li>
							</ol>
						</nav>
					</div>
				</div>
                <div class="row">
					<div class="col-xl-9 mx-auto">
						
						<div class="card">
							<div class="card-body">
								<div class="border p-4 rounded">
									<div class="card-title d-flex align-items-center">
										<h5 class="mb-0">Edit User</h5>
									</div>
									<hr/>
                                    <form action="{{route('admin.users.update',$user->id)}}" method="POST" enctype="multipart/form-data">
                                        @csrf
										@method('PUT')
									<div class="row mb-3">
										<label for="inputEnterYourName" class="col-sm-3 col-form-label">Name</label>
										<div class="col-sm-9">
											<input type="text" name="name" value="{{ $user->name }}" class="form-control" id="inputEnterYourName" placeholder="Enter your name" required>
										</div>
									</div>
									<div class="row mb-3">
										<label for="inputEnterYourName" class="col-sm-3 col-form-label">Email</label>
										<div class="col-sm-9">
											<input type="email" name="email" value="{{ $user->email }}" class="form-control" id="inputEnterYourName" placeholder="Enter your email" required>
										</div>
									</div>
									<div class="row mb-3">
										<label for="inputEnterYourName" class="col-sm-3 col-form-label">phone</label>
										<div class="col-sm-9">
											<input type="number" name="phone" value="{{ $user->phone }}" class="form-control" id="inputEnterYourName" placeholder="Enter your phone number" required>
										</div>
									</div>
									<div class="row mb-3">
										<label for="inputEnterYourName" class="col-sm-3 col-form-label">Status</label>
										<div class="col-sm-9">
											<select  name="status" id="" class="form-select">
                                                <option selected disabled>Select Status</option>
                                                <option value="1" @if($user->status == 1) selected @endif>Active</option>
                                                <option value="0" @if($user->status == 0) selected @endif>Inactive</option>
                                            </select>
										</div>
									</div>
									<div class="row mb-3">
										<label for="inputEnterYourName" class="col-sm-3 col-form-label">Profile Image</label>
										<div class="col-sm-9">
											<input name="profile_image" type="file" value="{{ $user->profile_image }}" class="form-control" accept="image/*">
											<small class="text-muted">Upload image in jpg, jpeg, png format only.</small>
											@if($user->profile_image)
												<img src="{{ asset('uploads/profile_images/'.$user->profile_image) }}" alt="user Image" class="img-thumbnail mt-2" style="max-width: 200px;">
											@endif
										</div>
									</div>
									<div class="row">
										<label class="col-sm-3 col-form-label"></label>
										<div class="col-sm-9 text-end">
											<button type="submit" class="btn btn-primary px-5">Create</button>
										</div>
									</div>
                                    </form>
								</div>
							</div>
						</div>
					</div>
				</div>
				
@endsection