<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $faculty_id = $_POST['faculty_id'];
    $faculty_name = $_POST['faculty_name'];
    $password = $_POST['faculty_password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate form data
    if (empty($faculty_name) || empty($faculty_id) || empty($password) || empty($confirm_password)) {
        echo "All fields are required.";
    } elseif ($password != $confirm_password) {
        echo "Password and Confirm Password do not match.";
    } else {
        // Database connection
        $servername = "localhost";
        $username = "root";
        $db_password = ""; // Renamed to db_password to avoid conflict with $password
        $database = "mst";

        // Create connection
        $conn = mysqli_connect($servername, $username, $db_password, $database);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare SQL statement
        $sql = "INSERT INTO faculty (faculty_id, faculty_name, password) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            // Bind parameters
            mysqli_stmt_bind_param($stmt, "sss", $faculty_id, $faculty_name, $hashed_password);

            // Execute the statement
            if (mysqli_stmt_execute($stmt)) {
                echo "Signup successful.";
            } else {
                echo "Error: " . mysqli_error($conn);
            }

            // Close statement
            mysqli_stmt_close($stmt);
        } else {
            echo "Error preparing statement.";
        }
        header("Location: Login.html"); // Redirect to login page
        exit; // Ensure script stops execution after redirection

        // Close connection
        mysqli_close($conn);
    }
}
?>
