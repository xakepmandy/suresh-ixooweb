@extends('admin.layouts.app')

@section('content')

<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					{{-- <div class="breadcrumb-title pe-3">Forms</div> --}}
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Create Pages</li>
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
										<h5 class="mb-0">Create Pages</h5>
									</div>
									<hr/>
                                    <form action="{{route('admin.pages.store')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
									<div class="row mb-3">
										<label for="inputEnterYourName" class="col-sm-3 col-form-label">Page Hedding</label>
										<div class="col-sm-9">
											<input type="text" name="page_hedding" class="form-control" id="inputEnterYourName" placeholder="Enter Page Hedding">
										</div>
									</div>
									<div class="row mb-3">
										<label for="inputEnterYourName" class="col-sm-3 col-form-label">Page Title</label>
										<div class="col-sm-9">
											<input type="text" name="page_title" class="form-control" id="inputEnterYourName" placeholder="Enter Page Title">
										</div>
									</div>
									<div class="row mb-3">
										<label for="inputEnterYourName" class="col-sm-3 col-form-label">Category</label>
										<div class="col-sm-9">
											<select name="category_id" id="category_id"  class="form-select category">
                                                <option selected disabled>Select category</option>
												@foreach($categories as $category)
												<option value="{{ $category->id }}">{{ $category->name }}</option>
												@endforeach
                                            </select>
										</div>
									</div>
									
									<div class="row mb-3">
										<label for="inputEnterYourName" class="col-sm-3 col-form-label">Sub Category</label>
										<div class="col-sm-9">
											<select name="sub_category_id" id="sub_category_id" class="form-select">
                                               <option selected disabled>Select SubCategory</option>
                                            </select>
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
										<label for="inputEnterYourName" class="col-sm-3 col-form-label">Content</label>
										<div class="col-sm-9">
											<textarea id="editor" class="form-control" name="content"></textarea>
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
<script>
    $(document).on('change', '.category', function () {
        var categoryId = $(this).val();

        $.ajax({
            url: "{{ route('admin.getsubcategory') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id: categoryId,
            },
            success: function (response) {
				var subCategorySelect = $('#sub_category_id');
				subCategorySelect.empty();
				subCategorySelect.append('<option selected disabled>Select SubCategory</option>');
				// console.log(response.subcategories);
				$.each(response, function (key, value) {
					
					subCategorySelect.append('<option value="' + value.id + '">' + value.name + '</option>');
				});
			
				// toastr.success(response.message);
            },
            error: function () {
				toastr.options = {
					"closeButton": true,
					"progressBar": true,
					"timeOut": "3000",
					"extendedTimeOut": "1000",
					"positionClass": "toast-top-right"
				};
                toastr.error('Something went wrong.');
            }
        });
    });
</script>
@endsection