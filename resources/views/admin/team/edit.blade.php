@extends('admin.layouts.app')

@section('content')

<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					{{-- <div class="breadcrumb-title pe-3">Forms</div> --}}
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Edit Team</li>
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
										<h5 class="mb-0">Edit Team</h5>
									</div>
									<hr/>
                                    <form action="{{route('admin.team.update',$team->id)}}" method="POST" enctype="multipart/form-data">
                                        @csrf
										@method('PUT')
									<div class="row mb-3">
										<label for="inputEnterYourName" class="col-sm-3 col-form-label">Name</label>
										<div class="col-sm-9">
											<input type="text" name="name" value="{{ $team->name }}" class="form-control" id="inputEnterYourName" placeholder="Enter Your Name">
										</div>
									</div>
									<div class="row mb-3">
										<label for="inputEnterYourName" class="col-sm-3 col-form-label">Email</label>
										<div class="col-sm-9">
											<input type="email" name="email" value="{{ $team->email }}" class="form-control" id="inputEnterYourName" placeholder="Enter Your Email">
										</div>
									</div>
									<div class="row mb-3">
										<label for="inputEnterYourName" class="col-sm-3 col-form-label">Phone</label>
										<div class="col-sm-9">
											<input type="number" name="phone" value="{{ $team->phone }}" class="form-control" id="inputEnterYourName" placeholder="Enter Your Phone Number ">
										</div>
									</div>
									<div class="row mb-3">
										<label for="inputEnterYourName" class="col-sm-3 col-form-label">Position</label>
										<div class="col-sm-9">
											<input type="text" name="position" value="{{ $team->position }}" class="form-control" id="inputEnterYourName" placeholder="Enter Your Position ">
										</div>
									</div>
									<div class="row mb-3">
										<label for="inputEnterYourName" class="col-sm-3 col-form-label">Status</label>
										<div class="col-sm-9">
											<select  name="status" id="" class="form-select">
                                                <option selected disabled>Select Status</option>
                                                <option value="active" @if($team->status === 'Active') selected @endif>Active</option>
                                                <option value="inactive" @if($team->status === 'Inactive') selected @endif>Inactive</option>
                                            </select>
										</div>
									</div>
									<div class="row mb-3">
										<label for="inputEnterYourName" class="col-sm-3 col-form-label">Image</label>
										<div class="col-sm-9">
											<input name="image" type="file" value="{{ $team->image }}" class="form-control" accept="image/*">
											<small class="text-muted">Upload image in jpg, jpeg, png format only.</small>
											@if($team->image)
												<img src="{{ asset( 'uploads/team/' . $team->image) }}" alt="Blog Image" class="img-thumbnail mt-2" style="max-width: 200px;">
											@endif
										</div>
									</div>
									<div class="row mb-3">
										<label for="inputEnterYourName" class="col-sm-3 col-form-label">Bio</label>
										<div class="col-sm-9">
											<textarea id="editor" class="form-control" value="" name="bio"> {{$team->bio}}</textarea>
										</div>
									</div>
									<div class="row">
										<label class="col-sm-3 col-form-label"></label>
										<div class="col-sm-9 text-end">
											<button type="submit" class="btn btn-primary px-5">Update</button>
										</div>
									</div>
                                    </form>
								</div>
							</div>
						</div>
					</div>
				</div>
@endsection