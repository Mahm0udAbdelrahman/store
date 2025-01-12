@extends('admin.layouts.app')
@section('content')
<!--begin::App Content Header-->
<div class="app-content-header">
  <!--begin::Container-->
  <div class="container-fluid">
    <!--begin::Row-->
    <div class="row">
      <div class="col-sm-6"><h3 class="mb-0">Create product</h3></div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Create product</li>
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
          <div class="card-header"><div class="card-title">Create product</div></div>
          <!--end::Header-->
          <!--begin::Form-->
          <form action="{{ route('product.update',$product->id) }}" method="POST"  enctype="multipart/form-data">
            @csrf
            @method('put')
            <!--begin::Body-->
            <div class="card-body">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">name</label>
                <input
                  type="text"
                  name="name"
                  value="{{ $product->name }}"
                  class="form-control"
                  id="exampleInputEmail1"
                  aria-describedby="emailHelp"
                />

              </div>
              <div class="col-12 mb-3">
                <label   class="form-label">product</label>
                <select name="category_id" class="form-select"  >
                  <option selected="" disabled="" value="">Choose...</option>
                  @foreach ($categories as $cat)
                  <option @selected($cat->id == $product->category_id) value="{{ $cat->id }}">{{ $cat->name }}</option>
                  @endforeach
                </select>
                <div class="invalid-feedback">Please select a valid state.</div>
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Description</label>
                <textarea name="description" class="form-control" id="exampleInputPassword1" >{{ $cat->description }}</textarea>
              </div>
              <div class="input-group mb-3">
                <input type="file" name="image" class="form-control" id="inputGroupFile02" />
                <label class="input-group-text" for="inputGroupFile02">Upload</label>
              </div>
              @if($product->image)
              <img src="{{ asset('storage/'.$product->image) }}" alt="product Image" class="img-thumbnail" style="max-width: 200px;">
              @endif

              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">price</label>
                <input type="text" name="price" value="{{ $product->price }}" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp" />

            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">compare_price</label>
                <input type="text" name="compare_price" value="{{ $product->compare_price }}" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp" />

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
                            {{ old('status', $product->status ?? '') == 'active' ? 'checked' : '' }}
                        />
                        <label class="form-check-label" for="gridRadios1">Active</label>
                    </div>
                    <div class="form-check">
                        <input
                            class="form-check-input"
                            type="radio"
                            name="status"
                            id="gridRadios2"
                            value="draft"
                            {{ old('status', $product->status ?? '') == 'draft' ? 'checked' : '' }}
                        />
                        <label class="form-check-label" for="gridRadios2">Draft</label>
                    </div>
                    <div class="form-check">
                        <input
                            class="form-check-input"
                            type="radio"
                            name="status"
                            id="gridRadios2"
                            value="inactive"
                            {{ old('status', $product->status ?? '') == 'inactive' ? 'checked' : '' }}
                        />
                        <label class="form-check-label" for="gridRadios2">Inactive</label>
                    </div>


                </div>
            </fieldset>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">tags</label>
                <input
                  type="text"
                  name="tags"
                  value="{{ $product->tags->pluck('name') }}"
                  class="form-control"
                  id="exampleInputEmail1"
                  aria-describedby="emailHelp"
                />

              </div>

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
@push('style')
<link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />

@endpush
@push('js')
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
<script>
    var inputElem = document.querySelector('[name=tags]')
    tagify = new Tagify(inputElem);
</script>
@endpush
@endsection
