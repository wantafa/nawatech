<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets') }}/css/cart.css" />
@include('backend.template.link')

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<div class="card">
    <div class="row">
        <div class="col-md-8 cart">
            <div class="title">
                <div class="row">
                    <div class="col"><h4><b>Cart</b></h4></div>
                    <div class="col align-self-center text-end text-muted">{{ $cart->count() }} items</div>
                </div>
            </div>    
            <form action="{{ route('proses_checkout') }}" method="POST">
            @csrf
            @foreach ($cart as $item)
                <div class="row border-top border-bottom">
                    <div class="row main align-items-center">
                        <div class="col-2"><img class="img-fluid" src="{{ $item->foto }}"></div>
                        <div class="col">
                            <div class="row text-muted">{{ $item->merek }}</div>
                            <div class="row">{{ $item->jenis }}</div>
                        </div>
                        <div class="col">
                            <input type="number" class="form-control form-control-sm qty-input" min="1" style="width: 60px;" name="qty[]" data-product-id="{{ $item->product_id }}" data-harga="{{ $item->harga }}" value="{{ $item->qty }}">
                        </div>
                        <input type="text" name="id[]" value="{{ $item->id }}" hidden>
                        <input type="text" name="product_id[]" value="{{ $item->product_id }}" hidden>
                        
                        <div class="col total">{{ $item->harga * $item->qty }} </div>
                        <div class="col">

                            {{-- <form id="hapus{{ $item->id }}" action="{{ route('cart.hapus', $item->id) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="button" onclick="hapusCartItem('hapus{{ $item->id }}');">Hapus</button>
                            </form> --}}

                            {{-- <form action="{{route('cart.hapus', $item->id)}}" method="post" onsubmit="return confirm('Anda yakin mau hapus ?');" style="display: inline-block;">
                                @method('DELETE')
                                @csrf          
                                 <button type="submit"><i class="bx bxs-trash"></i></button>
                              </form> --}}
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="back-to-shop"><a href="order/product">&leftarrow;</a><span class="text-muted">Back to shop</span></div>
        </div>
        <div class="col-md-4 summary">
            <div><h5><b>Summary</b></h5></div>
            <hr>
            <div class="row">
                <div class="col">ITEMS {{ $cart->count() }}</div>
            </div>
            <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                <div class="col">TOTAL PRICE</div>
                <div class="col text-end total-price"></div>
                <input type="text" id="total" name="total" hidden>
            </div>
            <button class="btn btn-dark" type="submit">CHECKOUT</button>
        </div>
    </form>
    </div>
</div>

@include('backend.template.script')
<script>
    $(document).ready(function () {
        const qty_input = document.querySelectorAll('.qty-input');
        const total_price = document.querySelector('.total-price');

        qty_input.forEach(function (input) {
            input.addEventListener('input', function () {
                const qty = parseInt(input.value);
                const harga = parseInt($(this).data('harga'));
                const total = input.closest('.row').querySelector('.total');
                const total_item = qty * harga;

                total.textContent = total_item;

                hitung_total_price();

                var product_id = $(this).data('product-id');
                
                $.ajax({
                    url: '/proses/cart',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        product_id: product_id,
                        qty: qty,
                        cart: 'cart'
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {

                        console.log('Berhasil');
                    },
                    error: function(xhr, status, error) {
                        console.log('Gagal');
                    }
                });
            });
        });
                hitung_total_price();

        function hitung_total_price() {
            let total_semua = 0;

            qty_input.forEach(function (input) {
                const qty = parseInt(input.value);
                const harga = parseInt($(input).data('harga'));
                const total = qty * harga;
                total_semua += total;
            });

            total_price.textContent = total_semua;
            $('#total').val(total_semua);

        }

    });
    
    // function hapusCartItem(formId) {
    //     document.getElementById('hapus4').submit();
    // }
</script>
