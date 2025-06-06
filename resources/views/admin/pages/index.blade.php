@extends('admin.layouts.app')
@section('content')
<style>
.modal-body {
    white-space: normal;      
    word-wrap: break-word;     
    overflow-x: hidden;        
    line-height: 1.8;          
    padding: 30px;
    font-size: 16px;
    color: #444;
}

.modal-body p {
    margin-bottom: 20px;       
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
								<li class="breadcrumb-item active" aria-current="page">Pages List</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
							<a href="{{route('admin.pages.create')}}" class="btn btn-primary">Create New</a>
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
										<th>Page Title</th>
										<th>Page Hadding</th>
										<th>Image</th>
										<th>Content</th>
										<th>Status</th>
                                        <th>Action</th>
									</tr>
								</thead>
								<tbody>
                                    @If(count($pages) == 0)
                                    <tr>
                                        <td colspan="6" class="text-center">No Pages Found</td>
                                    </tr>
                                    @else
                                    @foreach($pages as $page)
                                    <tr>
                                        <td>{{$page->page_hedding}}</td>
                                        <td>{{$page->page_title}}</td>
                                        <td>@if(!empty($page->image))<img src="{{$page->getImageUrlAttribute()}}" alt="{{$page->page_title}}" width="100">@endif</td>
                                        <td>{{ \Illuminate\Support\Str::words(strip_tags($page->content), 5, '...') }}
											 <button type="button" class="btn btn-link p-0" data-bs-toggle="modal" data-bs-target="#pageModal{{ $page->id }}">
												More
											</button>
										</td>
										<td>
											<div class="form-check form-switch">
												<input class="form-check-input toggle-status" type="checkbox" data-id="{{ $page->id }}" {{ $page->getStatusLabelAttribute() == 'Active' ? 'checked' : '' }}>
											</div>
										</td>
                                        <td>
                                            <a href="{{route('admin.pages.edit',$page->id)}}"><i class="bi bi-pencil-square"></i></a>
                                            <a href="{{route('admin.pages.delete',$page->id)}}" onclick="return confirm('Are you sure you want to delete this page?');"><i class="bi bi-trash2"></i></a>
                                            <a href="{{route('admin.seo.create',$page->id)}}"><i class="bi bi-search">SEO</i></a>
                                        </td>

                                    </tr>
									
									<div class="modal fade" id="pageModal{{ $page->id }}" tabindex="-1" aria-labelledby="pageModalLabel{{ $page->id }}" aria-hidden="true">
										<div class="modal-dialog modal-dialog-centered modal-lg">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="blogModalLabel{{ $page->id }}">Page Details</h5>
													<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
												</div>
												<div class="modal-body">
													{!! $page->content !!}
												</div>
											</div>
										</div>
									</div>

                                    @endforeach
                                    @endif
								</tbody>
								<tfoot>
									<tr>
										<th>Page Title</th>
										<th>Page Hadding</th>
										<th>Image</th>
										<th>Content</th>
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
            url: "{{ route('admin.pages.toggleStatus') }}",
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