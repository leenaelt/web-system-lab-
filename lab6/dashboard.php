<?php
require "session_guard.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

<h2>Welcome, <?= $_SESSION['username'] ?></h2>

<p>This page is protected.</p>
<p>You will be logged out after inactivity.</p>

<a href="logout.php">Logout</a>

</body>
</html>

