<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - E-Inventory</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            height: 100vh;
            background: linear-gradient(135deg, #0f172a, #1e3a8a);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            width: 380px;
            padding: 35px;
            border-radius: 22px;
            background: rgba(30, 58, 138, 0.35);
            backdrop-filter: blur(14px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.45);
            color: #fff;
            text-align: center;
            animation: fadeIn 0.6s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .login-card h2 {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 5px;
            color: #facc15;
        }

        .login-card p {
            font-size: 14px;
            opacity: 0.9;
            margin-bottom: 26px;
        }

        .input-group {
            margin-bottom: 18px;
            text-align: left;
        }

        .input-group label {
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 6px;
            display: block;
            color: #e5e7eb;
        }

        .input-group input {
            width: 100%;
            padding: 12px 14px;
            border-radius: 12px;
            border: none;
            outline: none;
            font-size: 14px;
            background: rgba(255, 255, 255, 0.9);
        }

        .input-group input:focus {
            box-shadow: 0 0 0 2px #facc15;
        }

        .btn-login {
            width: 100%;
            padding: 13px;
            background: linear-gradient(135deg, #facc15, #eab308);
            border: none;
            border-radius: 14px;
            font-size: 16px;
            cursor: pointer;
            font-weight: 600;
            margin-top: 12px;
            color: #1e293b;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(250, 204, 21, 0.45);
        }

        .error {
            background: rgba(239, 68, 68, 0.85);
            padding: 12px;
            border-radius: 12px;
            margin-bottom: 15px;
            font-size: 14px;
            text-align: center;
        }

        @media (max-width: 420px) {
            .login-card {
                width: 90%;
            }
        }
    </style>
</head>

<body>

<div class="login-card">
    <h2>E-Inventory</h2>
    <p>Silakan login untuk masuk</p>

    @if(session('error'))
        <div class="error">{{ session('error') }}</div>
    @endif

    <form method="POST" action="/login">
        @csrf

        <div class="input-group">
            <label>Email</label>
            <input type="email" name="email" placeholder="example@email.com" required>
        </div>

        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="••••••••" required>
        </div>

        <button class="btn-login">Masuk</button>
    </form>
</div>

</body>
</html>
