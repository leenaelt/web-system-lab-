<?php
session_start();
include 'db.php';
if(!isset($_SESSION['user_id'])){
    header("Location: index.php");
    exit();
}

$students = $conn->query("SELECT * FROM students");
?>

<h2>Dashboard</h2>
<a href="add_student.php">Add Student</a> | <a href="logout.php">Logout</a>

<table border="1">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Age</th>
    <th>Course</th>
    <th>Actions</th>
</tr>
<?php while($row = $students->fetch_assoc()){ ?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['age']; ?></td>
    <td><?php echo $row['course']; ?></td>
    <td>
        <a href="edit_student.php?id=<?php echo $row['id']; ?>">Edit</a> |
        <a href="delete_student.php?id=<?php echo $row['id']; ?>">Delete</a>
    </td>
</tr>
<?php } ?>
</table>
