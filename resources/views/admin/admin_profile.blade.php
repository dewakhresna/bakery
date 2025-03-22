<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .profile-card {
            background-color: #dab6c4;
            border-radius: 15px;
            padding: 20px;
            margin: 50px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
        }
        .profile-photo {
            font-size: 100px;
            color: #7a4a58;
            text-align: center;
            flex-shrink: 0;
        }

        .profile-image  {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 20px;
        }

        .profile-info {
            flex-grow: 1;
        }
        .profile-info h2 {
            font-weight: bold;
            color: #7a4a58;
            margin-bottom: 20px;
        }
        .logout-button {
            background-color: #7a4a58;
            color: white;
            border: none;
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            margin-top: 20px;
            cursor: pointer;
        }
        .logout-button:hover {
            background-color: #5e3845;
        }

        .logout-button a {
            text-decoration: none;
            color: white;
        }

        .edit-icon {
            float: right;
            font-size: 1.5em;
            color: #7a4a58;
            cursor: pointer;
        }
        
        .edit-icon a {
            text-decoration: none;
            color: #7a4a58;
        }
    </style>
</head>
<body>

    <div class="profile-card">
        <div class="profile-photo">
            @if ($user->photo)
                <img src="{{ asset('assets/profile_picture/' . $user->photo) }}" alt="Profile Photo" class="profile-image">
            @else
                &#128100;
            @endif
        </div>
        <div class="profile-info">
            <h2>PROFILE</h2>
            <p><strong>{{ $user->username }}</strong>
            <p>{{ $user->email }}</p>
            <p>{{ $user->phone }}</p>
            <p>{{ $user->address }}</p>
            <p>{{ $user->detailed_address}}</p>
            <button class="logout-button"><a href="{{ route('logout') }}">Logout</a></button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>