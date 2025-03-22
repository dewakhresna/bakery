@extends('layouts.admin')

@section('content')

<table class="table table-striped table-hover mb-5 mt-5">
    <thead class="thead">
        <tr>
            <th>No</th>
            <th>Product</th>
            <th>Price</th>
            <th>Stok</th>
            <th>Action</th>
        </tr>
        @foreach ($products as $index => $product)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $product->product_name }}</td>
                <td>Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                <td>{{ $product->stock }}</td>
                <td>
                    <button class="btn btn-primary"><a href="{{ route('admin.edit_product', ['id' => $product->id]) }}" class="btn-action">Edit</a></button>
                    <button class="btn btn-danger"><a href="{{ route('admin.delete_product', ['id' => $product->id]) }}" class="btn-action">Delete</a></button>
                </td>
            </tr>
        @endforeach
    </thead>
</table>
@endsection