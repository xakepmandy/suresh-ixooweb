@extends('admin.layouts.app')

@section('content')

<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					{{-- <div class="breadcrumb-title pe-3">Forms</div> --}}
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Edit Seo</li>
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
										<h5 class="mb-0">Edit Seo</h5>
									</div>
									<hr/>
                                    <form action="{{route('admin.seo.update',$seoData->id)}}" method="POST" enctype="multipart/form-data">
                                        @csrf
										@method('PUT')
										<input type="text" name="page_id" value="{{$seoData->page_id}}" hidden>
									<div class="row mb-3">
										<label for="inputEnterYourName" class="col-sm-3 col-form-label">Seo Title</label>
										<div class="col-sm-9">
											<input type="text" name="seo_title" value="{{ $seoData->seo_title }}" class="form-control" id="inputEnterYourName" placeholder="Enter Seo Title">
										</div>
									</div>
									<div class="row mb-3">
										<label for="inputEnterYourName" class="col-sm-3 col-form-label">Seo Url</label>
										<div class="col-sm-9">
											<input type="text" name="seo_url" value="{{ $seoData->seo_url }}" class="form-control" id="inputEnterYourName" placeholder="Enter Seo Url">
										</div>
									</div>
									<div class="row mb-3">
										<label for="inputEnterYourName" class="col-sm-3 col-form-label">Seo Keywords</label>
										<div class="col-sm-9">
											<input type="text" name="seo_keywords" value="{{ $seoData->seo_keywords }}" class="form-control" id="inputEnterYourName" placeholder="Enter Seo Keywords">
										</div>
									</div>
									
										<div class="row mb-3">
										<label for="inputEnterYourName" class="col-sm-3 col-form-label">Seo Language</label>
										<div class="col-sm-9">
											<select name="seo_language" id="" class="form-select">
                                                <option selected disabled>Select Language</option>
                                                <option value="en" @if($seoData->seo_language == 'en') selected @endif>English</option>
                                                <option value="fr" @if($seoData->seo_language == 'fr') selected @endif>French</option>
                                                <option value="es" @if($seoData->seo_language == 'es') selected @endif>Spanish</option>
                                            </select>
										</div>
									</div>
									<div class="row mb-3">
										<label for="inputEnterYourName" class="col-sm-3 col-form-label">Seo Image</label>
										<div class="col-sm-9">
											<input name="seo_image" type="file" value="{{ $seoData->seo_image }}" class="form-control" accept="image/*">
											<small class="text-muted">Upload image in jpg, jpeg, png format only.</small>
											@if($seoData->seo_image)
												<img src="{{ asset('uploads/seo_images/'.$seoData->seo_image) }}" alt="page Image" class="img-thumbnail mt-2" style="max-width: 200px;">
											@endif
										</div>
									</div>
									<div class="row mb-3">
										<label for="inputEnterYourName" class="col-sm-3 col-form-label">Seo Discription</label>
										<div class="col-sm-9">
											<textarea id="editor" class="form-control" value="" name="seo_description"> {{$seoData->seo_description}}</textarea>
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
@section('scripts')