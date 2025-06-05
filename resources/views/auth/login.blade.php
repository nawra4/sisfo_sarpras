<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login | Login Sisfo</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(120deg, #667eea, #764ba2);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
        }

        .container {
            background: rgba(255,255,255,0.15);
            padding: 40px 35px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            width: 350px;
            backdrop-filter: blur(10px);
            box-sizing: border-box;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: 600;
            letter-spacing: 1.3px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            font-size: 0.9rem;
            color: #f0f0f0;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 14px 2px;
            margin-bottom: 20px;
            border-radius: 8px;
            border: none;
            font-size: 1rem;
            outline: none;
            transition: box-shadow 0.3s ease;
            color: #333;
            background-color: #fff;
        }

        input[type="text"]:focus-visible,
        input[type="password"]:focus-visible {
            box-shadow: 0 0 8px #9f7aea;
            border-color: #9f7aea;
        }

        button {
            width: 100%;
            padding: 14px 0;
            border: none;
            border-radius: 10px;
            background: #5a67d8;
            font-weight: 600;
            font-size: 1.1rem;
            cursor: pointer;
            color: #fff;
            transition: background 0.3s ease;
        }

        button:hover {
            background: #434190;
        }

        .alert {
            background-color: #ff6b6b;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 8px;
            font-weight: 600;
            text-align: center;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Masuk ke Akunmu</h1>

        @if ($errors->any())
            <div class="alert" role="alert">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('auth.login') }}" aria-live="assertive">
            @csrf

            <label for="username">Username</label>
            <input 
                id="username" 
                type="text" 
                name="username" 
                value="{{ old('username') }}" 
                required 
                autofocus 
                placeholder="Masukkan username" 
                aria-required="true"
                aria-describedby="usernameHelp"
            />

            <label for="password">Password</label>
            <input 
                id="password" 
                type="password" 
                name="password" 
                required 
                placeholder="Masukkan password" 
                aria-required="true"
            />

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
