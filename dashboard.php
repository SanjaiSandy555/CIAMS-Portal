<?php
    include("init.php");
    $no_of_classes=mysqli_fetch_array(mysqli_query($conn,"SELECT COUNT(*) FROM `class`"));
    $no_of_students=mysqli_fetch_array(mysqli_query($conn,"SELECT COUNT(*) FROM `students`"));
    $no_of_result=mysqli_fetch_array(mysqli_query($conn,"SELECT COUNT(*) FROM `result`"));
    include('session.php');
 ?>
        
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <title>Dashboard</title>
    <style>
   
/* Main Content */
.main {
    display: flex;
    justify-content: center;
    margin: 50px auto;
    max-width: 900px;
}

.stats-container {
    display: flex;
    justify-content: space-between;
    gap: 20px;
}

.stat-card {
    background: white;
    border-radius: 10px;
    padding: 25px;
    width: 30%;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s;
}

.stat-card:hover {
    transform: translateY(-5px);
}

.stat-number {
    font-size: 28px;
    font-weight: bold;
    color: #007bff;
}

.stat-title {
    font-size: 16px;
    color: #666;
    margin-top: 5px;
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
                <a href="#" class="dropbtn">Results &nbsp<i class="arrow down"></i></a>
                <div class="dropdown-content" id="3">
                    <a href="add_results.php">Add Results</a>
                    <a href="manage_results.php">Manage Results</a>
                </div>
            </li>
        </ul>
    </div>

    <div class="main">
    <div class="stats-container">
        <div class="stat-card">
            <span class="stat-number"><?php echo $no_of_classes[0]; ?></span>
            <div class="stat-title">Total Classes</div>
        </div>
        <div class="stat-card">
            <span class="stat-number"><?php echo $no_of_students[0]; ?></span>
            <div class="stat-title">Total Students</div>
        </div>
        <div class="stat-card">
            <span class="stat-number"><?php echo $no_of_result[0]; ?></span>
            <div class="stat-title">Total Results</div>
        </div>
    </div>
</div>


    <div class="footer">
        <p>Sanjai website &copy; 2025. All rights reserved.</p>
    </div>
</body>
</html>

