@extends('admin.layouts.app')
@section('content')

	<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">List</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Teams List</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
							<a href="{{route('admin.team.create')}}" class="btn btn-primary">Create New</a>
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
										<th>Name</th>
										<th>Email</th>
										<th>Phone</th>
										<th>Position</th>
										<th>Status</th>
										<th>Image</th>
                                        <th>Action</th>
									</tr>
								</thead>
								<tbody>
                                    @If(count($teams) == 0)
                                    <tr>
                                        <td colspan="6" class="text-center">No Teams Found</td>
                                    </tr>
                                    @else
                                    @foreach($teams as $team)
                                    <tr>
                                        <td>{{$team->name}}</td>
                                        <td>{{$team->email}}</td>
                                        <td>{{$team->phone}}</td>
                                        <td>{{$team->position}}</td>
										<td>
											<div class="form-check form-switch">
												<input class="form-check-input toggle-status" type="checkbox" data-id="{{ $team->id }}" {{ $team->getStatusAttribute() == 'Active' ? 'checked' : '' }}>
											</div>
										</td>
										<td>
											@if($team->image)
											<img src="{{ $team->getImageUrlAttribute() }}" alt="Team Image" style="width: 50px; height: 50px; object-fit: cover;">
											@else
											No File
											@endif
                                        <td>
                                            <a href="{{route('admin.team.edit',$team->id)}}"><i class="bi bi-pencil-square"></i></a>
                                            <a href="{{route('admin.team.delete',$team->id)}}" onclick="return confirm('Are you sure you want to delete this team member?');"><i class="bi bi-trash2"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
								</tbody>
								<tfoot>
									<tr>
										<th>Name</th>
										<th>Email</th>
										<th>Phone</th>
										<th>Position</th>
										<th>Status</th>
										<th>Image</th>
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
        var teamId = $(this).data('id');
        var status = $(this).is(':checked') ? 1 : 0;

        $.ajax({
            url: "{{ route('admin.team.toggleStatus') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id: teamId,
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