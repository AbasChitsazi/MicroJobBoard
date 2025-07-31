<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Password Changed Successfully</title>
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
            text-align: center;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 16px;
            color: #059669;
        }

        p {
            margin-bottom: 16px;
            line-height: 1.6;
        }

        .button {
            display: inline-block;
            padding: 12px 20px;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            background-color: #10b981;
        }

        .button:hover {
            background-color: #059669;
        }

        .note {
            font-size: 12px;
            color: #64748b;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔒 Password Changed Successfully</h1>
        <p>Hello {{ $name }},</p>
        <p>Your password for your Job Board account was successfully changed.</p>
        <p>If this wasn't you, please reset your password immediately to secure your account.</p>
        <p>
            <a href="{{ url('/login') }}" class="button">
                Go to Login
            </a>
        </p>
        <p class="note">
            If you did not request this change, please contact our support team.
        </p>
    </div>
</body>
</html>
