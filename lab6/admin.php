<?php
session_start();

// حماية الصفحة — فقط للمسجلين
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Page</title>
</head>
<body>

<h2>Welcome <?= htmlspecialchars($username) ?></h2>

<p>You are logged in successfully.</p>

<a href="logout.php">Logout</a>

</body>
</html>
