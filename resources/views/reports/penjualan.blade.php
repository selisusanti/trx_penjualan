@php
    $headings = [
        'Nama Produk',
        'Nama Customer',
        'Tanggal Pengeluaran',
        'Quantity',
    ];
    $borderStyle = 'border: 1px solid black;';
@endphp

<table border="1" width="100%" style="{{ $borderStyle }}">
    <thead>
        <tr align="center">
            <th style="{{ $borderStyle }}">No</th>
            <th style="{{ $borderStyle }}">Nama Produk</th>
            <th style="{{ $borderStyle }}">Masa Suplier</th>
            <th style="{{ $borderStyle }}">Tanggal Pengeluaran</th>
            <th style="{{ $borderStyle }}">Quantity</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
            <tr>
                <td style="{{ $borderStyle }}">{{ $loop->iteration }}</td>
                <td style="{{ $borderStyle }}">{{ $data->product_id ?? '' }}</td>
                <td style="{{ $borderStyle }}">{{ $data->product_id ?? '' }}</td>
                <td style="{{ $borderStyle }}">{{ $data->product_id ?? '' }}</td>
                <td style="{{ $borderStyle }}">{{ $data->product_id ?? '' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
