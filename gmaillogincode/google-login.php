<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | CollabXInfluencer</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin-top: 50px; }
        .login-btn { padding: 10px 20px; margin: 10px; cursor: pointer; display: inline-block; text-decoration: none; color: #fff; border-radius: 5px; }
        .google { background-color: #db4437; }
        .apple { background-color: #000; }
    </style>
</head>
<body>
    <h1>Welcome to CollabXInfluencer</h1>
    <h3>Login with</h3>
    <!-- Google Login -->
    <a href="https://accounts.google.com/o/oauth2/v2/auth?scope=profile email&response_type=code&client_id=-3mbtcavf24g1r66aunjgue84d60pq2uf.apps.googleusercontent.com&redirect_uri=http://localhost/googlelogin/google-callback.php" class="login-btn google">Login with Google</a>

    <!-- Apple ID Login (Placeholder) -->
    <a href="apple-login.php" class="login-btn apple">Login with Apple</a>
</body>
</html>
