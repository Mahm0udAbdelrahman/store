@extends('admin.layouts.app')
@section('content')
<!--begin::App Content Header-->
<div class="app-content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6">
        <h3 class="mb-0">product Tables</h3>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">product Tables</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<!--end::App Content Header-->

<!--begin::App Content-->
<div class="app-content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header d-flex justify-content-between">
            <a href="{{ route('product.create') }}" class="btn btn-primary">
              <i class="las la-plus"></i> Create product
            </a>

          </div>
          <div class="card-body">
            <!-- Filter Form -->
            <form action="{{ URL::current() }}" method="get" class="d-flex gap-2 mb-3">
              <input
                type="text"
                name="name"
                value="{{ old('name', request('name')) }}"
                class="form-control"
                placeholder="Search by name"
              />
              <select name="status" class="form-select">
                <option value="" {{ old('status', request('status')) == '' ? 'selected' : '' }}>All</option>
                <option value="active" {{ old('status', request('status')) == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status', request('status')) == 'inactive' ? 'selected' : '' }}>Inactive</option>
              </select>
              <button class="btn btn-primary">
                <i class="las la-filter"></i> Filter
              </button>
            </form>

            <!-- Categories Table -->
            <table class="table table-bordered">
              <thead class="table-light">
                <tr>
                  <th style="width: 5%">#</th>
                  <th>Name</th>
                  <th>Parent</th>
                  <th>Description</th>
                  <th>Image</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($data as $product)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $product->name }}</td>
                  <td>{{ $product->parent->name ?? 'N/A' }}</td>
                  <td>{{ $product->description }}</td>
                  <td>
                    @if($product->image)
                      <img src="{{ asset('storage/'.$product->image) }}" alt="product Image" class="img-thumbnail" style="max-width: 100px;">
                    @else
                      <span class="text-muted">No Image Uploaded</span>
                    @endif
                  </td>
                  <td>
                    <span class="badge bg-{{ $product->status == 'active' ? 'success' : 'danger' }}">
                      {{ ucfirst($product->status) }}
                    </span>
                  </td>
                  <td>
                    <div class="d-flex gap-2">

                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModalrestore{{ $product->id }}">
                            <i class="fas fa-rotate-left"></i>
                          </button>

                      <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $product->id }}">
                        <i class="fa fa-trash"></i>
                      </button>
                    </div>
                  </td>
                </tr>

                <!-- Delete Confirmation Modal -->
                <div class="modal fade" id="deleteModalrestore{{ $product->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $product->id }}" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel{{ $product->id }}">Confirm Restoretion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        Are you sure you want to restore this product?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form method="POST" action="{{ route('cat.restore', $product->id) }}">
                          @csrf
                          <button type="submit" class="btn btn-success">restore</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Delete Confirmation Modal -->

                <!-- Delete Confirmation Modal -->
                <div class="modal fade" id="deleteModal{{ $product->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $product->id }}" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel{{ $product->id }}">Confirm Deletion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        Are you sure you want to delete this product?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form method="POST" action="{{ route('cat.forceDelete', $product->id) }}">
                          @csrf
                          @method('delete')
                          <button type="submit" class="btn btn-danger">forceDelete</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Delete Confirmation Modal -->
                @empty
                <tr>
                  <td colspan="7" class="text-center text-muted">No categories available</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
          <div class="card-footer clearfix">
            <div class="float-end">
              {{ $data->withQueryString()->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--end::App Content-->
@endsection
