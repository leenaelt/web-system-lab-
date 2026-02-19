<?php
require "db_connection.php";

/* =========================
   DELETE ONE STUDENT
========================= */
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_id"])) {
    $delete_id = (int) $_POST["delete_id"];
    $delete_sql = "DELETE FROM students WHERE id = $delete_id";
    mysqli_query($connection, $delete_sql);
    $message = "Student deleted successfully.";
}

/* =========================
   DELETE ALL STUDENTS
========================= */
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_all"])) {
   mysqli_query($conn, $delete_sql);

}

/* =========================
   FETCH STUDENTS
========================= */
$students = [];
$sql = "SELECT * FROM students";
$result = mysqli_query($connection, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $students[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Student Management</title>

<style>
body {
    font-family: Arial;
}

table {
    border-collapse: collapse;
    width: 90%;
}

th, td {
    border: 1px solid #333;
    padding: 10px;
    text-align: center;
}

th {
    background-color: #f2f2f2;
}

.delete-btn {
    background: red;
    color: white;
    border: none;
    padding: 6px 12px;
    cursor: pointer;
}

.delete-all-btn {
    background: black;
    color: white;
    border: none;
    padding: 10px 18px;
    cursor: pointer;
    margin-bottom: 15px;
}

.message {
    color: green;
    font-weight: bold;
    margin-bottom: 10px;
}
</style>
</head>

<body>

<h2>Students List</h2>

<?php if (!empty($message)) { ?>
    <p class="message"><?php echo $message; ?></p>
<?php } ?>

<!-- DELETE ALL BUTTON -->
<form method="POST">
    <button type="submit"
        name="delete_all"
        class="delete-all-btn"
        onclick="return confirm('Are you sure you want to delete ALL students?')">
        Delete All Students
    </button>
</form>

<table>
<tr>
    <th>ID</th>
    <th>Student Number</th>
    <th>Full Name</th>
    <th>Email</th>
    <th>Department</th>
    <th>Action</th>
</tr>

<?php if (!empty($students)) { ?>
    <?php foreach ($students as $student) { ?>
        <tr>
            <td><?php echo htmlspecialchars($student['id']); ?></td>
            <td><?php echo htmlspecialchars($student['student_number']); ?></td>
            <td><?php echo htmlspecialchars($student['full_name']); ?></td>
            <td><?php echo htmlspecialchars($student['email']); ?></td>
            <td><?php echo htmlspecialchars($student['department']); ?></td>
            <td>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="delete_id" value="<?php echo $student['id']; ?>">
                    <button class="delete-btn"
                        onclick="return confirm('Delete this student?')">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
    <?php } ?>
<?php } else { ?>
    <tr>
        <td colspan="6">No students found</td>
    </tr>
<?php } ?>

</table>

</body>
</html>

<?php mysqli_close($connection); ?>
