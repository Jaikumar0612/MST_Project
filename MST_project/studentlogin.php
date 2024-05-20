<?php
session_start(); // Start the session

$servername = "localhost";
$username = "root";
$password = "";
$database = "mst"; // Database name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $regd_no = $_POST['studentid'];
    $password = $_POST['studentpass'];

    // Prepare and bind the SQL statement
    $sql = "SELECT regd_no, password FROM students WHERE regd_no=? AND password=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $regd_no, $password);

    // Execute the statement
    if(mysqli_stmt_execute($stmt)) {
        // Get the result
        mysqli_stmt_store_result($stmt);
        
        // Check if a row is returned
        if (mysqli_stmt_num_rows($stmt) == 1) {
            // Fetch the row
            mysqli_stmt_bind_result($stmt, $regd_no, $password);
            mysqli_stmt_fetch($stmt);
            
            // Set session variables
            $_SESSION['regd_no'] = $regd_no;
            
            // Redirect to student_portal.php
            header("Location: student_portal.php");
            exit(); // Ensure script stops execution after redirection
        } else {
            echo "Invalid Faculty ID or Password.";
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
