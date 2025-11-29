<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'AuthBoard') }}</title>

        <!-- Styles -->
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            }
            
            body {
                background: #160f73;
                background: radial-gradient(
                    circle,
                    rgb(13, 100, 103) 0%,
                    rgb(6, 45, 42) 100%,
                    rgb(0, 131, 125) 100%
                );
                min-height: 100vh;
            }
            
            /* Navigation Styles */
            .navbar {
                background: rgba(22, 22, 22, 0.475);
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                backdrop-filter: blur(10px);
                position: sticky;
                padding: 0 20px;
            }
            
            .nav-container {
                max-width: 1200px;
                margin: 0 auto;
                display: flex;
                justify-content: space-between;
                align-items: center;
                height: 70px;
            }
            
            .nav-brand a {
                font-size: 24px;
                font-weight: bold;
                color: white;
                text-decoration: none;
            }
            
            .nav-links {
                display: flex;
                gap: 30px;
                align-items: center;
            }
            
            .nav-link {
                color: white;
                text-decoration: none;
                font-weight: 500;
                padding: 8px 16px;
                border-radius: 6px;
                transition: all 0.3s;
            }
            
            .nav-link:hover, .nav-link.active {
                background: white;
                color: #062d2a;
            }
            
            .logout-btn {
                display: flex;
                justify-content: center;
                background: #e74c3c;
                color: white;
                border: none;
                padding: 8px 16px;
                border-radius: 6px;
                cursor: pointer;
                font-weight: 500;
            }
            
            .logout-btn:hover {
                background: #c0392b;
            }
            
            .container {
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: calc(100vh - 70px);
                padding: 20px;
            }
            
            .box {
                background: white;
                border-radius: 15px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
                width: 100%;
                max-width: 450px;
                padding: 40px;
            }
            
            .auth-header {
                text-align: center;
                margin-bottom: 30px;
            }
            
            .auth-header h2 {
                color: white;
                margin-bottom: 10px;
                font-weight: 600;
            }
            
            .auth-subtitle {
                color: #666;
                font-size: 14px;
            }
            
            .form {
                display: flex;
                flex-direction: column;
            }
            
            label {
                display: block;
                margin-bottom: 8px;
                font-weight: 500;
                color: #444;
            }
            
            input[type="text"],
            input[type="email"],
            input[type="password"],
            textarea {
                width: 100%;
                padding: 14px;
                border: 2px solid #ddd;
                border-radius: 8px;
                font-size: 16px;
                margin-bottom: 20px;
                transition: border 0.3s;
            }
            
            input:focus,
            textarea:focus {
                outline: none;
                border-color: #4a90e2;
                box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.1);
            }
            
            button[type="submit"] {
                width: 100%;
                padding: 14px;
                background: #e09c42;
                color: white;
                border: none;
                border-radius: 8px;
                font-size: 16px;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s;
                /* margin-bottom: 20px; */
            }
            
            button[type="submit"]:hover {
                transform: translateY(-2px);
                box-shadow: 0 2px 3px white;
            }
            
            .auth-link {
                text-align: center;
                color: #666;
                font-size: 14px;
            }
            
            .auth-link a {
                color: #2575fc;
                text-decoration: none;
            }
            
            .auth-link a:hover {
                text-decoration: underline;
            }

            /* Posts specific styles */
            .posts-container {
                max-width: 800px;
                margin: 0 auto;
                width: 100%;
            }
            
            .page-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 30px;
            }
            
            .all-posts {
                color: white;
                margin: 0;
                font-size: 28px;
            }
            
            .btn {
                padding: 12px 20px;
                background: #e09c42;
                color: white;
                text-decoration: none;
                border-radius: 8px;
                font-weight: 600;
                transition: all 0.3s;
                border: none;
                cursor: pointer;
            }
            
            .btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(37, 117, 252, 0.4);
            }
            
            .post {
                background: white;
                border-radius: 12px;
                padding: 25px;
                margin-bottom: 20px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }
            
            .post-header {
                display: flex;
                justify-content: space-between;
                align-items: flex-start;
                margin-bottom: 15px;
                padding-bottom: 20px;
                border-bottom: 1px solid #A6A6A6;
            }
            
            .user-info {
                display: flex;
                align-items: center;
                gap: 12px;
            }
            
            .avatar-circle {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
                color: white;
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: bold;
                font-size: 16px;
            }
            
            .avatar-circle.small {
                width: 50px;
                height: 50px;
                font-size: 25px;
            }
            
            .user-details {
                display: flex;
                flex-direction: column;
            }
            
            .post-user {
                font-weight: 600;
                color: #333;
                font-size: 14px;
            }
            
            .post-date {
                color: #999;
                font-size: 12px;
            }
            
            .post-actions {
                display: flex;
                gap: 10px;
            }
            
            .edit-btn, .delete-btn {
                background: #dc2626;
                border: none;
                font-size: 18px;
                cursor: pointer;
                padding: 7px;
                border-radius: 4px;
                transition: background 0.3s ease-in;
            }
            
            .edit-btn:hover, .delete-btn:hover {
                background: #dc2626;
            }
            
            .post-content {
                line-height: 1.6;
                color: #333;
                margin-bottom: 15px;
            }
            
            .post-image {
                margin: 15px 0;
            }
            
            .post-image img {
                max-width: 100%;
                border-radius: 8px;
            }
            
            .no-posts {
                text-align: center;
                padding: 40px 20px;
                color: #666;
            }
            
            .noposts {
                margin-bottom: 20px;
            }

            /* Dashboard specific */
            .dashboard {
                max-width: 800px;
                margin: 0 auto;
                width: 100%;
            }
            
            .welcome-section {
                display: flex;
                align-items: center;
                gap: 20px;
                margin-bottom: 30px;
                padding: 30px;
                background: white;
                border-radius: 12px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }
            
            .avatar-circle.large {
                width: 80px;
                height: 80px;
                font-size: 28px;
            }
            
            .welcome-text h2 {
                color: #333;
                margin-bottom: 5px;
                font-size: 24px;
            }
            
            .you-text {
                color: #666;
                font-size: 16px;
                font-weight: normal;
            }
            
            .email {
                color: #666;
                font-size: 14px;
            }
            
            .stats-section {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 20px;
                margin: 30px 0;
            }
            
            .stat-card {
                background: white;
                padding: 25px 20px;
                border-radius: 12px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                text-align: center;
                border-left: 4px solid #2575fc;
            }
            
            .stat-icon {
                font-size: 2.5em;
                margin-bottom: 15px;
            }
            
            .stat-card h3 {
                margin: 0 0 10px 0;
                color: #333;
                font-size: 1.1em;
            }
            
            .stat-number {
                font-size: 2.5em;
                font-weight: bold;
                color: #2575fc;
                margin: 10px 0;
            }
            
            .stat-description {
                color: #666;
                font-size: 0.9em;
                margin: 0;
            }
            
            .empty-state {
                text-align: center;
                padding: 40px 20px;
                background: white;
                border-radius: 12px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }
            
            .empty-icon {
                font-size: 48px;
                margin-bottom: 20px;
            }
            
            .direct-post-form {
                max-width: 500px;
                margin: 0 auto;
            }
            
            .direct-post-form textarea {
                margin-bottom: 15px;
            }
        </style>
    </head>
    <body>
        <!-- Navigation Bar -->
        @if(Auth::check())
        <nav class="navbar">
            <div class="nav-container">
                <div class="nav-brand">
                    <a href="{{ route('dashboard') }}">AuthBoard</a>
                </div>
                <div class="nav-links">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
                    <a href="{{ route('posts.index') }}" class="nav-link {{ request()->routeIs('posts.*') ? 'active' : '' }}">Posts</a>
                    <a href="{{ route('profile.edit') }}" class="nav-link">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="logout-btn">Logout</button>
                    </form>
                </div>
            </div>
        </nav>
        @endif

        <!-- Main Content -->
        <div class="container">
            {{ $slot }}
        </div>
    </body>
</html>