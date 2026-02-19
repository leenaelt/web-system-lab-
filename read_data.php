<?php
require "db_connection.php";

// Get selected department (if any)
$selected_department = "";
if (isset($_GET['department'])) {
    $selected_department = $_GET['department'];
}

// Fetch distinct departments for dropdown
$dept_sql = "SELECT DISTINCT department FROM students";
$dept_result = $conn->query($dept_sql);

// Main query
if ($selected_department != "") {
    $sql = "SELECT * FROM students WHERE department = '$selected_department'";
} else {
    $sql = "SELECT * FROM students";
}

$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Filter Students</title>
    <style>
        body { font-family: Arial; }
        table {
            border-collapse: collapse;
            width: 80%;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #333;
            padding: 10px;
        }
        th { background-color: #eaeaea; }
        select, button {
            padding: 5px;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<h2>Filter Students by Department</h2>

<form method="GET" action="">
    <label>Select Department:</label>
    <select name="department">
        <option value="">-- All Departments --</option>

        <?php
        while ($row = $dept_result->fetch_assoc()) {
            $dept = $row['department'];
            $selected = ($dept == $selected_department) ? "selected" : "";
            echo "<option value='$dept' $selected>$dept</option>";
        }
        ?>
    </select>
    <button type="submit">Filter</button>
</form>

<table>
<tr>
    <th>Student Number</th>
    <th>Full Name</th>
    <th>Email</th>
    <th>Department</th>
</tr>

<?php
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row["student_number"] . "</td>";
    echo "<td>" . $row["full_name"] . "</td>";
    echo "<td>" . $row["email"] . "</td>";
    echo "<td>" . $row["department"] . "</td>";
    echo "</tr>";
}
?>

</table>

<p><strong>Total Students: </strong><?php echo $result->num_rows; ?></p>

</body>
</html>

<?php
$conn->close();
?>
