<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <!-- Link CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
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
                <h1 class="checkout-title">Checkout</h1>
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

                <form method="POST" action="{{ route('user.payment_process', $data->order_id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Payment Method</label>
                        <select class="form-select" id="paymentMethod" onchange="updatePaymentDetails()" name="payment_method" required>
                            <option value="" selected disabled>Choose</option>
                            <option value="Transfer Bank BCA">Transfer Bank BCA : 377892536 a.n. Bakery</option>
                            <option value="E-Wallet">E-Wallet : 081265373426</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Payment Confirmation</label>
                        <input type="file" class="form-control" name="payment_confirmation" required>
                    </div>
                </div>
                
                <!-- Kolom Kanan -->
                <div class="col-md-6">
                    @foreach ($sales as $sale)
                    <div class="row mb-4">
                        <div class="col-4">
                            <img src="{{ asset('assets/product/' . $sale->product_image) }}" alt="{{ $sale->product_name }}" class="img-fluid">
                        </div>
                        <div class="col-8">
                            <h5>{{ $sale->product_name }}</h5>
                            <p>Qty: {{ $sale->quantity }}</p>
                            <p>Rp{{ number_format($sale->price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    @endforeach
                    
                    <div class="mb-3">
                        <label class="form-label">Subtotal Product: Rp{{ number_format($data->sub_total, 0, ',', '.') }}</label>
                    </div>
                    
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
                        <label class="form-label">Amount: Rp<span id="amount_value">{{ number_format($data->sub_total, 0, ',', '.') }}</span></label>
                    </div>

                    <input type="hidden" name="total_amount" id="hidden_total_amount" value="">
                    
                    <div class="center-button">
                        <button class="btn-pay-now" type="submit">Pay Now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Link JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            updateDeliveryFee();
        });

        function updateDeliveryFee() {
            const deliveryFee = parseInt(document.getElementById("delivery_fee").textContent.replace('.', '').replace(',', ''));
            const subTotal = {{ $data->sub_total }};
            const amountElement = document.getElementById("amount_value");
            const hiddenAmountInput = document.getElementById("hidden_total_amount");

            const totalAmount = subTotal + deliveryFee;
            amountElement.textContent = totalAmount.toLocaleString('id-ID');
            hiddenAmountInput.value = totalAmount;
        }

        function updatePaymentDetails() {
            const paymentMethod = document.getElementById("paymentMethod").value;
            const selectedPayment = document.getElementById("selectedPayment");
            selectedPayment.textContent = paymentMethod;
        }
    </script>
</body>

</html>