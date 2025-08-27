<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Registration</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap');

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: #e8f0fe;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .container {
      background: #ffffff;
      padding: 30px 40px;
      border-radius: 12px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px;
    }

    h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #004aad;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 12px 15px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 15px;
    }

    input:focus {
      border-color: #004aad;
      outline: none;
    }

    button {
      width: 100%;
      padding: 12px;
      background-color: #004aad;
      color: #fff;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
      margin-top: 15px;
    }

    button:hover {
      background-color: #003080;
    }

    .link {
      text-align: center;
      margin-top: 15px;
    }

    .link a {
      color: #004aad;
      text-decoration: none;
      font-weight: 500;
    }

    .link a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>Student Registration</h2>
  <form method="post" action="">
    <input type="text" name="username" placeholder="Username" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="text" name="roll_no" placeholder="Roll Number" required>
    <input type="text" name="class_id" placeholder="Class ID" required>
    <input type="text" name="phone" placeholder="Phone Number" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="password" name="confirm_password" placeholder="Confirm Password" required>
    <button type="submit" name="submit" value="submit">Register</button>
  </form>
  <div class="link">
    <p>Already registered? <a href="login.php">Login</a></p>
  </div>
</div>

</body>
</html>

<?php
include("init.php");
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); // Enable error mode

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $roll_no = $_POST['roll_no'];
    $class_id = $_POST['class_id'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match!');</script>";
    } else {
        try {
            // Check if roll number already exists
            $check_sql = "SELECT * FROM student_users WHERE roll_no = '$roll_no'";
            $check_result = mysqli_query($conn, $check_sql);

            if (mysqli_num_rows($check_result) > 0) {
                echo "<script>alert('Roll number already registered!');</script>";
            } else {
                // Insert the new user
                $sql = "INSERT INTO student_users (username, email, roll_no, class_id, phone, password)
                        VALUES ('$username', '$email', '$roll_no', '$class_id', '$phone', '$password')";

                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('Student registered successfully!'); window.location.href='login.php';</script>";
                }
            }
        } catch (mysqli_sql_exception $e) {
            if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
                echo "<script>alert('Duplicate entry error: Email or phone or password already used.');</script>";
            } else {
                echo "<script>alert('Error: " . addslashes($e->getMessage()) . "');</script>";
            }
        }
    }
}
?>
