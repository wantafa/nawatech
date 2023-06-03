@extends('backend.index')
@section('title', 'Data Product')
@section('isi-konten')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">

    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Dashboard /</span> Data Product
    </h4>

    <button class="btn btn-primary add-btn mb-3" data-toggle="modal" data-target="#modal_product"> <i class="bx bx-plus bx-xs"></i> Tambah</button>

    <!-- Bordered Table -->
    <div class="card">
        <h5 class="card-header">Data Product</h5>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered" id="my-datatable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Motor</th>
                            <th>Jenis Motor</th>
                            <th>Merek Motor</th>
                            <th>Foto</th>
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

<div class="modal fade" id="modal_product" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCenterTitle"><span>Tambah</span> Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="id" name="id">
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <label for="kd_motor" class="form-label">Kode Motor<span class="text-danger">*</span></label>
                        <input type="text" id="kd_motor" name="kd_motor" class="form-control" placeholder="Masukkan Kode Motor" required>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="jenis" class="form-label">Jenis Motor<span class="text-danger">*</span></label>
                        <input type="text" id="jenis" name="jenis" class="form-control" placeholder="Masukkan Jenis Motor" required>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="merek" class="form-label">Merek Motor<span class="text-danger">*</span></label>
                        <input type="text" id="merek" name="merek" class="form-control" placeholder="Masukkan Merek Motor" required>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="cc" class="form-label">CC Motor<span class="text-danger">*</span></label>
                        <input type="number" min="1" id="cc" name="cc" class="form-control" placeholder="Masukkan CC Motor" required>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="cc" class="form-label">Harga<span class="text-danger">*</span></label>
                        <input type="number" min="1" id="harga" name="harga" class="form-control" placeholder="Masukkan Harga" required>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="stok" class="form-label">Stok<span class="text-danger">*</span></label>
                        <input type="number" min="1" id="stok" name="stok" class="form-control" placeholder="Masukkan CC Motor" required>
                    </div>
                    <div class="col-md-12">
                        <label for="foto" class="form-label">Foto</label>
                        <input type="file" id="foto" name="foto" class="form-control">
                    </div>
                </div>
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


{{-- Modal Detail start --}}

<div class="modal fade" id="modal_product_detail" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Detail Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                        <table class="table table-border">
                                <tr>
                                    <td>Foto</td>
                                    <td>:</td>
                                    <td class="text-end" id="foto"></td>
                                </tr>
                                <tr>
                                    <td>Kode Motor</td>
                                    <td>:</td>
                                    <td class="text-end" id="kd_motor"></td>
                                </tr>
                                <tr>
                                    <td>Jenis Motor</td>
                                    <td>:</td>
                                    <td class="text-end" id="jenis"></td>
                                </tr>
                                <tr>
                                    <td>Merek Motor</td>
                                    <td>:</td>
                                    <td class="text-end" id="merek"></td>
                                </tr>
                                <tr>
                                    <td>CC</td>
                                    <td>:</td>
                                    <td class="text-end" id="cc"></td>
                                </tr>
                                <tr>
                                    <td>Stok</td>
                                    <td>:</td>
                                    <td class="text-end" id="stok"></td>
                                </tr>
                                <tr>
                                    <td>Harga</td>
                                    <td>:</td>
                                    <td class="text-end" id="harga"></td>
                                </tr>
                        </table>
                        
            </div>
        </div>
    </div>
</div>

{{-- modal end --}}


{{-- Delete Product Modal start --}}

<div class="modal custom-modal fade" id="delete_product" role="dialog">
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
                                <button class="btn btn-primary continue-btn w-100" type="submit">Hapus</button>
                            </form>
                        </div>
                        <div class="col-6">
                            <button type="button" data-dismiss="modal" class="btn btn-primary">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Delete Product Modal end --}}

{{-- modal end --}}
@endsection
@push ('page-scripts')

<script>
    $(document).ready(function() {
        var table = $("#my-datatable").DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('product.json') }}",
            columns: [
                {
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                },
                {
                    data: "kd_motor",
                    name: "kd_motor"
                },
                {
                    data: "jenis",
                    name: "jenis"
                },
                {
                    data: "merek",
                    name: "merek"
                },
                {
                    data: "foto",
                    name: "foto",
                    render: function(data, type, row) {
                    
                        var foto = "{{ url('/') }}" + '/' + row.foto;
                        return '<img src="' + foto + '"  width="80px">';
                    }
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

        // add Product
        $('.add-btn').on('click', function(){            
            $('#modal_product .modal-title span').html('Tambah');
            $('#modal_product #id').val('');
            $('#modal_product form').trigger('reset');


            var myModal = new bootstrap.Modal(document.getElementById('modal_product'))
            myModal.show()
        });

        // edit Product
        $("#my-datatable").on("click", ".btn-edit", function(e) {
            e.preventDefault();
            data = $(this).data();

            $.each(data, function(index, value){
                $('#modal_product #'+index).val(value);
            })

            $('#modal_product'+' .modal-title span').html('Edit');

            var myModal = new bootstrap.Modal(document.getElementById('modal_product'))
            myModal.show()
        });

         // detail Product

         $("#my-datatable").on("click", ".btn-detail", function(e) {
            e.preventDefault();
            data = $(this).data();
    
            $.each(data, function(index, value){

             if (index === 'foto') {
                
                var url = window.location.origin + '/' + value;
                var link = '<img src="' + url + '" width="100" >';

                    $('#modal_product_detail #'+index).html(link);

                } else {
                    $('#modal_product_detail #'+index).html(value);
                }
            })
            var myModal = new bootstrap.Modal(document.getElementById('modal_product_detail'))
            myModal.show()
            
        });

        // delete Product
        $("#my-datatable").on("click", ".btn-delete", function(e) {
            e.preventDefault();
            const id = $(this).data("id");
            $('#delete_product #url-delete').attr('action', "{{ url('product') }}/"+id);

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
            // var myModal = new bootstrap.Modal(document.getElementById('delete_product'))
            // myModal.show()
        });

    });
</script>
@endpush
