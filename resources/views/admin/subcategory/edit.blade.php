@extends('admin.layouts.app')

@section('content')

<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					{{-- <div class="breadcrumb-title pe-3">Forms</div> --}}
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Edit SubCategory</li>
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
										<h5 class="mb-0">Edit SubCategory</h5>
									</div>
									<hr/>
									<form action="{{route('admin.subcategory.update',$subcategory->id)}}" method="POST">
										@csrf
										@method('PUT')
									<div class="row mb-3">
										<label for="inputEnterYourName" class="col-sm-3 col-form-label">SubCategory Name</label>
										<div class="col-sm-9">
											<input type="text" name="subcategory_name" value="{{ $subcategory->name }}" class="form-control" id="inputEnterYourName" placeholder="Enter Category Name">
										</div>
									</div>
									<div class="row mb-3">
										<label for="inputEnterYourName" class="col-sm-3 col-form-label">Category Name</label>
										<div class="col-sm-9">
											<select name="category_id" class="form-select" id="">
												<option value="">Select Category</option>
												@foreach($categories as $category)
													<option value="{{ $category->id }}" @if($subcategory->category_id == $category->id) selected @endif>{{ $category->name }}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="row mb-3">
										<label for="inputEnterYourName" class="col-sm-3 col-form-label">status</label>
										<div class="col-sm-9">
											<select name="status" class="form-select" id="">
                                                <option value="" selected disabled>Select Status</option>
                                                <option value="1" @if($subcategory->status == 1) selected @endif>Active</option>
                                                <option value="0" @if($subcategory->status == 0) selected @endif>Inactive</option>
                                            </select>
										</div>
									</div>
									<div class="row">
										<label class="col-sm-3 col-form-label"></label>
										<div class="col-sm-9">
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