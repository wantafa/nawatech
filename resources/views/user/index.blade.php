@extends('backend.index')
@section('title', 'Data User')
@section('isi-konten')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">

    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Dashboard /</span> User
    </h4>

    <button class="btn btn-primary add-btn mb-3" data-toggle="modal" data-target="#modal_user"> <i class="bx bx-plus bx-xs"></i> Tambah</button>

    <!-- Bordered Table -->
    <div class="card">
        <h5 class="card-header">Data User</h5>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered" id="my-datatable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Divisi</th>
                            <th width="10">Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <!--/ Bordered Table -->
</div>
<!-- / Content -->

{{-- Modal start --}}

{{-- <div id="modal_user" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><span>Tambah</span> Risk Register</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                <form method="POST" action="">
                    @csrf
                    <input type="hidden" id="id" name="id">
                    <div class="form-group">
                        <label class="col-form-label">Nama<span class="text-danger">*</span></label>
                        <input class="form-control" id="nama" name="nama" type="text" required>
                    </div>
                    <div class="form-group mb-3">
                        <label class="col-form-label">Kategori<span class="text-danger">*</span></label>
                        <input class="form-control" id="kategori" name="kategori" type="text" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div class="modal fade" id="modal_user" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCenterTitle">Tambah User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('user.store') }}">
                @csrf
                <input type="hidden" id="id" name="id">
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <label for="nama" class="form-label">Nama Pengguna<span class="text-danger">*</span></label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Masukkan Nama Pengguna" required>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="xxxx@xxx.xx" required>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="divisi" class="form-label">Divisi</label>
                        <input type="text" id="divisi" name="divisi" class="form-control" placeholder="Masukkan Divisi">
                    </div>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button> --}}
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </form>
            <form method="POST" action="{{ route('ubah_pass') }}">
                @csrf
                @method('patch')

                <input type="hidden" id="id" name="id">
                <div class="col-md-12">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan Password">
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </form>
      </div>
    </div>
  </div>

{{-- Modal end --}}

{{-- Delete Job Modal start --}}

<div class="modal custom-modal fade" id="delete_pkpt" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLongTitle">Hapus</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <h4 class="text-center">Anda yakin ingin hapus?</h4>
                <div class="modal-btn delete-action">
                    <div class="row">
                        <div class="col-6">
                            <form method="POST" id="url-delete">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-primary continue-btn w-100" type="submit">Delete</button>
                            </form>
                        </div>
                        <div class="col-6">
                            <button type="button" data-dismiss="modal" class="btn btn-primary">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Delete Job Modal end --}}

{{-- modal end --}}
@endsection
@push ('page-scripts')
{{-- <script>
        var table = $("#my-datatable").DataTable();

</script> --}}

<script>
    $(document).ready(function() {
        var table = $("#my-datatable").DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('user.json') }}",
            columns: [
                {
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                },
                {
                    data: "name",
                    name: "name",
                    // render: function(data, type, row) {
                    //     var url = "{{ url('pkpt/risk-register') }}/"+row.id;
                    //     return `<a href="${url}">${data}</a>`;
                    // }
                },
                {
                    data: "email",
                    name: "email"
                },
                {
                    data: "divisi",
                    name: "divisi"
                },
                {
                    data: "action",
                    name: "action",
                    className: 'text-center'
                },
            ],
            order: [[ 0, "desc" ]]
        });

        table.on('draw.dt', function () {
            var info = table.page.info();
            table.column(0, {
                search: 'applied', order: 'applied', page: 'applied'
            }).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1 + info.start;
            });
        });

        // add user
        $('.add-btn').on('click', function(){            
            $('#modal_user .modal-title span').html('Tambah');
            $('#modal_user #id').val('');
            $('#modal_user form').trigger('reset');


            var myModal = new bootstrap.Modal(document.getElementById('modal_user'))
            myModal.show()
        });

        // edit user
        $("#my-datatable").on("click", ".btn-edit", function(e) {
            e.preventDefault();
            data = $(this).data();

            $.each(data, function(index, value){
                $('#modal_user #'+index).val(value);
            })

            $('#modal_user'+' .modal-title span').html('Edit');

            var myModal = new bootstrap.Modal(document.getElementById('modal_user'))
            myModal.show()
        });

        // delete user
        $("#my-datatable").on("click", ".btn-delete", function(e) {
            e.preventDefault();
            const id = $(this).data("id");
            $('#delete_pkpt #url-delete').attr('action', "{{ url('surat_masuk') }}/"+id);

    swal({
        title: 'Kamu Yakin Mau Hapus?',
        text: 'Jika di Hapus, Data akan hilang!',
        icon: 'warning',
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
        swal('Data Berhasil diHapus :)', {
          icon: 'success',
        });
        $(`#url-delete`).submit();
        } else {
        swal('Data Kamu Aman!');
        }
      });
            // var myModal = new bootstrap.Modal(document.getElementById('delete_pkpt'))
            // myModal.show()
        });

    });
</script>
@endpush
