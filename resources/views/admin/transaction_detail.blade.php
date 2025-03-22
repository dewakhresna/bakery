<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .payment-confirmation-wrapper button {
            width: 100%;
            max-width: 700px; 
            font-size: 1rem; 
            border-radius: 5px; 
        }

        .product-image {
            width: 100%; 
            height: 150px; 
            object-fit: cover; 
            border-radius: 5px; 
            border: 1px solid #ddd; 
        }

        .btn-pay-now {
            background-color: #7f4b5e;
            color: white;
            font-size: 1rem;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            padding: 12px 24px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-pay-now:hover {
            background-color: #693e4e;
        }

        .center-button {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100px;
        }
    </style>
</head>

<body>
    <div class="container my-4">
        <div class="row">
            <div class="col-12 text-center mb-4">
                <h3 class="checkout-title" style="color: #8a4a4a">Transaction Detail</h3>
                <hr>
            </div>
        </div>

        <div class="row">
            <!-- Kolom Kiri -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <div class="form-control bg-light">{{ $user->username }}</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Telepon</label>
                    <div class="form-control bg-light">{{ $user->phone }}</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <div class="form-control bg-light">
                        {{ $user->detailed_address . ', ' . $user->address }}
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Payment Method</label>
                    <input type="text" class="form-control" name="payment_method" value="{{ $data->payment_method }}" disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label payment-confirmation">Payment Confirmation</label>
                    <div class="payment-confirmation-wrapper">
                        <button class="btn btn-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#paymentConfirmationModal"
                            data-payment-method="{{ asset('assets/payment/' . $data->payment_confirmation) }}">
                            Open Image
                        </button>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Payment Status</label>
                    @if ($data->status == 0)
                        <span class="form-control bg-warning text-dark">Payment Pending</span>
                    @elseif ($data->status == 1)
                        <span class="form-control bg-warning text-dark">Payment In Processed</span>
                    @elseif ($data->status == 2)
                        <span class="form-control bg-danger">Payment Failed</span>
                    @else
                        <span class="form-control bg-success">Payment Completed</span>
                    @endif
                </div>

                <div class="mb-3">
                    <label class="form-label">Order Status</label>
                    @if ($data->status == 0)
                        <input type="text" id="status" class="form-control" value="-" readonly>
                    @elseif ($data->status == 1)
                        <input type="text" id="status" class="form-control" value="-" readonly>
                    @elseif ($data->status == 2)
                        <input type="text" id="status" class="form-control" value="-" readonly>
                    @else
                        <select name="status" class="form-select" id="">
                            <option value="3" @if($data->status == 3) selected @endif>Preparing Order</option>
                            <option value="4" @if($data->status == 4) selected @endif>Order In Transit</option>
                            <option value="5" @if($data->status == 5) selected @endif>Order Delivered</option>
                        </select>
                    @endif
                </div>
            </div>

            <!-- Kolom Kanan -->
            <div class="col-md-6">
                @foreach ($sales as $sale)
                <div class="row mb-4">
                    <div class="col-4">
                        <img src="{{ asset('assets/product/' . $sale->product_image) }}" alt="{{ $sale->product_name }}" class="img-fluid product-image">
                    </div>
                    <div class="col-8">
                        <h5>{{ $sale->product_name }}</h5>
                        <p>Qty: {{ $sale->quantity }}</p>
                        <p>Rp{{ number_format($sale->price, 0, ',', '.') }}</p>
                    </div>
                </div>
                @endforeach

                <div class="mb-3">
                    @if ($user->address == "North Jakarta")
                    <label class="form-label">Delivery Fee: Rp<span id="delivery_fee">25.000</span></label>
                    @elseif ($user->address == "East Jakarta")
                    <label class="form-label">Delivery Fee: Rp<span id="delivery_fee">15.000</span></label>
                    @elseif ($user->address == "West Jakarta")
                    <label class="form-label">Delivery Fee: Rp<span id="delivery_fee">20.000</span></label>
                    @elseif ($user->address == "Central Jakarta")
                    <label class="form-label">Delivery Fee: Rp<span id="delivery_fee">15.000</span></label>
                    @elseif ($user->address == "South Jakarta")
                    <label class="form-label">Delivery Fee: Rp<span id="delivery_fee">10.000</span></label>
                    @endif
                </div>

                <div class="mb-3">
                    <label class="form-label">Sub Total: Rp<span>{{ number_format($data->sub_total, 0, ',', '.') }}</span></label>
                </div>

                <div class="mb-3">
                    <label class="form-label">Amount: Rp<span>{{ number_format($data->total_amount, 0, ',', '.') }}</span></label>
                </div>
                <div class="center-button">
                    <button class="btn-pay-now" type="submit">Save</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="paymentConfirmationModal" tabindex="-1" aria-labelledby="paymentConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentConfirmationModalLabel">Payment Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="" id="paymentConfirmationImage" class="img-fluid">
                    <div class="d-flex justify-content-between mt-3">
                        <form method="POST" action="{{ route('admin.transaction_accept', ['order_id' => $data->order_id])}}">
                            @csrf
                            <input type="hidden" name="order_id" value="{{ $data->order_id }}">
                            @foreach ($sales as $sale)
                                <input type="hidden" name="product_id[]" value="{{ $sale->product_id }}">
                                <input type="hidden" name="quantity[]" value="{{ $sale->quantity }}">
                            @endforeach
                            <button class="btn btn-primary" @if ($data->status == 3) disabled @endif>Accept Payment</button>
                        </form>
                        <form action="{{ route('admin.transaction_decline', ['order_id' => $data->order_id])}}">
                            @csrf
                            <button class="btn btn-danger" @if ($data->status == 3) disabled @endif>Decline Payment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.btn-primary').forEach(button => {
            button.addEventListener('click', function () {
                const paymentMethod = this.getAttribute('data-payment-method');
                const paymentConfirmationImage = document.getElementById('paymentConfirmationImage');
                paymentConfirmationImage.src = paymentMethod;
            });
        });
    </script>
</body>

</html>