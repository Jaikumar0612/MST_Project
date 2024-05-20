<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "mst";

$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $faculty_id = $_POST['facultyid'];
    $password = $_POST['facultypass'];
    if(!$faculty_id){
        echo "faculty id doesnot retirved";
    }
    // Prepare SQL statement
    $sql = "SELECT faculty_id FROM faculty WHERE faculty_id=? AND password=?";
    $stmt = mysqli_prepare($conn, $sql);
    
    if ($stmt) {
        // Bind parameters
        mysqli_stmt_bind_param($stmt, "ss", $faculty_id, $password);
        
        // Execute the statement
        if(mysqli_stmt_execute($stmt)) {
            // Store result
            mysqli_stmt_store_result($stmt);
            
            // Check if a row is returned
            if (mysqli_stmt_num_rows($stmt) == 1) {
                // Set session variables
                $_SESSION['facultyid'] = $faculty_id;
                
                // Redirect to faculty portal page
                header("Location: faculty_portal.php");
                exit();
            } else {
                $login_error = "Invalid Faculty ID or Password.";
            }
        } else {
            $login_error = "Error executing query: " . mysqli_error($conn);
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    } else {
        $login_error = "Error preparing statement.";
    }
}

// Close connection
mysqli_close($conn);
?>
