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
    <title>Add Class</title>
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

input[type="text"] {
    width: 100%;
    padding: 12px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
    transition: 0.3s;
}

input[type="text"]:focus {
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

    input[type="text"], input[type="submit"] {
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
                <a href="#" class="dropbtn">Classes &nbsp <i class="arrow down"></i>
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
                <legend>Add Class</legend>
                <input type="text" name="class_name" placeholder="Class Name">
                <input type="text" name="class_id" placeholder="Class ID">
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
if (isset($_POST['class_name'], $_POST['class_id'])) {
    $name = trim($_POST["class_name"]);
    $id = trim($_POST["class_id"]);

    // Check for empty inputs
    if (empty($name) || empty($id)) {
        echo '<script>alert("Please enter both Class Name and Class ID!");</script>';
        exit();
    }

    // // Check for duplicate class ID before inserting
    // $check_sql = "SELECT id FROM class WHERE id = ?";
    // $stmt_check = $conn->prepare($check_sql);
    // $stmt_check->bind_param("s", $id);
    // $stmt_check->execute();
    // $stmt_check->store_result();

    // if ($stmt_check->num_rows > 0) {
    //     echo '<script>alert("Class ID already exists! Please use a different ID.");</script>';
    //     exit();
    // }

    // // Insert new class
    // $insert_sql = "INSERT INTO `class` (`name`, `id`) VALUES (?, ?)";
    // $stmt = $conn->prepare($insert_sql);
    // $stmt->bind_param("ss", $name, $id);

    // if ($stmt->execute()) {
    //     echo '<script>alert("Class added successfully!");</script>';
    // } else {
    //     echo '<script>alert("Error adding class. Please try again.");</script>';
    // }

// $name = mysqli_real_escape_string($conn, $name);
// $id = mysqli_real_escape_string($conn, $id);

// Check for duplicate class ID
$check_sql = "SELECT id FROM class WHERE id = '$id'";
$result = mysqli_query($conn, $check_sql);

if (mysqli_num_rows($result) > 0) {
    echo '<script>alert("Class ID already exists! Please use a different ID.");</script>';
    mysqli_close($conn);
    exit();
}
// Insert new class
$insert_sql = "INSERT INTO `class` (`name`, `id`) VALUES ('$name', '$id')";
if (mysqli_query($conn, $insert_sql)) {
    echo '<script>alert("Class added successfully!");</script>';
} else {
    echo '<script>alert("Error adding class. Please try again.");</script>';
}
}
?>
