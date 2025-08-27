<?php
session_start();
include("init.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $userid = $_POST["userid"];
    $password = $_POST["password"];

    // Check admin
    $sql_admin = "SELECT userid FROM admin_login WHERE userid = '$userid' AND password = '$password'";
    $result_admin = mysqli_query($conn, $sql_admin);
    if (mysqli_num_rows($result_admin) === 1) {
        $_SESSION['login_user'] = $userid;
        header("Location: dashboard.php");
        exit();
    }

    // Check student
    $sql_student = "SELECT id FROM student_users WHERE username = '$userid' AND password = '$password'";
    $result_student = mysqli_query($conn, $sql_student);
    if (mysqli_num_rows($result_student) === 1) {
        $_SESSION['student_user'] = $userid;
        header("Location: student.php");
        exit();
    }

    echo '<script>alert("Invalid username or password");</script>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index Page</title>

   <style>
    
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&family=Lora:wght@400;600&display=swap');
body {
    
    font-family: 'Lora', serif;
    background: #f4f4f4;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100vh;
    margin: 0;
}

/* Title Styling */
.title {
    font-size: 24px;
    font-weight: bold;
    color: #004aad;
    margin-bottom: 20px;
}

/* Main Container */
.main {
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    width: 350px;
    text-align: center;
}



/* Form Styling */
fieldset {
    border: none;
    padding: 0;
}

.heading {
    font-size: 18px;
    font-weight: bold;
    color: #004aad;
    margin-bottom: 10px;
}

/* Floating Label Input Group */

.input-group {
    position: relative;
    margin: 10px 0;
    width: 95%;
    animation: fadeIn 0.5s ease-in-out;
    flex-direction: column;
}

.input-group input, .input-group select {
    width: 100%;
    padding: 12px 10px;
    border: 1px solid #ccc;
    border-radius: 1px;
    outline: none;
    font-size: 16px;
    background: transparent;
    
}

.input-group label {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: #aaa;
    font-size: 16px;
    pointer-events: none;
    transition: 0.3s ease-in-out;
    background: white;
    padding: 0 5px;
}

/* Floating Label Effect */
.input-group input:focus + label,
.input-group input:not(:placeholder-shown) + label {
    top: 0px;
    left: 10px;
    font-size: 12px;
    color: #004aad;
}

/* Submit Button */
input[type="submit"] {
    background: #004aad;
    color: white;
    border: none;
    padding: 12px;
    border-radius: 5px;
    cursor: pointer;
    width: 100%;
    font-size: 16px;
    transition: 0.3s;
}

input[type="submit"]:hover {
    background: #003080;
}


/* Dropdown Input Group */
.input-grou {
    position: relative;
    width: 100%;
    margin-bottom: 20px;
    animation: fadeIn 0.5s ease-in-out;
    flex-direction: column;
}

/* Dropdown Styling */
.input-grou select {
    width: 100%;
    padding: 12px 10px;
    border: 1px solid #ccc;
    border-radius: 1px;
    font-size: 16px;
    background: white;
    appearance: none;
    cursor: pointer;
    outline: none;
}

/* Custom Arrow */
.input-grou::after {
    content: '\25BC'; /* Downward arrow */
    font-size: 14px;
    position: absolute;
    top: 50%;
    right: 15px;
    transform: translateY(-50%);
    pointer-events: none;
    color: #555;
}

/* Floating Label */
.input-grou label {
    position: absolute;
    top: 50%;
    left: 12px;
    transform: translateY(-50%);
    font-size: 16px;
    color: #777;
    transition: all 0.3s ease-in-out;
    pointer-events: none;
    background: white;
    padding: 0 5px;
}

/* Move label up when dropdown is focused or selected */
.input-grou select:focus + label,
.input-grou select:not([value=""]) + label {
    top: 0px;
    left: 10px;
    font-size: 12px;
    color: #004aad;
}
.home-link {
    position: absolute;
    top: 15px;
    left: 15px;
    font-size: 16px;
    font-weight: bold;
    color: #004aad;
    text-decoration: none;
}

.home-link:hover {
    text-decoration: underline;
}


    </style>
</head>
<body>
    <a href="index.php" class="home-link">🏠 Go to Home...</a>

    <div class="title">
        <span>CIA Result Management System</span>
    </div>

    <div class="main">
        

        <!-- Admin Login Form -->
        <div class="login active">
            <form action="#" method="post" name="login">
                <fieldset>
                    <legend class="heading">Login</legend>

                    <div class="input-group">
                        <input type="text" name="userid" placeholder=" " autocomplete="off">
                        <label>User Id</label>
                    </div>

                    <div class="input-group">
                        <input type="password" name="password" placeholder=" " autocomplete="off">
                        <label>Password</label>
                    </div>

                    <input type="submit" value="Login">

                    <p style="margin-top: 15px; font-size: 14px;">
    Not registered? <a href="student_register.php" style="color: #004aad; text-decoration: none;">Register here</a>
</p>

                </fieldset>
            </form>    
        </div>

    
    </div>
</body>
</html>

