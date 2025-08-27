<?php
session_start();
include("init.php");

if (!isset($_SESSION['student_user'])) {
    header("Location: index.php");
    exit();
}

$userid = $_SESSION['student_user'];

// Fetch student details
$student_query = "SELECT * FROM student_users WHERE username = '$userid'";
$student_result = mysqli_query($conn, $student_query);
$student = mysqli_fetch_assoc($student_result);
$roll_no = $student['roll_no'];

// Fetch student marks
$marks_query = "SELECT * FROM result WHERE rno = '$roll_no'";
$marks_result = mysqli_query($conn, $marks_query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #e3f2fd;
            margin: 0;
            padding: 40px 0;
            display: flex;
            justify-content: center;
        }

        .container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 800px;
        }

        h2 {
            color: #004aad;
            margin-bottom: 20px;
            text-align: center;
        }

        .info {
            font-size: 16px;
            margin: 6px 0;
        }

        .label {
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th {
            background-color: #004aad;
            color: white;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        .logout {
            text-align: center;
            margin-top: 20px;
        }

        .logout a {
            text-decoration: none;
            color: #004aad;
            font-weight: bold;
        }

        .logout a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Welcome, <?php echo htmlspecialchars($student['username']); ?>!</h2>

    <div class="info"><span class="label">Roll No:</span> <?php echo htmlspecialchars($student['roll_no']); ?></div>
    <div class="info"><span class="label">Class ID:</span> <?php echo htmlspecialchars($student['class_id']); ?></div>
    <div class="info"><span class="label">Email:</span> <?php echo htmlspecialchars($student['email']); ?></div>
    <div class="info"><span class="label">Phone:</span> <?php echo htmlspecialchars($student['phone']); ?></div>

    <h3>Your Marks</h3>

    <?php if (mysqli_num_rows($marks_result) > 0): ?>
    <table>
        <tr>
            <th>Subject</th>
            <th>Q1–Q10</th>
            <th>Q11–Q14</th>
            <th>Q15–Q16</th>
            <th>Percentage</th>
            
        </tr>
        <?php while ($row = mysqli_fetch_assoc($marks_result)): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['subject']); ?></td>
            <td>
                <?php
                    $one1to10 = 0;
                    for ($i = 1; $i <= 10; $i++) {
                        $one1to10 += $row["one_$i"];
                    }
                    echo "$one1to10 / 10";
                ?>
            </td>
            <td>
                <?php
                    $q11to14 = 0;
                    for ($i = 1; $i <= 4; $i++) {
                        $q11to14 += $row["five_$i"];
                    }
                    echo "$q11to14 / 20";
                ?>
            </td>
            <td>
                <?php
                    $q15to16 = $row["ten_1"] + $row["ten_2"];
                    echo "$q15to16 / 20";
                ?>
            </td>
            <td><?php echo $row['percentage'] . " %"; ?></td>
             
        </tr>   
        <?php endwhile; ?>
    </table>
    <?php else: ?>
        <p>No marks found yet.</p>
    <?php endif; ?>

    <div class="logout">
        <a href="logout.php">🚪 Logout</a>
    </div>
</div>

</body>
</html>
