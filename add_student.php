<?php
session_start();
include 'db.php';
if(!isset($_SESSION['user_id'])){
    header("Location: index.php");
    exit();
}

if(isset($_POST['add'])){
    $name = $_POST['name'];
    $age = $_POST['age'];
    $course = $_POST['course'];

    $sql = "INSERT INTO students (name, age, course) VALUES ('$name', '$age', '$course')";
    if($conn->query($sql)){
        header("Location: dashboard.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<h2>Add Student</h2>
<form method="POST" action="">
    Name: <input type="text" name="name" required><br>
    Age: <input type="number" name="age" required><br>
    Course: <input type="text" name="course" required><br>
    <button type="submit" name="add">Add Student</button>
</form>
<a href="dashboard.php">Back to Dashboard</a>
