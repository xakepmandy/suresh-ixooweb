@extends('admin.layouts.app')

@section('content')

<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					{{-- <div class="breadcrumb-title pe-3">Forms</div> --}}
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Creat Blog</li>
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
										<h5 class="mb-0">Create Blog</h5>
									</div>
									<hr/>
                                    <form action="{{route('admin.blogs.store')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
									<div class="row mb-3">
										<label for="inputEnterYourName" class="col-sm-3 col-form-label">Title</label>
										<div class="col-sm-9">
											<input type="text" name="title" class="form-control" id="inputEnterYourName" placeholder="Enter Blog Title">
										</div>
									</div>
									<div class="row mb-3">
										<label for="inputEnterYourName" class="col-sm-3 col-form-label">Status</label>
										<div class="col-sm-9">
											<select name="status" id="" class="form-select">
                                                <option selected disabled>Select Status</option>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
										</div>
									</div>
									<div class="row mb-3">
										<label for="inputEnterYourName" class="col-sm-3 col-form-label">Image</label>
										<div class="col-sm-9">
											<input name="image" type="file" class="form-control" accept="image/*">
											<small class="text-muted">Upload image in jpg, jpeg, png format only.</small>
										</div>
									</div>
									<div class="row mb-3">
										<label for="inputEnterYourName" class="col-sm-3 col-form-label">Description</label>
										<div class="col-sm-9">
											<textarea id="editor" class="form-control" name="description"></textarea>
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