@extends('admin.layouts.app')
@section('content')


@php
    $fileUrl = url('storage/contact_files/' . $contact->file);
    $extension = pathinfo($contact->file, PATHINFO_EXTENSION);
@endphp


<main class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
              {{-- <div class="breadcrumb-title pe-3">eCommerce</div> --}}
              <div class="ps-3">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Inquiry details</li> 
                  </ol>
                </nav>
              </div>
              <div class="ms-auto">
						<div class="btn-group">
							<a href="{{route('admin.contacts')}}" class="btn btn-primary"><i class="bi bi-arrow-return-left"> Back</i></a>
						</div>
					</div>
            </div>
            <!--end breadcrumb-->

              <div class="card">
                <div class="card-header py-3"> 
                  <div class="row g-3 align-items-center">
                    <div class="col-12 col-lg-4 col-md-6 me-auto">
                      <h5 class="mb-1">{{ \Carbon\Carbon::parse($contact->created_at)->format('D, M j, Y, g:iA') }}</h5>

                    </div>
                    {{-- <div class="col-12 col-lg-3 col-6 col-md-3">
                      <select class="form-select">
                        <option>Change Status</option>
                        <option>Awaiting Payment</option>
                        <option>Confirmed</option>
                        <option>Shipped</option>
                        <option>Delivered</option>
                      </select>
                    </div>
                    <div class="col-12 col-lg-3 col-6 col-md-3">
                       <button type="button" class="btn btn-primary">Save</button>
                       <button type="button" class="btn btn-secondary"><i class="bi bi-printer-fill"></i> Print</button>
                    </div> --}}
                  </div>
                 </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <h4 class="mb-4">Inquiry Details</h4>

                      <div class="row mb-2">
                        <div class="col-md-6">
                          <strong>Name:</strong> {{ $contact->name }}
                        </div>
                        <div class="col-md-6">
                          <strong>Email:</strong> {{ $contact->email }}
                        </div>
                      </div>

                      <div class="row mb-2">
                        <div class="col-md-6">
                          <strong>Phone:</strong> {{ $contact->phone }}
                        </div>
                        <div class="col-md-6">
                          <strong>Inquiry:</strong> {{ $contact->inquiry }}
                        </div>
                      </div>

                      <div class="row mb-2">
                        <div class="col-md-6">
                          <strong>Company:</strong> {{ $contact->company }}
                        </div>
                        <div class="col-md-6">
                          <strong>Message:</strong> {{ $contact->message }}
                        </div>
                      </div>

                      @if(!empty($contact->file))
                        @if(in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                            <!-- Image File -->
                            <img src="{{ $fileUrl }}" class="img-thumbnail mt-2" width="200" data-bs-toggle="modal" data-bs-target="#imageModal" style="cursor:pointer">

                            <!-- Modal for image -->
                            <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                  <div class="modal-body p-0">
                                    <img src="{{ $fileUrl }}" class="img-fluid w-100" alt="Full Image">
                                  </div>
                                </div>
                              </div>
                            </div>

                        @elseif(in_array(strtolower($extension), ['pdf','doc','docx']))
                            <!-- PDF File -->
                            <a href="{{ $fileUrl }}" target="_blank">
                                {{-- <img src="{{ $fileUrl }}" class="img-thumbnail mt-2" width="100" alt="{{$extension}}"> --}}
                                <p class="mt-1">Click to view {{$extension}}</p>
                            </a>
                        @endif
                      @endif

                    </div>
                  </div>
                </div>

              </div>

          </main>
          @endsection