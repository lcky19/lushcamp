<?php
$is_logged_in = isset($_SESSION['user_name']);
$role = $_SESSION['role'] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>LushCamp Bookings</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
<style>
*{margin:0;padding:0;box-sizing:border-box;}
body { font-family:'Poppins',sans-serif; background:linear-gradient(135deg,#ffffff,#e9f8eb); min-height:100vh; padding:2rem; color:#2E7D32; }
.container { max-width:1200px; margin:0 auto; }
h2{text-align:center; font-size:2.5rem; font-weight:700; margin-bottom:2rem; background:linear-gradient(135deg,#2E7D32,#388E3C,#4CAF50); -webkit-background-clip:text; -webkit-text-fill-color:transparent;}
.topbar { text-align:right; margin-bottom:1rem; }
.welcome { font-weight:600; margin-right:1rem; }
.logout-btn,.auth-btn,.add-button,.btn { border:none; border-radius:8px; padding:0.5rem 1rem; font-weight:600; cursor:pointer; text-decoration:none; color:#fff; transition:0.3s; }
.logout-btn { background:linear-gradient(135deg,#4CAF50,#2E7D32); } 
.auth-btn { background:linear-gradient(135deg,#388E3C,#4CAF50); } 
.add-button { background:linear-gradient(135deg,#2E7D32,#4CAF50); margin-bottom:1rem; display:inline-block; }
.logout-btn:hover,.auth-btn:hover,.add-button:hover,.btn:hover { transform:scale(1.05); box-shadow:0 6px 20px rgba(76,175,80,0.4);}
table { width:100%; border-collapse:separate; border-spacing:0 16px; }
th { text-align:left; padding:1rem; font-weight:600; color:#2E7D32; }
tr { background:rgba(255,255,255,0.8); border-radius:16px; transition:0.3s; border:1px solid #c8e6c9; }
tr:hover { transform:translateY(-4px) scale(1.02); box-shadow:0 10px 30px rgba(76,175,80,0.3); }
td { padding:1rem; }
td:first-child { font-weight:700; color:#1B5E20; }
.btn-update { background:linear-gradient(135deg,#4CAF50,#2E7D32); }
.btn-delete { background:linear-gradient(135deg,#388E3C,#1B5E20); }
.search-form { text-align:right; margin-bottom:1rem; }
.search-form input[type="text"] { padding:0.5rem 1rem; border-radius:8px; border:1px solid #a5d6a7; margin-right:0.5rem; }
.search-form button { padding:0.5rem 1rem; border:none; border-radius:8px; background:linear-gradient(135deg,#4CAF50,#2E7D32); color:white; cursor:pointer; }
.search-form button:hover { background:linear-gradient(135deg,#2E7D32,#388E3C); }
</style>
</head>
<body>
<div class="container">
<div class="topbar">
<?php if($is_logged_in): ?>
    <span class="welcome">👋 Welcome, <?= htmlspecialchars($_SESSION['user_name']); ?>!</span>
    <a href="<?= site_url('lushcamp/logout') ?>" class="logout-btn">Logout</a>
<?php else: ?>
    <a href="<?= site_url('lushcamp/login') ?>" class="auth-btn">Login</a>
    <a href="<?= site_url('lushcamp/register') ?>" class="auth-btn">Register</a>
<?php endif; ?>
</div>

<h2>LushCamp Bookings</h2>

<form method="get" class="search-form">
<input type="text" name="q" placeholder="Search bookings..." value="<?= $_GET['q'] ?? '' ?>">
<button type="submit">Search</button>
</form>

<?php if($is_logged_in): ?>
<a href="<?= site_url('lushcamp/bookings/create') ?>" class="add-button">Book New Accommodation</a>

<table>
<tr>
<th>ID</th>
<th>Type</th>
<th>Date</th>
<th>Time</th>
<th>Service</th>
<th>Status</th>
<th>Payment</th>
<?php if($role==='admin'): ?><th>Actions</th><?php endif; ?>
</tr>

<?php if(!empty($bookings)): foreach($bookings as $b): ?>
<tr>
<td><?= $b['id'] ?></td>
<td><?= ucfirst($b['type']) ?></td>
<td><?= $b['date'] ?></td>
<td><?= $b['time'] ?></td>
<td><?= $b['service'] ?: 'N/A' ?></td>
<td><?= ucfirst($b['status']) ?></td>
<td>
<?php if (!empty($b['payment_image'])): ?>
    <a href="/public/uploads/payments/<?= $b['payment_image'] ?>" target="_blank">View Payment</a>
<?php else: ?>
    <span>No payment</span>
<?php endif; ?>
</td>
<?php if($role==='admin'): ?>
<td>
<a href="<?= site_url('lushcamp/bookings/update/'.$b['id']) ?>" class="btn btn-update">Update</a>
<a href="<?= site_url('lushcamp/bookings/delete/'.$b['id']) ?>" class="btn btn-delete">Delete</a>
</td>
<?php endif; ?>
</tr>
<?php endforeach; else: ?>
<tr><td colspan="8" style="text-align:center;">No bookings found.</td></tr>
<?php endif; ?>
</table>

<?php else: ?>
<p style="text-align:center; margin-top:2rem;">🔒 Please <a href="<?= site_url('lushcamp/login') ?>">login</a> to view and manage bookings.</p>
<?php endif; ?>
</div>
</body>
</html>
