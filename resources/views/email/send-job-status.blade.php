<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>
        @if($status == 1)
            Congratulations!
        @else
            Application Update
        @endif
    </title>
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
        }


        .approved-title { color: #059669; }
        .approved-button { background-color: #10b981; }
        .approved-button:hover { background-color: #059669; }


        .declined-title { color: #dc2626; }
        .declined-button { background-color: #ef4444; }
        .declined-button:hover { background-color: #dc2626; }
    </style>
</head>
<body>
    <div class="container">
        @if($status == 1)
            <h1 class="approved-title">🎉 Congratulations, {{ $name }}!</h1>
            <p>Your application has been <strong>approved</strong>. For Job {{$job}} We are excited to have you onboard!</p>
            <p>
                <a href="{{ url('/') }}" class="button approved-button">
                    Go to Job board
                </a>
            </p>
        @else
            <h1 class="declined-title">😞 Sorry, {{ $name }}</h1>
            <p>We regret to inform you that your application has been <strong>declined</strong>.
                For Job {{$job}}</p>
            <p>You can apply for other jobs</p>
            <p>
                <a href="{{ url('/') }}" class="button approved-button">
                    Go to Job board
                </a>
            </p>
        @endif
    </div>
</body>
</html>
