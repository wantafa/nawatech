@extends('backend.index')
@section('title', 'My Order')
@section('isi-konten')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">

    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Dashboard /</span> My Order
    </h4>

    <!-- Bordered Table -->
    <div class="card">
        <h5 class="card-header">My Order</h5>
        <div class="card-body">
            <div class="text-end mb-3">
                <a href="{{ route('export') }}" class="btn btn-success">Export</a>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered" id="my-datatable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>No Transaksi</th>
                            <th>Jenis Motor</th>
                            <th>Merek Motor</th>
                            <th>Jumlah</th>
                            <th>Total</th>
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


{{-- Delete Product Modal start --}}

<div class="modal custom-modal fade" id="delete_order" role="dialog">
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
            ajax: "{{ route('my_order.json') }}",
            columns: [
                {
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
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
                    data: "no_trx",
                    name: "no_trx"
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
                    data: "qty",
                    name: "qty"
                },
                {
                    data: "total",
                    name: "total"
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

        // delete Order
        $("#my-datatable").on("click", ".btn-delete", function(e) {
            e.preventDefault();
            const id = $(this).data("id");
            $('#delete_order #url-delete').attr('action', "{{ url('my_order') }}/"+id);

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
            // var myModal = new bootstrap.Modal(document.getElementById('delete_order'))
            // myModal.show()
        });

    });
</script>
@endpush
