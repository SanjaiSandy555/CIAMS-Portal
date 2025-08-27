<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Result</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 800px;
            margin-top: 50px;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .table {
            margin-top: 20px;
        }
        .table th {
            background-color: #007bff;
            color: white;
            text-align: center;
        }
        .table td {
            text-align: center;
        }
        .no-result {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card p-4">
        <h2 class="text-center text-primary">Student Result - All Subjects</h2>

        <?php
        include("init.php"); 

        if (isset($_GET["class"]) && isset($_GET["rn"])) {
            $class = $_GET["class"];
            $roll_no = $_GET["rn"];

            
            $sql = "SELECT name, subject, 
                        (one_1 + one_2 + one_3 + one_4 + one_5 + 
                         one_6 + one_7 + one_8 + one_9 + one_10) AS one_mark_total,
                        (five_1 + five_2 + five_3 + five_4) AS five_mark_total,
                        (ten_1 + ten_2) AS ten_mark_total
                    FROM result 
                    WHERE class=? AND rno=?";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $class, $roll_no);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Fetch student's name
                $student = $result->fetch_assoc();
                $student_name = htmlspecialchars($student["name"]);

                // Reset result pointer to fetch all subjects
                $result->data_seek(0);

                echo "<div class='mb-3'><strong>Name:</strong> " . $student_name . "</div>";
                echo "<div class='mb-3'><strong>Roll No:</strong> " . htmlspecialchars($roll_no) . "</div>";
                echo "<div class='mb-3'><strong>Class:</strong> " . htmlspecialchars($class) . "</div>";

                echo "<table class='table table-bordered table-striped'>";
                echo "<thead><tr><th>Subject</th><th>Total Marks (Out of 50)</th><th>Percentage</th></tr></thead><tbody>";

                $grand_total = 0;
                $max_marks = 50; // Marks are now out of 50
                $subject_count = 0;

                while ($row = $result->fetch_assoc()) {
                    $total_marks = $row["one_mark_total"] + $row["five_mark_total"] + $row["ten_mark_total"];

                    // Ensure marks do not exceed 50
                    if ($total_marks > 50) {
                        $total_marks = 50;
                    }

                    $percentage = ($total_marks / $max_marks) * 100;

                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["subject"]) . "</td>";
                    echo "<td>" . $total_marks . "</td>";
                    echo "<td>" . number_format($percentage, 2) . "%</td>";
                    echo "</tr>";

                    $grand_total += $total_marks;
                    $subject_count++;
                }


                echo "</tbody></table>";
            } else {
                echo "<p class='text-center no-result'>No results found for Roll No: " . htmlspecialchars($roll_no) . " in Class: " . htmlspecialchars($class) . ".</p>";
            }
        } else {
            echo "<p class='text-center no-result'>Invalid Request! Please enter valid details.</p>";
        }
        ?>

        <div class="text-center mt-3">
            <a href="index.php" class="btn btn-secondary">Back to Home</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
