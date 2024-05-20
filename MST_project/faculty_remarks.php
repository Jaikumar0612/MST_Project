<!DOCTYPE html>
<html>
<head>
    <title>Student Remarks</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f7f7f7;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<?php
// Database connection (replace these credentials with your actual database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$database = "mst";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if registration number is set in session
if (isset($_SESSION['regd_no'])) {
    $regd_no = $_SESSION['regd_no'];

    // Fetch and display faculty remarks for each semester
   
    for ($semester = 1; $semester <= 7; $semester++) {
        $stmt = $conn->prepare("SELECT subject_name, remarks FROM marks WHERE regd_no = ? AND semester = ?");
        $stmt->bind_param("ss", $regd_no, $semester);
        $stmt->execute();
        $result = $stmt->get_result();
        echo "<tr><td colspan='2'><strong>Semester " . $semester . "</strong></td></tr>";
        // Display semester header only if there are remarks for the semester
        if ($result->num_rows > 0) {
            echo "<br>";
            echo "<table>";
            echo "<thead><tr><th>Subject Name</th><th>Remarks</th></tr></thead>";
            echo "<tbody>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['subject_name'] . "</td>";
                echo "<td>" . $row['remarks'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='2'>No remarks available for Semester " . $semester . "</td></tr>";
        }
        $stmt->close();
    }
    echo "</tbody>";
    echo "</table>";
} else {
    echo "Registration number not provided.";
}

// Close connection
$conn->close();
?>

</body>
</html>
