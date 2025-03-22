<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cart</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
    rel="stylesheet"
  >
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f8f9fa;
    }
    .checkout-card {
      background-color: #fff;
    }
    .checkout-header {
      border-bottom: 1px solid #ddd;
      padding: 1rem 1.5rem;
      font-size: 1.25rem;
      color: #8a4a4a;
      font-weight: bold;
      position: relative; /* Untuk menempatkan elemen di posisi relatif */
      text-align: center; /* Memusatkan teks span */
    }

    .checkout-header span {
      display: inline-block; /* Agar teks berada di tengah dengan flex parent */
    }

    .checkout-header button {
      position: absolute; /* Menempatkan button di pojok kanan */
      right: 1.5rem; /* Jarak dari kanan */
      top: 50%; /* Pusatkan secara vertikal */
      transform: translateY(-50%); /* Koreksi posisi */
      background: none;
      border: none;
      font-size: 1.5rem;
      color: #000;
    }

    .item {
      display: flex;
      align-items: center;
      padding: 1rem 1.5rem;
      border-bottom: 1px solid #ddd;
    }
    .item:last-child {
      border-bottom: none;
    }

    .check-box {
      margin-right: 1rem; 
    }

    .item img {
      width: 80px;
      height: 80px;
      border-radius: 8px;
      object-fit: cover;
      margin-right: 1rem;
    }
    .item-details h5 {
      font-size: 1rem;
      margin-bottom: 0.5rem;
      color: #333;
    }
    .item-details p {
      font-size: 0.9rem;
      color: #777;
      margin-bottom: 0.2rem;
    }

    .item a {
      text-decoration: none;
      color: #fff;
    }

    .checkout-footer {
      text-align: center; /* Memusatkan elemen di dalam container ini */
      padding: 1.5rem 1rem; /* Memberikan padding untuk jarak */
    }
    .total {
      margin-bottom: 1rem;
      font-size: 1.2rem; 
      font-weight: bold;
      color: #8a4a4a;
      font-size: 1.1rem;
      font-weight: bold;
      color: #8a4a4a;
    }
    .checkout-button {
      width: 50%;
      max-width: 300px;
      background-color: #8a4a4a;
      color: #fff;
      font-size: 1rem;
      font-weight: bold;
      border: none;
      padding: 0.75rem 0;
      border-radius: 8px;
    }
    .checkout-button:hover {
      background-color: #6f3c3c;
    }
  </style>
</head>
<body>
  <div class="checkout-card">
    <div class="checkout-header">
      <span>Check Out</span>
    </div>
    <form method="POST" id="checkOutForm" action="{{ route('user.checkout_process')}}">
      @csrf
      @foreach ($carts as $item => $cart)
      <div class="item">
        <input type="checkbox" 
                class="form-check-input check-box"
                data-id="{{ $cart->id }}"
                data-user_id="{{ $cart->user_id }}"
                data-product_id="{{ $cart->product_id }}"
                data-product_name="{{ $cart->product_name }}"
                data-product_image="{{ $cart->product_image }}"
                data-price="{{ $cart->price }}"
                data-quantity="{{ $cart->quantity }}"
                data-sub_total="{{ $cart->sub_total }}"
                data-status="{{ $cart->status }}"
                onclick="addItem(this)">
        <img src="{{ asset('assets/product/' . $cart->product_image) }}" alt="Black Forest Cheesecakes">
        <div class="item-details">
          <h5>{{ $cart->product_name }}</h5>
          <p>Qty: <strong>{{ $cart->quantity }}</strong></p>
          <p>Rp{{ number_format($cart->price, 0, ',', '.')}}</p>
        </div>
        <a href="{{ route('user.delete_cart', $cart->id) }}" class="btn btn-danger ms-auto">Delete</a>
      </div>
      @endforeach
      <div class="checkout-footer">
        <input type="hidden" name="total_quantity" id="total_quantity" value="0">
          <input type="hidden" name="sub_total" id="sub_total" value="0">
          <div class="total">Total : Rp<span id="totalAmount">0</span></div>
          <button type="submit" id="checkoutButton" class="checkout-button" disabled>Buy Now</button>
      </div>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function addItem(checkbox) {
      const checkOutForm = document.getElementById('checkOutForm');

      if(checkbox.checked) {
        const data = {
          id: checkbox.dataset.id,
          user_id: checkbox.dataset.user_id,
          product_id: checkbox.dataset.product_id,
          product_name: checkbox.dataset.product_name,
          product_image: checkbox.dataset.product_image,
          price: checkbox.dataset.price,  
          quantity: checkbox.dataset.quantity,
          sub_total_product: checkbox.dataset.sub_total,
        };

        for (const key in data) {
          const input = document.createElement('input');
          input.type = 'hidden';
          input.name = `${key}[${data.id}]`;
          input.value = data[key];
          input.dataset.itemId = data.id;
          checkOutForm.appendChild(input);
        }
      } else {
        const failInput = document.querySelectorAll(`input[data-item-id = "${checkbox.dataset.id}"]`);
        failInput.forEach(input => input.remove());
      }

      updateTotal();
    }
    
    function updateTotal() {
      let sub_total = 0;
      let total_quantity = 0;

      const checkboxes = document.querySelectorAll('.check-box');

      checkboxes.forEach(checkbox => {
        if(checkbox.checked) {
          sub_total += parseInt(checkbox.dataset.sub_total || '0');
          total_quantity += parseInt(checkbox.dataset.quantity || '0');
        }
      });
      
      document.getElementById('totalAmount').textContent = sub_total.toLocaleString('id-ID');
      document.getElementById('sub_total').value = sub_total;
      document.getElementById('total_quantity').value = total_quantity;

      const checkoutButton = document.getElementById('checkoutButton');
      checkoutButton.textContent = sub_total > 0 ? 'Checkout' : 'Buy Now';
      checkoutButton.disabled = sub_total === 0;
    }
  </script>
</body>
</html>
