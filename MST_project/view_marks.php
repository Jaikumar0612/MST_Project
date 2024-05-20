<!DOCTYPE html>
<html>
<head>
    <title>View Grades</title>
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
            margin-top: 20px;
            text-align: center;
        }
        label {
            font-weight: bold;
        }
        select {
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>View Grades</h2>
    </div>

    <div class="container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="semester">Select Semester:</label>
            <select name="semester" id="semester">
                <option >Select semester</option>
                <option value="1">Semester 1</option>
                <option value="2">Semester 2</option>
                <option value="3">Semester 3</option>
                <option value="4">Semester 4</option>
                <option value="5">Semester 5</option>
                <option value="6">Semester 6</option>
                <option value="7">Semester 7</option>
            </select>
            <input type="submit" value="View">
        </form>

        <?php
        session_start();
        // Check if regd_no is set in the session
        if (isset($_SESSION['regd_no'])) {
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['semester'])) {
                // Establish connection to database
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "mst";

                $conn = mysqli_connect($servername, $username, $password, $database);
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Fetch grades and subject names for the selected semester
                $regd_no = $_SESSION['regd_no'];
                $semester = $_POST['semester'];
                $sql = "SELECT subject_name, grade FROM marks WHERE regd_no = ? AND semester = ?";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "ss", $regd_no, $semester);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) > 0) {
                    echo "<h3>Grades for Semester " . $semester . ":</h3>";
                    echo "<table>
                            <tr>
                                <th>Subject Name</th>
                                <th>Grade</th>
                            </tr>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['subject_name'] . "</td>";
                        echo "<td>" . $row['grade'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p>No grades available for this semester.</p>";
                }

                // Close statement and connection
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
            }
        } else {
            echo "<p>Please log in to view grades.</p>";
        }
        ?>
    </div>
</body>
</html>
