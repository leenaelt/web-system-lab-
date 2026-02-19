<?php
session_start();
include 'db.php';
if(!isset($_SESSION['user_id'])){
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM students WHERE id=$id");
$student = $result->fetch_assoc();

if(isset($_POST['update'])){
    $name = $_POST['name'];
    $age = $_POST['age'];
    $course = $_POST['course'];

    $sql = "UPDATE students SET name='$name', age='$age', course='$course' WHERE id=$id";
    if($conn->query($sql)){
        header("Location: dashboard.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<h2>Edit Student</h2>
<form method="POST" action="">
    Name: <input type="text" name="name" value="<?php echo $student['name']; ?>" required><br>
    Age: <input type="number" name="age" value="<?php echo $student['age']; ?>" required><br>
    Course: <input type="text" name="course" value="<?php echo $student['course']; ?>" required><br>
    <button type="submit" name="update">Update Student</button>
</form>
<a href="dashboard.php">Back to Dashboard</a>
