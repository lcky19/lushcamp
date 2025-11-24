<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>LushCamp Login</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
<style>
body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #ffffff, #e9f8eb);
    display: flex; justify-content: center; align-items: center;
    height: 100vh; color: #2E7D32;
}
form {
    background: rgba(255,255,255,0.9); padding: 2rem; border-radius: 16px; box-shadow: 0 5px 25px rgba(76,175,80,0.2);
    width: 350px;
}
h2 { text-align:center; margin-bottom: 1.5rem; font-weight:700; }
input[type=email], input[type=password] {
    width: 100%; padding: 0.8rem; margin-bottom: 1rem; border-radius: 8px; border: 1px solid #a5d6a7;
}
button {
    width: 100%; padding: 0.8rem; border:none; border-radius:8px;
    background: linear-gradient(135deg,#4CAF50,#2E7D32); color:white; font-weight:600; cursor:pointer;
}
button:hover { transform: scale(1.02); box-shadow: 0 5px 15px rgba(46,125,50,0.4);}
.error { color:red; text-align:center; margin-bottom:1rem; }
.register-link { text-align:center; margin-top:1rem; display:block; color:#1B5E20; text-decoration:underline; }
</style>
</head>
<body>
<form method="post">
    <h2>Login</h2>
    <?php if(!empty($error)) echo "<p class='error'>$error</p>"; ?>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
    <a href="<?= site_url('lushcamp/register') ?>" class="register-link">Create an account</a>
</form>
</body>
</html>
