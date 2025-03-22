@extends('layouts.admin')

@section('content')
<div class="order-list">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>User ID</th>
                <th>Order ID</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Payment Method</th>
                <th>Status</th>
                <th>More</th>
            </tr>
        </thead>
        <tbody>
            @php
            $displayedOrders = []; // Array untuk melacak order_id yang sudah ditampilkan
            $no = 1; // Variabel untuk nomor urut
        @endphp
        @foreach ($sales as $sale)
            @if (!in_array($sale->order_id, $displayedOrders))
                @php
                    $displayedOrders[] = $sale->order_id; // Tambahkan order_id ke array penanda
                @endphp
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $sale->user_id }}</td>
                    <td>{{ $sale->order_id }}</td>
                    <td>
                        @if ($sale->total_amount == null)
                            -
                        @else
                            Rp{{ number_format($sale->total_amount, 0, ',', '.') }}
                        @endif
                    </td>
                    <td>{{ $sale->total_quantity }}</td>
                    <td>
                        @if ($sale->payment_method == null)
                            -
                        @else
                            {{ $sale->payment_method }}
                        @endif
                    </td>
                    <td>
                        @if ($sale->status == 0)
                            <span class="badge-warning">Waiting For Payment</span>
                        @elseif ($sale->status == 1)
                            <span class="badge-success">Payment In Processed</span>
                        @elseif ($sale->status == 2)
                            <span class="badge-danger">Payment Failed</span>
                        @else
                            <span class="badge-success">Payment Completed</span>
                        @endif
                    </td>
                    <td>
                        @if ($sale->status == 0)
                            <span>-</span>
                        @elseif ($sale->status == 2)
                            <span>-</span>
                        @else
                            <button class="btn btn-primary"><a href="{{ route('admin.transaction_detail', ['order_id' => $sale->order_id]) }}" class="btn-action">Detail</a></button>
                        @endif
                    </td>
                </tr>
            @endif
        @endforeach
    </tbody>
</table>
@endsection