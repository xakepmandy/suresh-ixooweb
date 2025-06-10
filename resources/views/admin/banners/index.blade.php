@extends('admin.layouts.app')
@section('content')

	<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">List</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Banner List</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
							<a href="{{route('admin.banner.create')}}" class="btn btn-primary">Create New</a>
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
										<th>Title</th>
										<th>Image</th>
										<th>Description</th>
										<th>Status</th>
                                        <th>Action</th>
									</tr>
								</thead>
								<tbody>
                                    @If(count($banners) == 0)
                                    <tr>
                                        <td colspan="6" class="text-center">No Banners Found</td>
                                    </tr>
                                    @else
                                    @foreach($banners as $banner)
                                    <tr>
                                        <td>{{$banner->title}}</td>
                                        <td><img src="{{$banner->getImageUrlAttribute()}}" alt="{{$banner->title}}" width="100"></td>
                                        <td>{{ \Illuminate\Support\Str::words(strip_tags($banner->description), 5, '...') }}</td>

										<td>
											<div class="form-check form-switch">
												<input class="form-check-input toggle-status" type="checkbox" data-id="{{ $banner->id }}" {{ $banner->getStatusAttribute() == 'Active' ? 'checked' : '' }}>
											</div>
										</td>
                                        <td>
                                            <a href="{{route('admin.banner.edit',$banner->id)}}"><i class="bi bi-pencil-square"></i></a>
 											<a href="javascript:;"  onclick="confirmDelete({{ $banner->id }})"><i class="bi bi-trash2"></i></a>                                        </td>

                                    </tr>
									


                                    @endforeach
                                    @endif
								</tbody>
								<tfoot>
									<tr>
										<th>Title</th>
										<th>Image</th>
										<th>Description</th>
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
        var bannerId = $(this).data('id');
        var status = $(this).is(':checked') ? 1 : 0;

        $.ajax({
            url: "{{ route('admin.banner.toggleStatus') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id: bannerId,
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

	function confirmDelete(userId) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to delete this user!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "/admin/banner/delete/" + userId; 
        }
    });
}
</script>
@endsection