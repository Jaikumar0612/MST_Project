<!DOCTYPE html>
<html>
<head>
    <title>Enter Marks</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f7f7f7;
        }
        .header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            width: 50%;
            margin: auto;
        }
        form {
            display: grid;
            grid-template-columns: 1fr 1fr; /* Display two columns */
            grid-gap: 10px;
            margin-top: 20px;
        }
        label {
            font-weight: bold;
        }
        select, input[type="text"] {
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
            width: 100%;
        }
        input[type="submit"] {
            background-color: blue; /* Change to blue */
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            grid-column: span 2; /* Span both columns */
        }
        input[type="submit"]:hover {
            background-color: #0066cc; /* Darker shade of blue on hover */
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Enter Marks</h2>
    </div>

    <div class="container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="semester">Select Semester:</label>
            <select name="semester" id="semester">
                <option>Select semester</option>
                <option value="1">Semester 1</option>
                <option value="2">Semester 2</option>
                <option value="3">Semester 3</option>
                <option value="4">Semester 4</option>
                <option value="5">Semester 5</option>
                <option value="6">Semester 6</option>
                <option value="7">Semester 7</option>
            </select>

            <?php
            session_start();
            // Check if regd_no is set in the session
            if (isset($_SESSION['regd_no'])) {
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Establish connection to database
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $database = "mst";

                    $conn = mysqli_connect($servername, $username, $password, $database);
                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }

                    // Prepare and execute SQL insert statements
                    $regd_no = $_SESSION['regd_no']; // Fetch regd_no from session
                    $sql = "INSERT INTO marks (regd_no, subject_name, semester, grade) VALUES (?, ?, ?, ?)";
                    $stmt = mysqli_prepare($conn, $sql);

                    $subjects = array("subject1", "subject2", "subject3", "subject4", "subject5");
                    foreach ($subjects as $subject) {
                        $subject_name = $_POST[$subject . "_name"];
                        $grade = $_POST[$subject . "_grade"];
                        mysqli_stmt_bind_param($stmt, "ssis", $regd_no, $subject_name, $_POST['semester'], $grade);
                        mysqli_stmt_execute($stmt);
                    }

                    // Close statement and connection
                    mysqli_stmt_close($stmt);
                    mysqli_close($conn);

                    // Redirect to student_portal.php
                    header("Location: student_portal.php");
                    exit;
                }
            } else {
                echo "<p>Please log in to enter marks.</p>";
            }
            ?>

            <label for="subject1_name">Subject 1:</label>
            <input type="text" name="subject1_name">
            <label for="subject1_grade">Grade:</label>
            <input type="text" name="subject1_grade">

            <label for="subject2_name">Subject 2:</label>
            <input type="text" name="subject2_name">
            <label for="subject2_grade">Grade:</label>
            <input type="text" name="subject2_grade">

            <label for="subject3_name">Subject 3:</label>
            <input type="text" name="subject3_name">
            <label for="subject3_grade">Grade:</label>
            <input type="text" name="subject3_grade">

            <label for="subject4_name">Subject 4:</label>
            <input type="text" name="subject4_name">
            <label for="subject4_grade">Grade:</label>
            <input type="text" name="subject4_grade">

            <label for="subject5_name">Subject 5:</label>
            <input type="text" name="subject5_name">
            <label for="subject5_grade">Grade:</label>
            <input type="text" name="subject5_grade">

            <input type="submit" value="Submit">
        </form>
    </div>

    <!-- Include JavaScript file if needed -->

</body>
</html>
