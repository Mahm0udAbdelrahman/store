@extends('admin.layouts.app')
@section('content')
<!--begin::App Content Header-->
<div class="app-content-header">
  <!--begin::Container-->
  <div class="container-fluid">
    <!--begin::Row-->
    <div class="row">
      <div class="col-sm-6"><h3 class="mb-0">Create user</h3></div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Create user</li>
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
          <div class="card-header"><div class="card-title">Create user</div></div>
          <!--end::Header-->
          <!--begin::Form-->
          <form action="{{ route('user.profile.update',$user->id) }}" method="POST"  enctype="multipart/form-data">
            @csrf
            @method('put')
            <!--begin::Body-->
            <div class="card-body">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">first name</label>
                <input
                  type="text"
                  name="first_name"
                  value="{{ old('first_name',$user->first_name) }}"
                  class="form-control"
                  id="exampleInputEmail1"
                  aria-describedby="emailHelp"
                />

              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">last name</label>
                <input
                  type="text"
                  name="last_name"
                  value="{{ $user->last_name }}"
                  class="form-control"
                  id="exampleInputEmail1"
                  aria-describedby="emailHelp"
                />

              </div>

              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">birthday</label>
                <input
                  type="date"
                  name="birthday"
                  value="{{ $user->birthday }}"
                  class="form-control"
                  id="exampleInputEmail1"
                  aria-describedby="emailHelp"
                />

              </div>

              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Street Address</label>
                <input
                  type="text"
                  name="street_address"
                  value="{{ $user->street_address }}"
                  class="form-control"
                  id="exampleInputEmail1"
                  aria-describedby="emailHelp"
                />

              </div>

              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">city</label>
                <input
                  type="text"
                  name="city"
                  value="{{ $user->city }}"
                  class="form-control"
                  id="exampleInputEmail1"
                  aria-describedby="emailHelp"
                />

              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">state</label>
                <input
                  type="text"
                  name="state"
                  value="{{ $user->state }}"
                  class="form-control"
                  id="exampleInputEmail1"
                  aria-describedby="emailHelp"
                />

              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Postal Code</label>
                <input
                  type="text"
                  name="postal_code"
                  value="{{ $user->postal_code }}"
                  class="form-control"
                  id="exampleInputEmail1"
                  aria-describedby="emailHelp"
                />

              </div>
              <div class="col-12 mb-3">
                <label class="form-label">Country</label>
                <select name="country" class="form-select">
                    <option selected="" disabled="" value="">Choose...</option>
                    @foreach ($countries as $coun)
                        <option value="{{ $coun }}" {{ old('country', $user->country ?? '') == $coun ? 'selected' : '' }}>
                            {{ $coun }}
                        </option>
                    @endforeach
                </select>
                <div class="invalid-feedback">Please select a valid country.</div>
            </div>


              <div class="col-12 mb-3">
                <label   class="form-label">locale</label>
                <select name="locale" class="form-select"  >
                  <option selected="" disabled="" value="">Choose...</option>
                  @foreach ($languages as $lang)
                  <option  value="{{ $lang }}" {{ old('locale', $user->locale ?? '') == $lang ? 'selected' : '' }}  >{{ $lang }}</option>
                  @endforeach
                </select>
                <div class="invalid-feedback">Please select a valid state.</div>
              </div>


              <fieldset class="row mb-3">
                <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input
                            class="form-check-input"
                            type="radio"
                            name="gender"
                            id="gridRadios1"
                            value="male"
                            {{ old('gender', $user->gender ?? '') == 'male' ? 'checked' : '' }}
                        />
                        <label class="form-check-label" for="gridRadios1">male</label>
                    </div>
                    <div class="form-check">
                        <input
                            class="form-check-input"
                            type="radio"
                            name="gender"
                            id="gridRadios2"
                            value="female"
                            {{ old('gender', $user->gender ?? '') == 'female' ? 'checked' : '' }}
                        />
                        <label class="form-check-label" for="gridRadios2">female</label>
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
