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
								<li class="breadcrumb-item active" aria-current="page">Seo List</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
							<a href="{{route('admin.seo.create',$page->id)}}" class="btn btn-primary">Create New</a>
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
										<th>Seo Title</th>
										<th>Seo Url</th>
										<th>Seo Image</th>
										<th>Seo Keywords</th>
										<th>Seo Description</th>
                                        <th>Action</th>
									</tr>
								</thead>
								<tbody>
                                    @If(count($seo) == 0)
                                    <tr>
                                        <td colspan="6" class="text-center">No Seo Content Found</td>
                                    </tr>
                                    @else
                                    @foreach($seo as $seos)
                                    <tr>
                                        <td>{{$seos->seo_title}}</td>
                                        <td>{{$seos->seo_url}}</td>
                                        <td>@if(!empty($seos->seo_image))<img src="{{$seos->getSeoImageUrlAttribute()}}" alt="{{$seos->page_title}}" width="100">@endif</td>
										<td>{{$seos->seo_keywords}}</td>
                                        <td>{{ \Illuminate\Support\Str::words(strip_tags($seos->seo_description), 5, '...') }}
											<button type="button" class="btn btn-link p-0" data-bs-toggle="modal" data-bs-target="#seoModal{{ $seos->id }}">
												More
											</button>
										</td>
										
                                        <td>
                                            <a href="{{route('admin.seo.edit',$seos->id)}}"><i class="bi bi-pencil-square"></i></a>
                                            <a href="{{route('admin.seo.delete',$seos->id)}}" onclick="return confirm('Are you sure you want to delete this page?');"><i class="bi bi-trash2"></i></a>
                                        </td>

                                    </tr>
									
									<div class="modal fade" id="seoModal{{ $seos->id }}" tabindex="-1" aria-labelledby="seoModalLabel{{ $seos->id }}" aria-hidden="true">
										<div class="modal-dialog modal-dialog-centered modal-lg">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="seoModalLabel{{ $seos->id }}">Seo Details</h5>
													<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
												</div>
												<div class="modal-body">
													{!! $seos->seo_description !!}
												</div>
											</div>
										</div>
									</div>

                                    @endforeach
                                    @endif
								</tbody>
								<tfoot>
									<tr>
										<th>Seo Title</th>
										<th>Seo Url</th>
										<th>Seo Image</th>
										<th>Seo Description</th>
										<th>Seo Keywords</th>
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