<!DOCTYPE html>
<html>
<head>
    <title>Parent Portal</title>
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
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }
        .profile, .marks, .remarks {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            width: 30%;
        }
        h3 {
            margin-top: 0;
        }
        button {
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
        }
        button:hover {
            background-color: #0066cc; /* Darker shade of blue on hover */
        }
        .remarks p {
            padding: 8px 0;
            border-bottom: 1px solid #ccc;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Welcome to the Parent Portal</h2>
    </div>

    <div class="container">
        <div class="profile">
            <!-- Student Profile Section -->
            <h3>Student Profile</h3>
            <?php include 'student_profile.php'; ?>
        </div>

        <div class="marks">
            <!-- Marks Entry Section -->
            <h3>View Marks</h3>
             <?php
                // Check if registration number is set
                if(isset($_SESSION['regd_no'])) {
                    $regd_no = $_SESSION['regd_no'];
                    echo "<button onclick=\"location.href='view_marks.php?regd_no=" . urlencode($regd_no) . "'\">View Marks</button><br/>";
                } else {
                    echo "Error: Registration number not provided.";
                }
            ?>
        </div>

        <div class="remarks">
            <!-- Remarks Section -->
            <h3>Faculty Remarks</h3>
            <?php include 'faculty_remarks.php'; ?>
            
        </div>
    </div>
</body>
</html>
