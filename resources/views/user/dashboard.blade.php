<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Join AI</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Segoe+UI:wght@400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="dashboard">
        <h1>User Dashboard</h1>
        <div class="user-info">
            <h3>Welcome, {{ session('user_name') }}</h3>
            <p>Member since {{ now()->format('M Y') }}</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success" style="color: green; background-color: #d4edda; border-color: #c3e6cb; padding: 10px; margin-bottom: 20px; border-radius: 5px;">
                {{ session('success') }}
            </div>
        @endif

        <div class="products-section">
            <h2>Available Products</h2>
            @if($products->isEmpty())
                <p>No products available at the moment.</p>
            @else
                <div class="product-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px; margin-top: 20px;">
                    @foreach($products as $product)
                        <div class="product-card" style="border: 1px solid #ddd; padding: 15px; border-radius: 8px; text-align: center;">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->pname }}" style="max-width: 100%; height: 150px; object-fit: cover; margin-bottom: 10px;">
                            @else
                                <div style="height: 150px; background-color: #f0f0f0; margin-bottom: 10px; display: flex; align-items: center; justify-content: center;">No Image</div>
                            @endif
                            <h4>{{ $product->pname }}</h4>
                            <p>Price: ${{ number_format($product->price, 2) }}</p>
                            <p>Available: {{ $product->qty }}</p>
                            
                            <form action="{{ route('user.request.product') }}" method="POST" style="margin-top: 10px;">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="number" name="qty" min="1" max="{{ $product->qty }}" value="1" style="width: 60px; padding: 5px; margin-bottom: 5px;" required>
                                <button type="submit" class="btn btn-primary" style="padding: 5px 10px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">Request</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <form action="{{ route('user.logout') }}" method="POST" style="margin-top: 30px;">
            @csrf
            <button type="submit" class="btn btn-logout">Logout</button>
        </form>
    </div>
</body>

</html>