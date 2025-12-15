<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Join AI</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Segoe+UI:wght@400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="dashboard">
        <h1>Admin Dashboard</h1>
        <div class="user-info">
            <h3>Welcome, Admin</h3>
            <p>System Administrator</p>
        </div>
        <p>You have successfully logged in with static admin credentials.</p>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="actions" style="margin: 20px 0; text-align: right;">
            <a href="{{ route('admin.product.create') }}" class="btn"
                style="width: auto; padding: 12px 25px; display: inline-block; text-decoration: none;">+ Add New
                Product</a>
        </div>

        <div class="users-list" style="margin: 30px 0; text-align: left;">
            <h3 style="margin-bottom: 15px; border-bottom: 2px solid #eee; padding-bottom: 10px;">Registered Users</h3>

            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                    <thead>
                        <tr style="">
                            <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">ID</th>
                            <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Name</th>
                            <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Username</th>
                            <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Joined Date</th>
                            <th style="padding: 12px; border: 1px solid #ddd; text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td style="padding: 10px; border: 1px solid #ddd;">{{ $user->id }}</td>
                                <td style="padding: 10px; border: 1px solid #ddd;">{{ $user->name }}</td>
                                <td style="padding: 10px; border: 1px solid #ddd;">{{ $user->username }}</td>
                                <td style="padding: 10px; border: 1px solid #ddd;">{{ $user->created_at->format('M d, Y') }}
                                </td>
                                <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">
                                    <a href="{{ route('admin.user.show', $user->id) }}"
                                        style="background: #667eea; color: white; padding: 5px 10px; text-decoration: none; border-radius: 4px; font-size: 13px;">View</a>
                                </td>
                            </tr>
                        @endforeach

                        @if($users->isEmpty())
                            <tr>
                                <td colspan="5"
                                    style="padding: 15px; text-align: center; color: #666; border: 1px solid #ddd;">
                                    No registered users found.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <h3 style="margin-bottom: 15px; border-bottom: 2px solid #eee; padding-bottom: 10px; margin-top: 40px;">Products Inventory</h3>
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                    <thead>
                        <tr style="">
                            <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">ID</th>
                            <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Image</th>
                            <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Name</th>
                            <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Price</th>
                            <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Qty</th>
                            <th style="padding: 12px; border: 1px solid #ddd; text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td style="padding: 10px; border: 1px solid #ddd;">{{ $product->id }}</td>
                                <td style="padding: 10px; border: 1px solid #ddd;">
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" width="50" height="50" style="object-fit: cover;">
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td style="padding: 10px; border: 1px solid #ddd;">{{ $product->pname }}</td>
                                <td style="padding: 10px; border: 1px solid #ddd;">${{ number_format($product->price, 2) }}</td>
                                <td style="padding: 10px; border: 1px solid #ddd;">{{ $product->qty }}</td>
                                <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">
                                    <form action="{{ route('admin.product.delete', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background: #e3342f; color: white; padding: 5px 10px; border: none; border-radius: 4px; font-size: 13px; cursor: pointer;">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        @if($products->isEmpty())
                            <tr><td colspan="6" style="padding: 15px; text-align: center; border: 1px solid #ddd;">No products found.</td></tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <h3 style="margin-bottom: 15px; border-bottom: 2px solid #eee; padding-bottom: 10px; margin-top: 40px;">Product Requests</h3>
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                    <thead>
                        <tr style="">
                            <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">ID</th>
                            <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">User</th>
                            <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Product</th>
                            <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Qty</th>
                            <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Status</th>
                            <th style="padding: 12px; border: 1px solid #ddd; text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($requests as $request)
                            <tr>
                                <td style="padding: 10px; border: 1px solid #ddd;">{{ $request->id }}</td>
                                <td style="padding: 10px; border: 1px solid #ddd;">{{ $request->user->name }}</td>
                                <td style="padding: 10px; border: 1px solid #ddd;">{{ $request->product->pname }}</td>
                                <td style="padding: 10px; border: 1px solid #ddd;">{{ $request->qty }}</td>
                                <td style="padding: 10px; border: 1px solid #ddd;">
                                    <span style="background: #17a2b8; color: white; padding: 2px 6px; border-radius: 3px; font-size: 12px;">{{ ucfirst($request->status) }}</span>
                                </td>
                                <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">
                                    <form action="{{ route('admin.request.delete', $request->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this request?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background: #e3342f; color: white; padding: 5px 10px; border: none; border-radius: 4px; font-size: 13px; cursor: pointer;">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        @if($requests->isEmpty())
                            <tr><td colspan="6" style="padding: 15px; text-align: center; border: 1px solid #ddd;">No requests found.</td></tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-logout">Logout</button>
        </form>
    </div>
</body>

</html>