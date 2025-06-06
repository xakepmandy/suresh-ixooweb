@extends('admin.layouts.app')

@section('content')

<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					{{-- <div class="breadcrumb-title pe-3">Forms</div> --}}
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Seo Details</li>
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
										<h5 class="mb-0">Seo Details</h5>
									</div>
									<hr/>
                                    <form action="{{route('admin.seo.store')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
										<input type="hidden" name="page_id" value="{{$page->id}}" hidden>
									<div class="row mb-3">
										<label for="inputEnterYourName" class="col-sm-3 col-form-label">Seo Title</label>
										<div class="col-sm-9">
											<input type="text" name="seo_title" class="form-control" id="inputEnterYourName" placeholder="Enter Seo Title">
										</div>
									</div>
									<div class="row mb-3">
										<label for="inputEnterYourName" class="col-sm-3 col-form-label">Seo Keywords</label>
										<div class="col-sm-9">
											<input type="text" name="seo_keywords" class="form-control" id="inputEnterYourName" placeholder="Enter Seo Keywords">
										</div>
									</div>
									<div class="row mb-3">
										<label for="inputEnterYourName" class="col-sm-3 col-form-label">Seo Url</label>
										<div class="col-sm-9">
											<input type="url" name="seo_url" class="form-control" id="inputEnterYourName" placeholder="Enter Seo Keywords">
										</div>
									</div>
									
									<div class="row mb-3">
										<label for="inputEnterYourName" class="col-sm-3 col-form-label">Seo Language</label>
										<div class="col-sm-9">
											<select name="seo_language" id="" class="form-select">
                                                <option selected disabled>Select Language</option>
                                                <option value="en">English</option>
                                                <option value="fr">French</option>
                                                <option value="es">Spanish</option>
                                            </select>
										</div>
									</div>
									<div class="row mb-3">
										<label for="inputEnterYourName" class="col-sm-3 col-form-label">Seo Image</label>
										<div class="col-sm-9">
											<input name="seo_image" type="file" class="form-control" accept="image/*">
											<small class="text-muted">Upload image in jpg, jpeg, png format only.</small>
										</div>
									</div>
									<div class="row mb-3">
										<label for="inputEnterYourName" class="col-sm-3 col-form-label">Seo Discription</label>
										<div class="col-sm-9">
											<textarea id="editor" class="form-control" name="seo_description"></textarea>
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