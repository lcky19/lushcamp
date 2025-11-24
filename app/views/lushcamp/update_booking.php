<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Update Booking</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
<style>
*{margin:0;padding:0;box-sizing:border-box;}
body { font-family:'Poppins',sans-serif; background:linear-gradient(135deg,#ffffff,#e9f8eb); padding:2rem; color:#2E7D32; }
.container { max-width:600px; margin:0 auto; background:rgba(255,255,255,0.9); padding:2rem; border-radius:20px; box-shadow:0 10px 30px rgba(76,175,80,0.2);}
h2 { text-align:center; font-size:2rem; margin-bottom:1.5rem; background:linear-gradient(135deg,#2E7D32,#4CAF50); -webkit-background-clip:text; -webkit-text-fill-color:transparent; }
form label { display:block; margin-top:1rem; font-weight:600; }
form input[type=text], form input[type=date], form input[type=time], form select { width:100%; padding:0.5rem; border-radius:8px; border:1px solid #a5d6a7; margin-top:0.3rem; }
img { display:block; margin-top:0.5rem; border-radius:8px; max-width:200px; }
button { margin-top:1.5rem; width:100%; padding:0.7rem; border:none; border-radius:10px; background:linear-gradient(135deg,#2E7D32,#4CAF50); color:white; font-weight:600; cursor:pointer; transition:0.3s; }
button:hover { transform:scale(1.05); box-shadow:0 6px 20px rgba(76,175,80,0.4); }
</style>
</head>
<body>
<div class="container">
<h2>Update Booking</h2>

<form method="post" enctype="multipart/form-data">

<label>Type</label>
<input type="text" name="type" value="<?= htmlspecialchars($booking['type']) ?>">

<label>Date</label>
<input type="date" name="date" value="<?= htmlspecialchars($booking['date']) ?>">

<label>Time</label>
<input type="time" name="time" value="<?= htmlspecialchars($booking['time']) ?>">

<label>Service</label>
<input type="text" name="service" value="<?= htmlspecialchars($booking['service']) ?>">

<label>Status</label>
<select name="status">
    <option value="pending" <?= $booking['status']=='pending'?'selected':'' ?>>Pending</option>
    <option value="approved" <?= $booking['status']=='approved'?'selected':'' ?>>Approved</option>
    <option value="declined" <?= $booking['status']=='declined'?'selected':'' ?>>Declined</option>
</select>

<hr>

<h3>Payment Proof</h3>
<?php if (!empty($booking['payment_image'])): ?>
    <a href="/uploads/payments/<?= $booking['payment_image'] ?>" target="_blank">
        <img src="/uploads/payments/<?= $booking['payment_image'] ?>">
    </a>
<?php else: ?>
    <p>No payment uploaded.</p>
<?php endif; ?>

<label>Payment Status</label>
<select name="payment_status">
    <option value="unverified" <?= $booking['payment_status']=='unverified'?'selected':'' ?>>Unverified</option>
    <option value="verified" <?= $booking['payment_status']=='verified'?'selected':'' ?>>Verified</option>
    <option value="rejected" <?= $booking['payment_status']=='rejected'?'selected':'' ?>>Rejected</option>
</select>

<button type="submit">Update Booking</button>

</form>
</div>
</body>
</html>
