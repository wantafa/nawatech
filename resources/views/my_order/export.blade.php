<table>
    <thead>
    <tr>
        <th>No</th>
        <th>Nomor Transaksi</th>
        <th>Jenis Motor</th>
        <th>Merek Motor</th>
        <th>Jumlah</th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody>
        @foreach($order as $item)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item->no_trx }}</td>
                <td>{{ $item->jenis }}</td>
                <td>{{ $item->merek }}</td>
                <td>{{ $item->qty }}</td>
                <td>{{ $item->total }}</td>
            </tr>
        @endforeach
    </tbody>
</table>