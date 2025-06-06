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
                                    <form action="{{route('admin.contacts.reply.store')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
								<input type="hidden" name="id" value="{{$id}}">
									{{-- <div class="row mb-3">
										<label for="inputEnterYourName" class="col-sm-3 col-form-label">File</label>
										<div class="col-sm-9">
											<input name="file" type="file" class="form-control" accept="image/*">
											<small class="text-muted">Upload image in pdf, jpg, jpeg,png, doc, docx format only.</small>
										</div>
									</div> --}}
									<div class="row mb-3">
										<label for="inputEnterYourName" class="col-sm-3 col-form-label">Message</label>
										<div class="col-sm-9">
											{{-- <textarea id="editor" class="form-control" name="description"></textarea> --}}
                                            <textarea  class="form-control" name="reply_message" placeholder="Enter Description"></textarea>
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