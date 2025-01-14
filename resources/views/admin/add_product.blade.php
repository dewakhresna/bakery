<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>New Product Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .form-container {
      padding: 30px;
      background-color: #fff;
    }
    .form-title {
      margin-top: 10px;
      /* text-align: center; */
      gap: 5px;
      /* justify-content: center; */
      display: flex;
      font-size: 24px;
      font-weight: bold;
      color: #8B0000;
      border-bottom: 1px solid gray;
    }

    .btn-close {
      float: right;
    }
    .image-preview {
      width: 100px;
      height: 100px;
      border: 1px solid #ddd;
      border-radius: 8px;
      margin-bottom: 10px;
      display: flex;
      justify-content: center;
      align-items: center;
      overflow: hidden;
    }
    .image-preview img {
      width: 100%;
      height: auto;
    }
  </style>
</head>
<body>

<div class="form-title">
  <p class="tittle">New Product</p>
  <button type="button" class="btn-close" aria-label="Close"></button>
</div>

<div class="form-container">
  <form method="POST" action="{{ route('admin.add_product_process') }}" enctype="multipart/form-data" id="productForm">
    @csrf
    <div class="mb-3">
      <label for="productName" class="form-label">Product Name:</label>
      <input type="text" class="form-control" id="productName" name="product_name" required>
    </div>
    <div class="mb-3">
      <label for="description" class="form-label">Description:</label>
      <textarea class="form-control" id="description" rows="3" name="description" required></textarea>
    </div>
    <div class="mb-3">
      <label for="category" class="form-label">Category:</label>
      <select name="category" id="category" class="form-select" required>
        <option selected>Choose Category</option>
        <option value="CupCakes">CupCakes</option>
        <option value="Cookies">Cookies</option>
        <option value="CheeseCakes">CheeseCakes</option>
      </select>
      {{-- <input type="text" class="form-control" id="category" name="category" required> --}}
    </div>
    <div class="mb-3">
      <label for="image" class="form-label">Image:</label>
      <div class="image-preview" id="imagePreview">
        <span>No Image</span>
      </div>
      <input type="file" class="form-control" id="image" accept="image/*" name="product_image" required>
    </div>
    <div class="mb-3">
      <label for="stock" class="form-label">Stock:</label>
      <input type="number" class="form-control" id="stock" name="stock" required>
    </div>
    <div class="mb-3">
      <label for="price" class="form-label">Price:</label>
      <input type="number" class="form-control" id="price" name="price" required>
    </div>
    <button type="submit" class="btn btn-primary w-100" style="background-color: #8B0000; border-color: #8B0000;">Save</button>
  </form>
</div>

<script>
  document.getElementById('image').addEventListener('change', function(event) {
    const imagePreview = document.getElementById('imagePreview');
    const file = event.target.files[0];

    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        imagePreview.innerHTML = `<img src="${e.target.result}" alt="Selected Image">`;
      };
      reader.readAsDataURL(file);
    } else {
      imagePreview.innerHTML = '<span>No Image</span>';
    }
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
