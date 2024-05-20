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

// Function to sanitize input data
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $student_name = sanitize_input($_POST['student_name']);
    $regd_no = sanitize_input($_POST['Regd_No']);
    $date_of_birth = sanitize_input($_POST['date_of_birth']);
    $gender = sanitize_input($_POST['gender']);
    $contact_no = sanitize_input($_POST['contact_no']);
    $email_id = sanitize_input($_POST['email_id']);
    $course = sanitize_input($_POST['course']);
    $faculty_id = sanitize_input($_POST['facultyid']);
    $password = sanitize_input($_POST['Password']);
    $confirm_password = sanitize_input($_POST['confirm_password']);

    // Insert data into the database
    $sql = "INSERT INTO students (student_name, regd_no, date_of_birth, gender, contact_no, email_id, course, faculty_id, password)
            VALUES ('$student_name', '$regd_no', '$date_of_birth', '$gender', '$contact_no', '$email_id', '$course', '$faculty_id', '$password')";

    if (mysqli_query($conn, $sql)) {
        echo "New record inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Close connection
mysqli_close($conn);
header("Location: Login.html");
exit();
?>
