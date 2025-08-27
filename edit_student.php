<?php
include('init.php');
include('session.php');

// Check if rno is provided
if (!isset($_GET['rno'])) {
    header("Location: manage_students.php");
    exit();
}

$rno =$_GET['rno'];


$query = "SELECT * FROM students WHERE rno = '$rno'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) != 1) {
    echo "Student not found.";
    exit();
}

$student = mysqli_fetch_assoc($result);


if (isset($_POST['update'])) {
    $nrno = $_POST['rno'];
    $name =  $_POST['name'];
    $class_name =  $_POST['class_name'];
    $phone =  $_POST['phone'];

    // Check for duplicate roll number (only if changed)
    if ($nrno !== $rno) {
        $check_rno = "SELECT rno FROM students WHERE rno = '$nrno'";
        $check_result = mysqli_query($conn, $check_rno);
        if (mysqli_num_rows($check_result) > 0) {
            $error = "Roll number already exists. Please choose a different one.";
        }
    }

    // Proceed with update if no error
    if (!isset($error)) {
        $update_query = "UPDATE students SET rno='$nrno', name='$name', class_name='$class_name', phone='$phone' WHERE rno='$rno'";
        if (mysqli_query($conn, $update_query)) {
            header("Location: manage_students.php?msg=updated");
            exit();
        } else {
            $error = "Update failed. Please try again.";
        }
    }
}

// Fetch class options
$class_options = [];
$class_query = mysqli_query($conn, "SELECT name FROM class ORDER BY name ASC");
while ($row = mysqli_fetch_assoc($class_query)) {
    $class_options[] = $row['name'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Edit Student</title>
    <link rel="stylesheet" href="./css/style.css" />
    <style>
        .edit-form {
            max-width: 600px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .edit-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .edit-form label {
            display: block;
            margin: 10px 0 5px;
        }

        .edit-form input,
        .edit-form select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        .edit-form select {
            background-color: #fff;
            appearance: none;
            background-image: url("data:image/svg+xml;utf8,<svg fill='%23333' height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/></svg>");
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 16px;
            cursor: pointer;
        }

        .edit-form button {
            background-color: #007bff;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        .edit-form button:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            font-weight: bold;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 15px;
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
                <a href="#" class="dropbtn">Classes &nbsp <i class="arrow down"></i></a>
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

<div class="edit-form">
    <h2>Edit Student</h2>
    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="POST">
        <label for="rno">Roll Number</label>
        <input type="text" name="rno" id="rno" value="<?= htmlspecialchars($student['rno']) ?>" required>

        <label for="name">Student Name</label>
        <input type="text" name="name" id="name" value="<?= htmlspecialchars($student['name']) ?>" required>

        <label for="class_name">Class Name</label>
        <select name="class_name" id="class_name" required>
            <option value="">-- Select Class --</option>
            <?php
            foreach ($class_options as $class) {
                $selected = ($class === $student['class_name']) ? 'selected' : '';
                echo "<option value=\"" . htmlspecialchars($class) . "\" $selected>" . htmlspecialchars($class) . "</option>";
            }
            ?>
        </select>

        <label for="phone">Phone Number</label>
        <input type="text" name="phone" id="phone" value="<?= htmlspecialchars($student['phone']) ?>" required>

        <button type="submit" name="update">Update Student</button>
    </form>

    <a class="back-link" href="manage_students.php">Back to Manage Students</a>
</div>

</body>
</html>
