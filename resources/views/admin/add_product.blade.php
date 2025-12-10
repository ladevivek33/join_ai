<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product - Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Segoe+UI:wght@400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h2>Add New Product</h2>
        <p>Enter product details below</p>

        @if($errors->any())
            <div class="alert alert-error">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="pname">Product Name</label>
                <input type="text" id="pname" name="pname" value="{{ old('pname') }}" placeholder="Enter product name"
                    required>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" step="0.01" id="price" name="price" value="{{ old('price') }}"
                    placeholder="Enter price" required>
            </div>

            <div class="form-group">
                <label for="qty">Quantity</label>
                <input type="number" id="qty" name="qty" value="{{ old('qty') }}" placeholder="Enter quantity" required>
            </div>

            <div class="form-group">
                <label for="image">Product Image</label>
                <input type="file" id="image" name="image" accept="image/*" style="border: none; padding: 10px 0;">
            </div>

            <button type="submit" class="btn">Add Product</button>

            <div class="link">
                <a href="{{ route('admin.dashboard') }}">Back to Dashboard</a>
            </div>
        </form>
    </div>
</body>

</html>