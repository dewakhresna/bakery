@extends('layouts.navbar_user')

@section('content')
<div class="order-list">
    <h2 class="text-center text-top">Order List</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Product ID</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Payment Method</th>
                <th>Payment Status</th>
                <th>Order Status</th>
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
                            <button class="btn btn-warning"><a href="{{ route('user.payment', ['order_id' => $sale->order_id])}}" class="btn-action">Make Payment</a></button>
                            <button class="btn btn-danger"><a href="{{ route('user.delete_payment', ['order_id' => $sale->order_id])}}" class="btn-action">Delete</a></button>
                        @elseif ($sale->status == 2)
                            <button class="btn btn-warning"><a href="{{ route('user.payment', ['order_id' => $sale->order_id])}}" class="btn-action">Retry Payment</a></button>
                            <button class="btn btn-danger"><a href="{{ route('user.delete_payment', ['order_id' => $sale->order_id])}}" class="btn-action">Delete</a></button>
                        @elseif ($sale->status == 3)
                            <span class="badge-info">Preparing Your Order</span>
                        @elseif ($sale->status == 4)
                            <span class="badge-info">Order In Transit</span>
                        @elseif ($sale->status == 5)
                            <span class="badge-info">Order Delivered</span>
                        @else
                            <span>-</span>
                        @endif
                    </td>
                </tr>
            @endif
        @endforeach
    </tbody>
</table>
@endsection