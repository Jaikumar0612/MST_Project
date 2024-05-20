<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "mst"; // Database name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['facultyid'])) {
    // Retrieve faculty ID from POST data
    $faculty_id = $_POST['facultyid'];

    // Prepare and bind the SQL statement
    $sql = "SELECT * FROM students WHERE faculty_id=$faculty_id";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $faculty_id);
    
    // Execute the statement
    if(mysqli_stmt_execute($stmt)) {
        // Get the result
        $result = mysqli_stmt_get_result($stmt);

        // Display student details
        if (mysqli_num_rows($result) > 0) {
            echo "<h3>Student Details:</h3>";
            echo "<table>";
            echo "<tr><th>ID</th><th>Name</th><th>Registration Number</th><th>Date of Birth</th><th>Gender</th><th>Contact Number</th><th>Email</th><th>Course</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>".$row['id']."</td>";
                echo "<td>".$row['student_name']."</td>";
                echo "<td>".$row['regd_no']."</td>";
                echo "<td>".$row['date_of_birth']."</td>";
                echo "<td>".$row['gender']."</td>";
                echo "<td>".$row['contact_no']."</td>";
                echo "<td>".$row['email_id']."</td>";
                echo "<td>".$row['course']."</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No students found for this faculty.";
        }
    } else {
        echo "Error executing query: " . mysqli_error($conn);
    }

    // Close statement
    mysqli_stmt_close($stmt);
}

// Close connection
mysqli_close($conn);
?>
