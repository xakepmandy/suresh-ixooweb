@extends('admin.layouts.app')

@section('content')

<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					{{-- <div class="breadcrumb-title pe-3">Forms</div> --}}
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Creat Inquiry</li>
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
										<h5 class="mb-0">Create Inquiry</h5>
									</div>
									<hr/>
                                    <form action="{{route('admin.contacts.store')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
									<div class="row mb-3">
										<label for="inputEnterYourName" class="col-sm-3 col-form-label">Name</label>
										<div class="col-sm-9">
											<input type="text" name="name" class="form-control" id="inputEnterYourName" placeholder="Enter Blog Title">
										</div>
									</div>
									<div class="row mb-3">
										<label for="inputEnterYourName" class="col-sm-3 col-form-label">Email</label>
										<div class="col-sm-9">
											<input type="email" name="email" class="form-control" id="inputEnterYourName" placeholder="Enter Blog Title">
										</div>
									</div>
									<div class="row mb-3">
										<label for="inputEnterYourName" class="col-sm-3 col-form-label">Phone</label>
										<div class="col-sm-9">
											<input type="number" name="phone" class="form-control" id="inputEnterYourName" placeholder="Enter Blog Title">
										</div>
									</div>
									<div class="row mb-3">
										<label for="inputEnterYourName" class="col-sm-3 col-form-label">Inquiry</label>
										<div class="col-sm-9">
											<input type="text" name="inquiry" class="form-control" id="inputEnterYourName" placeholder="Enter Blog Title">
										</div>
									</div>
									<div class="row mb-3">
										<label for="inputEnterYourName" class="col-sm-3 col-form-label">Company</label>
										<div class="col-sm-9">
											<input type="text" name="company" class="form-control" id="inputEnterYourName" placeholder="Enter Blog Title">
										</div>
									</div>
									
								
									<div class="row mb-3">
										<label for="inputEnterYourName" class="col-sm-3 col-form-label">File</label>
										<div class="col-sm-9">
											 <input name="file" type="file" class="form-control" accept=".pdf, .jpg, .jpeg, .png, .doc, .docx, image/*">
											<small class="text-muted">Upload image in pdf, jpg, jpeg,png, doc, docx format only.</small>
										</div>
									</div>
									<div class="row mb-3">
										<label for="inputEnterYourName" class="col-sm-3 col-form-label">Message</label>
										<div class="col-sm-9">
											{{-- <textarea id="editor" class="form-control" name="description"></textarea> --}}
                                            <textarea  class="form-control" name="message" placeholder="Enter Description"></textarea>
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