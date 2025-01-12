@extends('admin.layouts.app')
@section('content')
<!--begin::App Content Header-->
<div class="app-content-header">
  <!--begin::Container-->
  <div class="container-fluid">
    <!--begin::Row-->
    <div class="row">
      <div class="col-sm-6"><h3 class="mb-0">View Category</h3></div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">View Category</li>
        </ol>
      </div>
    </div>
    <!--end::Row-->
  </div>
  <!--end::Container-->
</div>
<!--end::App Content Header-->
<!--begin::App Content-->
<div class="app-content">
  <!--begin::Container-->
  <div class="container-fluid">
    <!--begin::Row-->
    <div class="row g-4">

      <!--begin::Col-->
      <div class="col-12">
        <!--begin::Quick Example-->
        <div class="card card-primary card-outline mb-4">
          <!--begin::Header-->
          <div class="card-header"><div class="card-title">Category Details</div></div>
          <!--end::Header-->
          <!--begin::Body-->
          <div class="card-body">
            <div class="mb-3">
              <label class="form-label"><strong>Name:</strong></label>
              <p>{{ $category->name }}</p>
            </div>

            <div class="mb-3">
              <label class="form-label"><strong>Parent Category:</strong></label>
              <p>{{ $category->parent->name ?? 'N/A' }}</p>
            </div>

            <div class="mb-3">
              <label class="form-label"><strong>Description:</strong></label>
              <p>{{ $category->description }}</p>
            </div>

            <div class="mb-3">
              <label class="form-label"><strong>Image:</strong></label>
              @if($category->image)
                <div>
                 
                    <img src="{{ asset('storage/'.$category->image) }}" alt="Category Image" class="img-thumbnail" style="max-width: 200px;">

                </div>
              @else
                <p>No Image Uploaded</p>
              @endif
            </div>

            <div class="mb-3">
              <label class="form-label"><strong>Status:</strong></label>
              <p>{{ ucfirst($category->status) }}</p>
            </div>
          </div>
          <!--end::Body-->

          <!--begin::Footer-->
          <div class="card-footer">
            <a href="{{ route('category.index') }}" class="btn btn-secondary">Back to Categories</a>
          </div>
          <!--end::Footer-->
        </div>
        <!--end::Quick Example-->


      </div>
      <!--end::Col-->
      <!--begin::Col-->

      <!--end::Col-->
    </div>
    <!--end::Row-->
  </div>
  <!--end::Container-->
</div>
<!--end::App Content-->
@endsection
