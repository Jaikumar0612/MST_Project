<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Portal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f7f7f7;
        }
        h2 {
            margin-bottom: 10px;
            text-align: center;
            color: blue; /* Change color to blue */
        }
        .container {
            border: 2px solid blue; /* Change border color to blue */
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            width: 50%;
            margin: 0 auto;
            padding: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }
        select, input[type="text"], input[type="submit"] {
            padding: 8px;
            margin: 5px;
            border-radius: 4px;
            border: 1px solid blue; /* Change border color to blue */
            width: 100%;
            max-width: 300px;
        }
        input[type="submit"] {
            background-color: blue; /* Change background color to blue */
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0066cc; /* Darker shade of blue on hover */
        }
        .success-message {
            color: green;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome to Faculty Portal</h2>
        <p>This portal allows faculty members to manage students' marks and provide remarks.</p>

        <?php
        session_start();

        // Check if faculty is logged in
        if (!isset($_SESSION['facultyid'])) {
            header("Location: login.html");
            exit;
        }

        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "mst";

        $conn = mysqli_connect($servername, $username, $password, $database);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Check if form is submitted and a student is selected
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['regd_no']) && isset($_POST['semester'])) {
            // Retrieve selected student's registration number and selected semester
            $selected_regd_no = $_POST['regd_no'];
            $selected_semester = $_POST['semester'];

            // Prepare SQL statement to retrieve student's marks for the selected semester
            $sql = "SELECT * FROM marks WHERE regd_no = ? AND semester = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ss", $selected_regd_no, $selected_semester);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            // Display student's marks and provide input fields for remarks
            echo "<h2>Student's Marks</h2>";
            echo "<form action='faculty_portal.php' method='post'>";
            echo "<table>
                    <tr>
                        <th>Subject Name</th>
                        <th>Semester</th>
                        <th>Grade</th>
                        <th>Remarks</th>
                    </tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['subject_name'] . "</td>";
                echo "<td>" . $row['semester'] . "</td>";
                echo "<td>" . $row['grade'] . "</td>";
                echo "<td><input type='text' name='remarks[" . $row['id'] . "]' value='" . $row['remarks'] . "'></td>";
                echo "</tr>";
            }
            echo "</table>";
            echo "<input type='hidden' name='regd_no' value='" . $selected_regd_no . "'>";
            echo "<input type='hidden' name='semester' value='" . $selected_semester . "'>";
            echo "<input type='submit' value='Submit Remarks'>";
            echo "</form>";

            // Close statement
            mysqli_stmt_close($stmt);
        } else {
            // Retrieve faculty ID from session
            $faculty_id = $_SESSION['facultyid'];

            // Prepare SQL statement to retrieve list of students under faculty
            $sql_students = "SELECT regd_no, student_name FROM students WHERE faculty_id = ?";
            $stmt_students = mysqli_prepare($conn, $sql_students);
            mysqli_stmt_bind_param($stmt_students, "s", $faculty_id);
            mysqli_stmt_execute($stmt_students);
            $result_students = mysqli_stmt_get_result($stmt_students);

            // Display form to select a student and semester
            echo "<h2>Select Student and Semester</h2>";
            echo "<form action='faculty_portal.php' method='post'>";
            echo "<select name='regd_no'>";
            while ($row_student = mysqli_fetch_assoc($result_students)) {
                echo "<option value='" . $row_student['regd_no'] . "'>" . $row_student['student_name'] . "</option>";
            }
            echo "</select>";
            echo "<select name='semester'>
                    <option value='1'>Semester 1</option>
                    <option value='2'>Semester 2</option>
                    <option value='3'>Semester 3</option>
                    <option value='4'>Semester 4</option>
                    <option value='5'>Semester 5</option>
                    <option value='6'>Semester 6</option>
                    <option value='7'>Semester 7</option>
                </select>";
            echo "<input type='submit' value='Select'>";
            echo "</form>";

            // Close statement
            mysqli_stmt_close($stmt_students);
        }

        // Check if form is submitted with remarks
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remarks'])) {
            // Retrieve selected student's registration number, semester, and remarks
            $selected_regd_no = $_POST['regd_no'];
            $selected_semester = $_POST['semester'];
            $remarks = $_POST['remarks'];

            // Update remarks in the database
            foreach ($remarks as $mark_id => $remark) {
                $sql_update = "UPDATE marks SET remarks = ? WHERE id = ?";
                $stmt_update = mysqli_prepare($conn, $sql_update);
                mysqli_stmt_bind_param($stmt_update, "si", $remark, $mark_id);
                mysqli_stmt_execute($stmt_update);
                mysqli_stmt_close($stmt_update);
            }

            // Provide feedback to the faculty member
            echo "<p class='success-message'>Remarks submitted successfully.</p>";
        }

        // Close connection
        mysqli_close($conn);
        ?>
    </div>
</body>
</html>
