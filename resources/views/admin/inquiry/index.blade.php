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
								<li class="breadcrumb-item active" aria-current="page">Inquiry List</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
							<a href="{{route('admin.contacts.create')}}" class="btn btn-primary">Create New</a>
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
										<th>inquiry</th>
										<th>Company</th>
										<th>Status</th>
										<th>File</th>
										<th>Message</th>
                                        <th>Action</th>
									</tr>
								</thead>
								<tbody>
                                    @If(count($contacts) == 0)
                                    <tr>
                                        <td colspan="9" class="text-center">No Contacts Found</td>
                                    </tr>
                                    @else
                                    @foreach($contacts as $contact)
                                    <tr>
                                        <td>{{$contact->name}}</td>
                                        <td>{{$contact->email}}</td>
                                        <td>{{$contact->phone}}</td>
                                        <td>{{$contact->inquiry}}</td>
                                        <td>{{$contact->company}}</td>
										<td>{{$contact->getStatusAttribute()}}</td>
										
											@php
												$extension = strtoupper(pathinfo($contact->file, PATHINFO_EXTENSION));
											@endphp
										<td>@if(!empty($contact->file))
												@if(in_array(strtolower($extension), ['jpg','jpeg','png','gif']))
													@if($contact->image_url)
														<img src="{{ $contact->image_url }}" class="img-thumbnail mt-2" width="100" alt="Image File">
													@endif

												@elseif(in_array(strtolower($extension), ['pdf','doc','docx']))
													<p class="mt-2 text-muted">{{ $extension }} File</p>
												@endif
											@else
												No file
											@endif
										</td>
                                        <td>{{ \Illuminate\Support\Str::words(strip_tags($contact->message), 5, '...') }}
											 <button type="button" class="btn btn-link p-0" data-bs-toggle="modal" data-bs-target="#blogModal{{ $contact->id }}">
												More
											</button>
										</td>

                                        <td>
                                            <a href="{{route('admin.contacts.view',$contact->id)}}"><i class="bi bi-eye"></i></a>
                                            <a href="{{route('admin.contacts.delete',$contact->id)}}" onclick="return confirm('Are you sure you want to delete this inquiry?');"><i class="bi bi-trash2"></i></a>
											<a href="{{route('admin.contacts.reply',$contact->id)}}"><i class="bi bi-reply" style="transform: rotateY(180deg);"></i></a>
                                        </td>

                                    </tr>
									<div class="modal fade" id="blogModal{{ $contact->id }}" tabindex="-1" aria-labelledby="blogModalLabel{{ $contact->id }}" aria-hidden="true">
										<div class="modal-dialog modal-dialog-centered modal-lg">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="blogModalLabel{{ $contact->id }}">Message</h5>
													<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
												</div>
												<div class="modal-body">
													{!! $contact->message !!}
												</div>
											</div>
										</div>
									</div>

                                    @endforeach
                                    @endif
								</tbody>
								<tfoot>
									<tr>
										<th>Name</th>
										<th>Email</th>
										<th>Phone</th>
										<th>inquiry</th>
										<th>Company</th>
										<th>Status</th>
										<th>File</th>
										<th>Message</th>
                                        <th>Action</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
@endsection