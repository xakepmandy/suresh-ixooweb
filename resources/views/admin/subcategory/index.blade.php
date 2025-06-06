@extends('admin.layouts.app')
@section('content')
	<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">List</div>
					<div class="ps-3">
						
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.category') }}">{{ucfirst($category->name)}}</a></li>
								<li class="breadcrumb-item active" aria-current="page">SubCategory List</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
							<a href="{{route('admin.subcategory.create',$category->id)}}" class="btn btn-primary">Create New</a>
						</div>
					</div>
				</div>
				<!--end breadcrumb-->
				
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										
										<th>Category</th>
										<th>SubCategory</th>
										<th>Status</th>
                                        <th>Action</th>
									</tr>
								</thead>
								<tbody>
                                    @If(count($subcategories) == 0)
                                    <tr>
                                        <td colspan="6" class="text-center">No SubCategories Found</td>
                                    </tr>
                                    @else
                                    @foreach($subcategories as $subcategory)
                                    <tr>
                                        <td>{{$subcategory->name}}</td>
										<td>
											@if($subcategory->category)
												{{$subcategory->category->name}}
											@else
												No Category
											@endif
                                        </td>
										<td>
											<div class="form-check form-switch">
												<input class="form-check-input toggle-status" type="checkbox" data-id="{{ $subcategory->id }}" {{ $subcategory->status == 1 ? 'checked' : '' }}>
											</div>
										</td>
                                        <td>
                                            <a href="{{route('admin.subcategory.edit',$subcategory->id)}}"><i class="bi bi-pencil-square"></i></a>
                                            <a href="{{route('admin.subcategory.delete',$subcategory->id)}}" onclick="return confirm('Are you sure you want to delete this subcategory?');"><i class="bi bi-trash2"></i></a>
                                        </td>

                                    </tr>
                                    @endforeach
                                    @endif
								</tbody>
								<tfoot>
									<tr>
										<th>Category</th>
										<th>SubCategory</th>
										<th>Status</th>
                                        <th>Action</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
@endsection
@section('scripts')
<script>
    $(document).on('change', '.toggle-status', function () {
        var subcategoryId = $(this).data('id');
        var status = $(this).is(':checked') ? 1 : 0;

        $.ajax({
            url: "{{ route('admin.subcategory.toggleStatus') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id: subcategoryId,
                status: status
            },
            success: function (response) {
				 toastr.options = {
					"closeButton": true,
					"progressBar": true,
					"timeOut": "3000",
					"extendedTimeOut": "1000",
					"positionClass": "toast-top-right"
				};
				toastr.success(response.message);
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