@extends('backend.index')
@section('title', 'Profil')
@section('isi-konten')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">

    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Dashboard /</span> Profil
    </h4>

    <div class="row">
        <div class="col-md-12">
          <div class="card mb-4">
            <h5 class="card-header">Profile Details</h5>
            <!-- Account -->
            <div class="card-body">
              <div class="d-flex align-items-start align-items-sm-center gap-4">
                <img
                  src="{{ $profil->image }}"
                  alt="user-avatar"
                  class="d-block rounded"
                  height="100"
                  width="100"
                  id="uploadedAvatar"
                />
                <form id="formAccountSettings" method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
                    @csrf
                <div class="button-wrapper">
                  <label for="image" class="btn btn-primary me-2 mb-4" tabindex="0">
                    <span class="d-none d-sm-block">Upload new photo</span>
                    <i class="bx bx-upload d-block d-sm-none"></i>
                    <input
                      type="file"
                      id="image"
                      {{-- class="account-file-input" --}}
                      hidden
                      name="image"
                      {{-- accept="image/png, image/jpeg" --}}
                    />
                  </label>
                  {{-- <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                    <i class="bx bx-reset d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Reset</span>
                  </button> --}}

                  <p class="text-muted mb-0">Allowed JPG or PNG.</p>
                </div>
              </div>
            </div>
            <hr class="my-0" />
            <div class="card-body">
                <div class="row">
                  <div class="mb-3 col-md-6">
                    <input type="text" id="id" name="id" value="{{ $profil->id }}" hidden>
                    <label for="name" class="form-label">Nama</label>
                    <input
                      class="form-control"
                      type="text"
                      id="name"
                      name="name"
                      value="{{ $profil->name }}"
                      autofocus
                    />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="email" class="form-label">E-mail</label>
                    <input
                      class="form-control"
                      type="email"
                      id="email"
                      name="email"
                      value="{{ $profil->email }}"
                      placeholder="xxx@xxx.xxx"
                    />
                  </div>
                </div>
                <div class="mt-2">
                  <button type="submit" class="btn btn-primary me-2">Save changes</button>
                  <a href="/" class="btn btn-outline-secondary">Cancel</a>
                </div>
              </form>
            </div>
            <!-- /Account -->
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="card mb-4">
            <h5 class="card-header">Ubah Password</h5>
            <!-- Account -->
            <div class="card-body">
              <form id="formAccountSettings" method="POST" action="{{ route('ubah_pass') }}">
                @csrf
                @method('patch')

                <div class="row">
                  <input type="text" id="id" name="id" value="{{ $profil->id }}" hidden>
                  <div class="mb-3 col-md-6">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" value="" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    />
                  </div>
                </div>
                <div class="mt-2">
                  <button type="submit" class="btn btn-primary me-2">Save changes</button>
                  <a href="/" class="btn btn-outline-secondary">Cancel</a>
                </div>
              </form>
            </div>
            <!-- /Account -->
          </div>
        </div>
      </div>
    </div>
    <!-- / Content -->
</div>
<!-- / Content -->
@endsection
@push ('page-scripts')
<script>
        var table = $("#my-datatable").DataTable();

</script>
@endpush
