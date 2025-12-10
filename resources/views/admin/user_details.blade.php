<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details - Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Segoe+UI:wght@400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="dashboard" style="text-align: left;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
            <h1 style="margin: 0; font-size: 28px;">User Details</h1>
            <a href="{{ route('admin.dashboard') }}" class="btn"
                style="width: auto; padding: 10px 20px; text-decoration: none; display: inline-block; margin: 0;">Back
                to Dashboard</a>
        </div>

        <div class="user-info" style="background: white; border: 1px solid #eee; color: #333; padding: 0;">
            <div style="padding: 20px; background: #f8f9fa; border-bottom: 1px solid #eee;">
                <h3 style="margin: 0; color: #333;">{{ $user->name }}</h3>
                <p style="margin: 5px 0 0 0; color: #666;">User ID: #{{ $user->id }}</p>
            </div>

            <div style="padding: 30px;">
                <div style="margin-bottom: 25px;">
                    <label
                        style="display: block; font-weight: 600; font-size: 14px; color: #888; margin-bottom: 8px;">USERNAME</label>
                    <div style="font-size: 18px; color: #333;">{{ $user->username }}</div>
                </div>

                <div style="margin-bottom: 25px;">
                    <label
                        style="display: block; font-weight: 600; font-size: 14px; color: #888; margin-bottom: 8px;">ACCOUNT
                        CREATED</label>
                    <div style="font-size: 18px; color: #333;">{{ $user->created_at->format('F d, Y \a\t h:i A') }}
                    </div>
                </div>

                <div style="margin-bottom: 10px;">
                    <label
                        style="display: block; font-weight: 600; font-size: 14px; color: #888; margin-bottom: 8px;">LAST
                        UPDATED</label>
                    <div style="font-size: 18px; color: #333;">{{ $user->updated_at->format('F d, Y \a\t h:i A') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>