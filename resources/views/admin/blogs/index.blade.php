@extends('admin.layouts.app')
@section('content')
<style>
.modal-body {
    white-space: normal;       /* Paragraphs wrap honge */
    word-wrap: break-word;     /* Long words wrap honge */
    overflow-x: hidden;        /* Horizontal scrollbar hat jayega */
    line-height: 1.8;          /* Line spacing thoda better */
    padding: 30px;
    font-size: 16px;
    color: #444;
}

.modal-body p {
    margin-bottom: 20px;       /* Paragraph ke beech spacing */
    line-height: 1.8;
}

</style>
	<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">List</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Blogs List</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
							<a href="{{route('admin.blogs.create')}}" class="btn btn-primary">Create New</a>
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
                                    @If(count($blogs) == 0)
                                    <tr>
                                        <td colspan="6" class="text-center">No Blogs Found</td>
                                    </tr>
                                    @else
                                    @foreach($blogs as $blog)
                                    <tr>
                                        <td>{{$blog->title}}</td>
                                        <td><img src="{{$blog->getImageUrlAttribute()}}" alt="{{$blog->title}}" width="100"></td>
                                        <td>{{ \Illuminate\Support\Str::words(strip_tags($blog->description), 5, '...') }}
											 <button type="button" class="btn btn-link p-0" data-bs-toggle="modal" data-bs-target="#blogModal{{ $blog->id }}">
												More
											</button>
										</td>

                                        {{-- <td>{{$blog->getStatusLabelAttribute()}}</td> --}}
										<td>
											<div class="form-check form-switch">
												<input class="form-check-input toggle-status" type="checkbox" data-id="{{ $blog->id }}" {{ $blog->getStatusLabelAttribute() == 'Active' ? 'checked' : '' }}>
											</div>
										</td>
                                        <td>
                                            <a href="{{route('admin.blogs.edit',$blog->id)}}"><i class="bi bi-pencil-square"></i></a>
                                            <a href="{{route('admin.blogs.delete',$blog->id)}}" onclick="return confirm('Are you sure you want to delete this blog?');"><i class="bi bi-trash2"></i></a>
                                        </td>

                                    </tr>
									
									<div class="modal fade" id="blogModal{{ $blog->id }}" tabindex="-1" aria-labelledby="blogModalLabel{{ $blog->id }}" aria-hidden="true">
										<div class="modal-dialog modal-dialog-centered modal-lg">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="blogModalLabel{{ $blog->id }}">Blog Details</h5>
													<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
												</div>
												<div class="modal-body">
													{!! $blog->description !!}
												</div>
											</div>
										</div>
									</div>

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
        var blogId = $(this).data('id');
        var status = $(this).is(':checked') ? 1 : 0;

        $.ajax({
            url: "{{ route('admin.blogs.toggleStatus') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id: blogId,
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