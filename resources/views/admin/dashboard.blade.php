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
                        <tr style="background: #f8f9fa;">
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
        </div>

        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-logout">Logout</button>
        </form>
    </div>
</body>

</html>