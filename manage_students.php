<?php
include('init.php');
include('session.php');
if (isset($_GET['delete_rno'])) {
    $delete_rno = mysqli_real_escape_string($conn, $_GET['delete_rno']);


    // $delete_result = "DELETE FROM result WHERE rno = '$delete_rno'";
    // mysqli_query($conn, $delete_result);

 
    $delete_student = "UPDATE students set status = 1 WHERE rno = '$delete_rno'";
    if (mysqli_query($conn, $delete_student)) {
        header("Location: manage_students.php?msg=deleted");
        exit();
    } else {
        header("Location: manage_students.php?msg=error");
        exit();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" />
    <link rel="stylesheet" href="./css/style.css" />
    <title>Dashboard</title>
    <style>
        .main {
            max-width: 1000px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
            border-radius: 5px;
            overflow: hidden;
        }

        table caption {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }

        th, td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #007bff;
            color: white;
        }

        tr:hover {
            background: #f1f1f1;
        }

        @media (max-width: 768px) {
            .nav ul {
                flex-direction: column;
                align-items: center;
            }

            .main {
                width: 90%;
            }

            table {
                font-size: 14px;
            }

            th, td {
                padding: 8px;
            }
        }

        a.edit-link {
            color: green;
            text-decoration: none;
            font-weight: bold;
        }

        a.delete-link {
            color: red;
            text-decoration: none;
            font-weight: bold;
        }

        .message {
            font-weight: bold;
            margin-bottom: 15px;
        }

        .success {
            color: green;
        }

        .error {
            color: red;
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

    <div class="main">
        <?php
            // Display messages
            if (isset($_GET['msg'])) {
                if ($_GET['msg'] === 'deleted') {
                    echo '<script>alert("Student deleted successfully.")</script>';
                } elseif ($_GET['msg'] === 'error') {
                    echo '<script>alert("Failed to delete student.")</script>';
                }
            }

            $sql = "SELECT `name`, `rno`, `class_name`, `phone` FROM `students` where status = 0";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                echo "<table>
                    <caption>Manage Students</caption>
                    <tr> 
                        <th>NAME</th>
                        <th>ROLL NO</th>
                        <th>CLASS</th>
                        <th>PHONE NO</th>
                        <th>EDIT</th>
                        <th>DELETE</th>
                    </tr>";

                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['rno']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['class_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
                    echo "<td><a class='edit-link' href='edit_student.php?rno=" . urlencode($row['rno']) . "'>Edit</a></td>";
                    echo "<td><a class='delete-link' href='manage_students.php?delete_rno=" . urlencode($row['rno']) . "' onclick='return confirm(\"Are you sure you want to delete this student?\");'>Delete</a></td>";

                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "0 Students";
            }
        ?>
    </div>

    <div class="footer">
        <p> Sanjai website &copy; 2025</p>
    </div>
</body>
</html>
