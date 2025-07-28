<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Forgot password</title>
</head>

<body
    class="mx-auto mt-10 max-w-2xl bg-gradient-to-r from-indigo-100 from-10% via-sky-100 via-30% to-emerald-100 to-90% text-slate-700">
    <x-card>
        <h1 class="text-2xl font-bold mb-4">Password Reset Request</h1>

        <p>Hi,</p>
        <p>To reset your password, please click the link below:</p>

        <p>
            <a href="{{ route('password.reset', ['token' => $token, 'email' => $email]) }}"
                class="text-indigo-600 hover:underline">
                Reset Password
            </a>

        </p>

        <p>If you didn't request this password reset, please ignore this email.</p>
    </x-card>

</body>

</html>
