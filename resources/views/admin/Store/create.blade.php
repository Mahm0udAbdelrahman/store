@extends('admin.layouts.app')
@section('content')
<!--begin::App Content Header-->
<div class="app-content-header">
  <!--begin::Container-->
  <div class="container-fluid">
    <!--begin::Row-->
    <div class="row">
      <div class="col-sm-6"><h3 class="mb-0">Create store</h3></div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Create store</li>
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
          <div class="card-header"><div class="card-title">Create store</div></div>
          <!--end::Header-->
          <!--begin::Form-->
          <form action="{{ route('store.store') }}" method="POST"  enctype="multipart/form-data">
            @csrf
            <!--begin::Body-->
            <div class="card-body">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">name</label>
                <input
                  type="text"
                  name="name"
                  class="form-control"
                  id="exampleInputEmail1"
                  aria-describedby="emailHelp"
                />

              </div>
              <div class="col-12 mb-3">
                <label   class="form-label">store</label>
                <select name="parent_id" class="form-select"  >
                  <option selected="" disabled="" value="">Choose...</option>
                  @foreach ($categories as $store)
                  <option value="{{ $store->id }}">{{ $store->name }}</option>
                  @endforeach
                </select>
                <div class="invalid-feedback">Please select a valid state.</div>
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Description</label>
                <textarea name="description" class="form-control" id="exampleInputPassword1" ></textarea>
              </div>
              <div class="input-group mb-3">
                <input type="file" name="image" class="form-control" id="inputGroupFile02" />
                <label class="input-group-text" for="inputGroupFile02">Upload</label>
              </div>
              <fieldset class="row mb-3">
                <legend class="col-form-label col-sm-2 pt-0">Status</legend>
                <div class="col-sm-10">
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="radio"
                      name="status"
                      id="gridRadios1"
                      value="active"
                      checked
                    />
                    <label class="form-check-label" for="gridRadios1"> Active </label>
                  </div>
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="radio"
                      name="status"
                      id="gridRadios2"
                      value="inactive"
                    />
                    <label class="form-check-label" for="gridRadios2"> Inactive </label>
                  </div>

                </div>
              </fieldset>
            </div>
            <!--end::Body-->
            <!--begin::Footer-->
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <!--end::Footer-->
          </form>
          <!--end::Form-->
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
