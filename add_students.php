<?php
include('init.php');
include('session.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <title>Add Students</title>
    <style>
        /* Main Content */
        .main {
            max-width: 500px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Form Styling */
        fieldset {
            border: none;
        }

        legend {
            font-size: 22px;
            font-weight: bold;
            color: #333;
        }

        input[type="text"], select {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            transition: 0.3s;
        }

        input[type="text"]:focus, select:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
            outline: none;
        }

        input[type="submit"] {
            width: 100%;
            background: #007bff;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        input[type="submit"]:hover {
            background: #0056b3;
        }

        /* Error Message */
        .error {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav ul {
                flex-direction: column;
                align-items: center;
            }

            .main {
                width: 90%;
            }

            input[type="text"], select, input[type="submit"] {
                font-size: 14px;
            }
        }

    </style>
</head>
<body>
    <div class="title">
        <span class="heading">Dashboard</span>
        <a href="logout.php" style="color: white">Logout</a>
    </div>

    <div class="nav">
        <ul>
            <li class="dropdown" onclick="toggleDisplay('1')">
                <a href="" class="dropbtn">Classes &nbsp <i class="arrow down"></i></a>
                <div class="dropdown-content" id="1">
                    <a href="add_classes.php">Add Class</a>
                    <a href="manage_classes.php">Manage Class</a>
                </div>
            </li>
            <li class="dropdown" onclick="toggleDisplay('2')">
                <a href="#" class="dropbtn">Students &nbsp <i class="arrow down"></i></a>
                <div class="dropdown-content" id="2">
                    <a href="add_students.php">Add Students</a>
                    <a href="manage_students.php">Manage Students</a>
                </div>
            </li>
            <li class="dropdown" onclick="toggleDisplay('3')">
                <a href="#" class="dropbtn">Results &nbsp <i class="arrow down"></i></a>
                <div class="dropdown-content" id="3">
                    <a href="add_results.php">Add Results</a>
                    <a href="manage_results.php">Manage Results</a>
                </div>
            </li>
        </ul>
    </div>

    <div class="main">
        <form action="" method="post">
            <fieldset>
                <legend>Add Student</legend>
                <input type="text" name="student_name" placeholder="Student Name">
                <input type="text" name="roll_no" placeholder="Roll No">
                <input type="text" name="phone_number" placeholder="Phone Number">
                <?php
                    $class_result = mysqli_query($conn, "SELECT `name` FROM `class`");
                    echo '<select name="class_name">';
                    echo '<option selected disabled>Select Class</option>';
                    while($row = mysqli_fetch_array($class_result)){
                        $display = $row['name'];
                        echo '<option value="' . $display . '">' . $display . '</option>';
                    }
                    echo '</select>';
                ?>
                <input type="submit" value="Submit">
            </fieldset>
        </form>
    </div>

    <div class="footer">
        <p> Sanjai website &copy; 2025</p>
    </div>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];

    $name = trim($_POST['student_name']);
    $rno = trim($_POST['roll_no']);
    $phone = trim($_POST['phone_number']);
    $class_name = $_POST['class_name'] ?? null;

    // Clean the phone number by removing any non-numeric characters
    $phone = preg_replace("/[^0-9]/", "", $phone);

    // Validate inputs
    if (empty($name)) {
        $errors[] = "Please enter a name.";
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $errors[] = "No numbers or symbols allowed in the name.";
    }

    if (empty($rno)) {
        $errors[] = "Please enter a roll number.";
    } elseif (!preg_match("/^[a-zA-Z0-9]*$/", $rno)) {
        $errors[] = "Roll number can only contain letters and numbers.";
    }

    if (empty($phone)) {
        $errors[] = "Please enter a phone number.";
    } elseif (strlen($phone) != 10) {
        $errors[] = "Phone number must be exactly 10 digits.";
    }

    if (empty($class_name)) {
        $errors[] = "Please select a class.";
    }

    // Show errors if any
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo '<p class="error">'.$error.'</p>';
        }
        exit();
    }

    // // Escape data for database security
    // $name = mysqli_real_escape_string($conn, $name);
    // $rno = mysqli_real_escape_string($conn, $rno);
    // $phone = mysqli_real_escape_string($conn, $phone);
    // $class_name = mysqli_real_escape_string($conn, $class_name);

    // Check if the roll number already exists
    $check_query = "SELECT * FROM `students` WHERE `rno` = '$rno'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo '<script>alert("Roll number already exists. Please use a different one.")</script>';
    } else {
        // Insert student data into the database
        $sql = "INSERT INTO `students` (`name`, `rno`, `phone`, `class_name`) VALUES ('$name', '$rno', '$phone', '$class_name')";
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            echo "Error: " . mysqli_error($conn);  // Display error message from MySQL
            echo '<script>alert("Error adding student. Try again.")</script>';
        } else {
            echo '<script>alert("Student added successfully!")</script>';
        }
    }
}
?>
