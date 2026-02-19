<?php
session_start();
include 'db.php';

if(isset($_POST['signup'])){
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // تشفير كلمة المرور

    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    if($conn->query($sql)){
        $_SESSION['user_id'] = $conn->insert_id;
        header("Location: dashboard.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<form method="POST" action="">
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit" name="signup">Sign Up</button>
</form>
