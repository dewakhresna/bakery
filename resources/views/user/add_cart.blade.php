<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shopping Cart</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
.product-card {
    border: none;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    overflow: hidden;
    padding: 20px;
  }
  .product-image img {
    width: 100%;
    width: 170px;
    height: 200px;
    /* max-width: 250px; Atur ukuran maksimum gambar */
    border-radius: 10px;
  }
  .product-info {
    flex: 1; /* Membuat info produk fleksibel */
  }
  .product-title {
    font-weight: bold;
    font-size: 1.25rem;
    margin-bottom: 0.5rem;
  }
  .product-description {
    font-size: 0.9rem;
    color: #555;
  }
  .price {
    font-weight: bold;
    font-size: 1rem;
    margin: 1rem 0;
  }
  .btn-quantity {
    width: 40px;
    height: 40px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
  }
  .btn-add-to-cart {
    background-color: #7a4a58;
    color: white;
    font-weight: bold;
    text-transform: uppercase;
  }
  .btn-add-to-cart:hover {
    background-color: #5e3845;
  }
  </style>
</head>
<body>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>Cheese Cakes</h2>
            <div class="d-flex align-items-center product-card">
              <!-- Gambar -->
              <div class="product-image me-4">
                <img src="{{ asset('assets/product/' . $product->product_image)}}" alt="Product Image" class="img-fluid rounded">
              </div>
              <!-- Informasi Produk -->
                <div class="product-info">
                  <h5 class="product-title">{{ $product->product_name}}</h5>
                  <p class="product-description">{{ $product->description}}</p>
                  <p class="price">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                  <div class="d-flex align-items-center mb-3">
                    <button class="btn btn-outline-secondary btn-quantity" id="decrement">-</button>
                    <input type="text" id="quantity" class="form-control mx-2 text-center" value="1" style="width: 60px;">
                    <button class="btn btn-outline-secondary btn-quantity" id="increment">+</button>
                  </div>
                  <form method="POST" action="{{ route('user.add_cart_process', ['id' => $product->id])}}">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="product_name" value="{{ $product->product_name }}">
                    <input type="hidden" name="product_image" value="{{ $product->product_image }}">
                    <input type="hidden" name="price" value="{{ $product->price }}">
                    <input type="hidden" name="quantity" id="form-quantity" value="1">
                    <button type="submit" class="btn btn-add-to-cart w-100">Add To Cart</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
      

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // JavaScript for handling quantity increment and decrement
  const decrementButton = document.getElementById('decrement');
  const incrementButton = document.getElementById('increment');
  const quantityInput = document.getElementById('quantity');
  const formQuantityInput = document.getElementById('form-quantity');

  decrementButton.addEventListener('click', () => {
    let currentValue = parseInt(quantityInput.value, 10);
    if (currentValue > 1) {
      quantityInput.value = currentValue - 1;
      formQuantityInput.value = quantityInput.value;
    }
  });

  incrementButton.addEventListener('click', () => {
    let currentValue = parseInt(quantityInput.value, 10);
    quantityInput.value = currentValue + 1;
    formQuantityInput.value = quantityInput.value;
  });
</script>

</body>
</html>
