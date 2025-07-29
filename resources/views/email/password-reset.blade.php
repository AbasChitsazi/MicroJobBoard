<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Password Reset</title>
    <style>
        body {
            background: linear-gradient(to right, #e0e7ff 10%, #e0f2fe 30%, #d1fae5 90%);
            font-family: Arial, sans-serif;
            color: #334155;
            padding: 40px 20px;
            margin: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 8px;
            padding: 24px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }

        h1 {
            font-size: 24px;
            margin-bottom: 16px;
            color: #1e293b;
        }

        p {
            margin-bottom: 16px;
            line-height: 1.6;
        }

        a.button {
            display: inline-block;
            padding: 12px 20px;
            background-color: #6366f1;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
        }

        a.button:hover {
            background-color: #4f46e5;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Password Reset Request</h1>
        <p>Hi,</p>
        <p>We received a request to reset your password. Click the button below to reset it:</p>

        <p>
            <a href="{{ route('password.reset', ['token' => $token, 'email' => $email]) }}" class="button">
                Reset Password
            </a>
        </p>

        <p>If you didn’t request a password reset, please ignore this email.</p>
    </div>
</body>
</html>
