<!DOCTYPE html>
<html>
<head>
    <title>Login Kursus Bahasa</title>
    <style>
        body { font-family: sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; background: #f0f2f5; }
        .card { background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); width: 300px; }
        input { width: 100%; padding: 8px; margin: 8px 0; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #0056b3; }
        .error { color: red; font-size: 0.8rem; margin-bottom: 1rem; }
    </style>
</head>
<body>

<div class="card">
    <h2 style="text-align:center">Login System</h2>

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf <label>Email:</label>
        <input type="email" name="email" value="{{ old('email') }}" required placeholder="admin@lms.com">

        <label>Password:</label>
        <input type="password" name="password" required placeholder="password">

        <button type="submit">Masuk</button>
    </form>

    <p style="font-size: 12px; color: gray; text-align: center; margin-top: 15px;">
        Gunakan akun dari Seeder:<br>
        admin@lms.com | password<br>
        guru@lms.com | password
    </p>
</div>

</body>
</html>
