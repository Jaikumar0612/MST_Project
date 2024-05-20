<?php
session_start(); // Start the session

// Check if the user is not logged in
if (!isset($_SESSION['regd_no'])) {
    header("Location: login.html"); // Redirect to login page
    exit(); // Stop further execution
}

$servername = "localhost";
$username = "root";
$password = "";
$database = "mst"; // Database name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if regd_no is passed as a URL parameter
if (isset($_SESSION['regd_no'])) {
    // Retrieve registration number from URL parameter
    $regd_no = $_SESSION['regd_no'];

    // Prepare SQL statement
    $sql = "SELECT * FROM students WHERE regd_no = ?";

    // Prepare and bind SQL statement
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $regd_no);

    // Execute SQL query
    mysqli_stmt_execute($stmt);

    // Get the result
    $result = mysqli_stmt_get_result($stmt);

    // Display student details
    if (mysqli_num_rows($result) > 0) {
        echo "<div style='background-color: #f2f2f2; padding: 20px; border-radius: 10px;'>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<h2>Student Details</h2>";
            echo "<p><strong>ID:</strong> " . $row['id'] . "</p>";
            echo "<p><strong>Name:</strong> " . $row['student_name'] . "</p>";
            echo "<p><strong>Registration Number:</strong> " . $row['regd_no'] . "</p>";
            echo "<p><strong>Date of Birth:</strong> " . $row['date_of_birth'] . "</p>";
            echo "<p><strong>Gender:</strong> " . $row['gender'] . "</p>";
            echo "<p><strong>Contact Number:</strong> " . $row['contact_no'] . "</p>";
            echo "<p><strong>Email:</strong> " . $row['email_id'] . "</p>";
            echo "<p><strong>Course:</strong> " . $row['course'] . "</p>";
        }
        echo "</div>";
    } else {
        echo "No student found for the provided registration number.";
    }

    // Close statement
    mysqli_stmt_close($stmt);
} else {
    echo "Registration number not provided.";
}

// Close connection
mysqli_close($conn);
?>
