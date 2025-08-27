<?php
include("init.php");
include("session.php"); // Ensure this file has the $conn variable for DB connection.
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Marks Entry Dashboard</title>
    <style>
        .main {
            width: 80%;
            margin: 30px auto;
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        fieldset {
            border: 2px solid #3498db;
            padding: 20px;
            border-radius: 8px;
        }

        .marks-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .marks-section {
            background: #ecf0f1;
            padding: 20px;
            border-radius: 8px;
        }

        .marks-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .two-column {
            display: flex;
            gap: 20px;
        }

        .left-section, .right-section {
            flex: 1;
        }

        .input-container {
            display: flex;
            align-items: center;
            gap: 10px;
            background: white;
            padding: 8px;
            border: 2px solid #3498db;
            border-radius: 8px;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
            transition: 0.3s ease-in-out;
        }

        .input-container:hover {
            border-color: #007bff;
            box-shadow: 2px 2px 10px rgba(0, 123, 255, 0.3);
        }

        .input-container label {
            font-weight: bold;
            font-size: 16px;
        }

        .input-container input[type="number"] {
            width: 60px;
            text-align: center;
            padding: 8px;
            border: none;
            outline: none;
            font-size: 16px;
            border-radius: 5px;
            background: #f8f9fa;
            transition: 0.3s;
        }

        .input-container input[type="number"]:focus {
            background: white;
            box-shadow: inset 0 0 5px rgba(0, 123, 255, 0.3);
        }

        select, input[type="text"] {
            width: calc(100% - 20px);
            padding: 10px;
            border: 2px solid #3498db;
            border-radius: 5px;
            font-size: 16px;
            margin-bottom: 10px;
            transition: 0.3s;
        }

        select:focus, input[type="text"]:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
        }

        .submit-btn {
            background: #007bff;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 10px;
        }

        .submit-btn:hover {
            background: #0056b3;
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
                <a href="" class="dropbtn">Classes &nbsp <i class="arrow down"></i>
                </a>
                <div class="dropdown-content" id="1">
                    <a href="add_classes.php">Add Class</a>
                    <a href="manage_classes.php">Manage Class</a>
                </div>
            </li>
            <li class="dropdown" onclick="toggleDisplay('2')">
                <a href="#" class="dropbtn">Students &nbsp <i class="arrow down"></i>
                </a>
                <div class="dropdown-content" id="2">
                    <a href="add_students.php">Add Students</a>
                    <a href="manage_students.php">Manage Students</a>
                </div>
            </li>
            <li class="dropdown" onclick="toggleDisplay('3')">
                <a href="#" class="dropbtn">Results &nbsp <i class="arrow down"></i>
                </a>
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
                <legend>Enter Marks</legend>
                <label>Select Class</label>
                <select name="class_name" required>
                    <option selected disabled>Select Class</option>
                    <?php
                    $class_result = mysqli_query($conn, "SELECT name FROM class");
                    while ($row = mysqli_fetch_array($class_result)) {
                        echo '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
                    }
                    ?>
                </select><br>

                <input type="text" name="rno" placeholder="Enter Roll No" required><br>

                <label for="subject">Subject:</label>
                <select name="subject" required>
                            <option value="">Select Subject</option>
                            <option value="php">PHP</option>
                            <option value="c++">C++</option>
                            <option value="dsa">DSA</option>
                            <option value="python">Python</option>
                            <option value="web design">Web Design</option>
                            <option value="digital electronics">Digital Electronics</option>
                        </select><br>

                <div class="marks-container">
                    <div class="marks-section">
                        <h3>One Mark Questions</h3>
                        <div class="marks-grid">
                            <?php
                            for ($i = 1; $i <= 10; $i++) {
                                echo '<div class="input-container">
                                        <label>' . $i . '.</label>
                                        <input type="number" name="one_' . $i . '" min="0" max="1" required>
                                      </div>';
                            }
                            ?>
                        </div>
                    </div>

                    <div class="two-column">
                        <div class="marks-section left-section">
                            <h3>Five Mark Questions</h3>
                            <?php
                            for ($i = 1; $i <= 4; $i++) {
                                echo '<div class="input-container">
                                        <label>' . (10 + $i) . '.</label>
                                        <input type="number" name="five_' . $i . '" min="0" max="5" required>
                                        <input type="radio" name="five_opt_' . $i . '" value="A" required> A
                                        <input type="radio" name="five_opt_' . $i . '" value="B" required> B
                                      </div>';
                            }
                            ?>
                        </div>

                        <div class="marks-section right-section">
                            <h3>Ten Mark Questions</h3>
                            <?php
                            for ($i = 1; $i <= 2; $i++) {
                                echo '<div class="input-container">
                                        <label>' . (14 + $i) . '.</label>
                                        <input type="number" name="ten_' . $i . '" min="0" max="10" required>
                                        <input type="radio" name="ten_opt_' . $i . '" value="A" required> A
                                        ' . ($i == 2 ? '<input type="radio" name="ten_opt_2" value="B"> B' : '') . '
                                      </div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <div style="text-align: center; margin-top: 20px;">
                    <input type="submit" name="submit" value="Submit" class="submit-btn">
                </div>
            </fieldset>
        </form>
    </div>
</body>
</html>

<?php


if (isset($_POST['submit'])) {
    $rno = mysqli_real_escape_string($conn, $_POST['rno']);
    $class = mysqli_real_escape_string($conn, $_POST['class_name']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);

    // Check if the student exists
    $student_query = "SELECT name, phone FROM students WHERE rno = '$rno'";
    $result = mysqli_query($conn, $student_query);

    if ($row = mysqli_fetch_assoc($result)) {
        $student_name = $row['name']; 
        $phone_number = '+91' . ($row['phone'] ?? ''); // Append country code
    } else {
        echo "<script>alert('Student not found!');</script>";
        exit();
    }

    // Fetch marks from form
    $one_total = 0;
    $five_total = 0;
    $ten_total = 0;

    $one_marks = [];
    for ($i = 1; $i <= 10; $i++) {
        $one_marks["one_$i"] = (int)$_POST["one_$i"];
        $one_total += $one_marks["one_$i"];
    }

    $five_marks = [];
    $five_options = [];
    for ($i = 1; $i <= 4; $i++) {
        $five_marks["five_$i"] = (int)$_POST["five_$i"];
        $five_options["five_opt_$i"] = mysqli_real_escape_string($conn, $_POST["five_opt_$i"]);
        $five_total += $five_marks["five_$i"];
    }

    $ten_marks = [];
    $ten_options = [];
    for ($i = 1; $i <= 2; $i++) {
        $ten_marks["ten_$i"] = (int)$_POST["ten_$i"];
        $ten_options["ten_opt_$i"] = mysqli_real_escape_string($conn, $_POST["ten_opt_$i"]);
        $ten_total += $ten_marks["ten_$i"];
    }

    // Calculate total marks and percentage
    $max_marks = 50; // Adjust as needed
    $total_marks = $one_total + $five_total + $ten_total;
    $percentage = ($total_marks / $max_marks) * 100;

    // Insert into `result` table (allows multiple subjects for same roll number)
    $query = "INSERT INTO result (
        rno, name, class, subject, marks, percentage,
        one_1, one_2, one_3, one_4, one_5, one_6, one_7, one_8, one_9, one_10,
        five_1, five_opt_1, five_2, five_opt_2, five_3, five_opt_3, five_4, five_opt_4,
        ten_1, ten_opt_1, ten_2, ten_opt_2
    ) VALUES (
        '$rno', '$student_name', '$class', '$subject', '$total_marks', '$percentage',
        '{$one_marks["one_1"]}', '{$one_marks["one_2"]}', '{$one_marks["one_3"]}', '{$one_marks["one_4"]}', 
        '{$one_marks["one_5"]}', '{$one_marks["one_6"]}', '{$one_marks["one_7"]}', '{$one_marks["one_8"]}', 
        '{$one_marks["one_9"]}', '{$one_marks["one_10"]}',
        '{$five_marks["five_1"]}', '{$five_options["five_opt_1"]}', '{$five_marks["five_2"]}', '{$five_options["five_opt_2"]}', 
        '{$five_marks["five_3"]}', '{$five_options["five_opt_3"]}', '{$five_marks["five_4"]}', '{$five_options["five_opt_4"]}', 
        '{$ten_marks["ten_1"]}', '{$ten_options["ten_opt_1"]}', '{$ten_marks["ten_2"]}', '{$ten_options["ten_opt_2"]}'
    )";

// Execute query with duplicate entry handling
try {
  
    mysqli_query($conn, $query);

    // Send SMS if phone number exists
    if (!empty($row['phone'])) {
        sendSMS($phone_number, $student_name, $rno, $subject, $total_marks, $percentage);
    }

    echo "<script>alert('Result Added Successfully! SMS sent.'); window.location.href='manage_results.php';</script>";

} catch (mysqli_sql_exception $e) {
    if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
        echo "<script>alert('Error: Duplicate result already exists for this student and subject.');</script>";
    } else {
        $safe_error = addslashes($e->getMessage());
        echo "<script>alert('Database Error: {$safe_error}');</script>";
    }
}

}

// Function to send SMS using Twilio API
function sendSMS($phone, $student_name, $roll_no, $subject, $marks, $percentage) {
    $sid = 'your twilio sid';
    $token = 'your twilio token';
    $twilio_number = 'your twilio number';

    // Updated SMS message with subject
    $message = "Dear $student_name, your result for $subject has been recorded.\nRoll No: $roll_no\nTotal Marks: $marks\nPercentage: $percentage%";

    $url = 'https://api.twilio.com/2010-04-01/Accounts/' . $sid . '/Messages.json';

    $data = [
        'From' => $twilio_number,
        'To' => $phone,
        'Body' => $message,
    ];

    $options = [
        'http' => [
            'header' => "Authorization: Basic " . base64_encode($sid . ":" . $token) . "\r\n" .
                        "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data),
        ],
    ];

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    if ($result === FALSE) {
        echo "Failed to send SMS.";
    } else {
        echo "SMS sent successfully!";
    }
}

?>
