<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .profile-card {
            background-color: #dab6c4;
            border-radius: 15px;
            padding: 30px;
            width: 80%;
            max-width: 900px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            gap: 20px;

            /* Margin top untuk jarak dari atas */
            margin-top: 150px;
        }

        .profile-photo {
            flex-shrink: 0;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .profile-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-info {
            flex-grow: 1;
        }

        .profile-info h2 {
            font-weight: bold;
            color: #7a4a58;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            font-weight: bold;
            color: #5e3845;
        }

        .form-control, select, textarea {
            border-radius: 5px;
            border: 1px solid #ccc;
            padding: 10px;
            width: 100%;
        }

        textarea {
            resize: none;
        }

        .logout-button {
            background-color: #7a4a58;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            margin-top: 20px;
        }

        .logout-button:hover {
            background-color: #5e3845;
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
        <!-- Profile Photo -->
        <div class="profile-photo">
            @if ($user->photo)
                <img src="{{ asset('assets/profile_picture/' . $user->photo) }}" alt="Profile Photo">
            @else
                &#128100;
            @endif
        </div>

        <!-- Profile Info -->
        <div class="profile-info">
            <h2>PROFILE</h2>
            <form action="{{ route('user.update_profile', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number:</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <select class="form-control" name="address" id="address">
                            <option value="North Jakarta" @if($user->address == 'North Jakarta') selected @endif>North Jakarta</option>
                            <option value="East Jakarta" @if($user->address == 'East Jakarta') selected @endif>East Jakarta</option>
                            <option value="West Jakarta" @if($user->address == 'West Jakarta') selected @endif>West Jakarta</option>
                            <option value="Central Jakarta" @if($user->address == 'Central Jakarta') selected @endif>Central Jakarta</option>
                            <option value="South Jakarta" @if($user->address == 'South Jakarta') selected @endif>South Jakarta</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="detailed_address">Detailed Address:</label>
                        <textarea class="form-control" name="detailed_address" id="detailed_address" rows="3">{{ $user->detailed_address }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="profile_picture">Profile Picture:</label>
                        <input type="file" class="form-control" id="profile_picture" name="photo">
                    </div>
                </div>
                <button type="submit" class="logout-button">Save</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>