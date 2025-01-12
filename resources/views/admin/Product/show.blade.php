@extends('admin.layouts.app')
@section('content')
<!--begin::App Content Header-->
<div class="app-content-header">
  <!--begin::Container-->
  <div class="container-fluid">
    <!--begin::Row-->
    <div class="row">
      <div class="col-sm-6"><h3 class="mb-0">View product</h3></div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">View product</li>
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
          <div class="card-header"><div class="card-title">product Details</div></div>
          <!--end::Header-->
          <!--begin::Body-->
          <div class="card-body">
            <div class="mb-3">
              <label class="form-label"><strong>Name:</strong></label>
              <p>{{ $product->name }}</p>
            </div>

            <div class="mb-3">
              <label class="form-label"><strong>Parent product:</strong></label>
              <p>{{ $product->parent->name ?? 'N/A' }}</p>
            </div>

            <div class="mb-3">
              <label class="form-label"><strong>Description:</strong></label>
              <p>{{ $product->description }}</p>
            </div>

            <div class="mb-3">
              <label class="form-label"><strong>Image:</strong></label>
              @if($product->image)
                <div>

                    <img src="{{ asset('storage/'.$product->image) }}" alt="product Image" class="img-thumbnail" style="max-width: 200px;">

                </div>
              @else
                <p>No Image Uploaded</p>
              @endif
            </div>
            <div class="mb-3">
                <label class="form-label"><strong>Tags:</strong></label>
                @if($product->tags->isNotEmpty())
                  <p>
                    @foreach($product->tags as $tag)
                      <span class="badge bg-primary">{{ $tag->name }}</span>
                    @endforeach
                  </p>
                @else
                  <p>No Tags Assigned</p>
                @endif
              </div>

            <div class="mb-3">
              <label class="form-label"><strong>Status:</strong></label>
              <p>{{ ucfirst($product->status) }}</p>
            </div>
          </div>
          <!--end::Body-->

          <!--begin::Footer-->
          <div class="card-footer">
            <a href="{{ route('product.index') }}" class="btn btn-secondary">Back to Categories</a>
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
