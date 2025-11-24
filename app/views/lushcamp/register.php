<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>LushCamp Register</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
<style>
body { font-family:'Poppins',sans-serif; background: linear-gradient(135deg,#ffffff,#e9f8eb); display:flex; justify-content:center; align-items:center; height:100vh; color:#2E7D32; }
form { background: rgba(255,255,255,0.9); padding:2rem; border-radius:16px; box-shadow:0 5px 25px rgba(76,175,80,0.2); width:350px; }
h2 { text-align:center; margin-bottom:1.5rem; font-weight:700; }
input[type=text], input[type=email], input[type=password], select {
    width:100%; padding:0.8rem; margin-bottom:1rem; border-radius:8px; border:1px solid #a5d6a7;
}
button {
    width:100%; padding:0.8rem; border:none; border-radius:8px; background:linear-gradient(135deg,#4CAF50,#2E7D32); color:white; font-weight:600; cursor:pointer;
}
button:hover { transform:scale(1.02); box-shadow:0 5px 15px rgba(46,125,50,0.4); }
.login-link { text-align:center; margin-top:1rem; display:block; color:#1B5E20; text-decoration:underline; }
</style>
</head>
<body>
<form method="post">
    <h2>Register</h2>
    <input type="text" name="first_name" placeholder="First Name" required>
    <input type="text" name="last_name" placeholder="Last Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <select name="role" required>
        <option value="user">User</option>
        <option value="admin">Admin</option>
    </select>
    <button type="submit">Register</button>
    <a href="<?= site_url('lushcamp/login') ?>" class="login-link">Back to Login</a>
</form>
</body>
</html>
