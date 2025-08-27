<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Result Management - Your Portal</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

  
    <style>
    /* Professional Color Palette */
:root {
    --primary: #2c3e50;
    --secondary: #3498db;
    --accent: #e74c3c;
    --light: #ecf0f1;
    --dark: #2c3e50;
    --text-primary: #333;
    --text-secondary: #666;
    --shadow: 0 4px 6px rgba(0,0,0,0.1);
    --transition: all 0.3s ease;
}

/* Enhanced Typography */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Poppins', sans-serif;
    line-height: 1.8;
    color: var(--text-primary);
}

.container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 30px;
}

/* Enhanced Header */
header {
    background: rgba(255, 255, 255, 0.95);
    box-shadow: var(--shadow);
    position: fixed;
    width: 100%;
    z-index: 1000;
    padding: 15px 0;
    transition: var(--transition);
}

header.scrolled {
    padding: 10px 0;
    background: rgba(255, 255, 255, 0.98);
}

.dropdown {
    position: relative;
    border-radius: 5px;
}

.dropdown-content {
    display: none;
    position: absolute;
    background: #fff;
    min-width: 160px;
    box-shadow: 0 8px 16px rgba(0,0,0,0.1);
}
li a,.dropbtn{
    display: inline-block;
    text-decoration: none;
    color: white;
    height: 40px;
    display: flex;
    align-items: center;
    padding: 5px 50px;
    border-top: white;
    
}

li a:hover, .dropdown:hover {
    background-color:#007bff 
}

.dropdown-content{
    display: none;
    position: absolute;
    background-color:white ;
    
}

.dropdown-content a {
    color: white;
    text-decoration: none;
    display: flex;
    align-items: center;

}

.dropdown:hover .dropdown-content {
    display: block;
}
.nav-links a:hover {
    background: #007bff;
    color: #fff;
}

.nav-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
}



.nav-links {
    display: flex;
    list-style: none;
    gap: 30px;
}

.nav-links a {
    text-decoration: none;
    color: #333;
    padding: 10px 15px;
    border-radius: 5px;
    transition: background 0.3s, color 0.3s;
}

.nav-links a::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 2px;
    background: var(--secondary);
    transition: var(--transition);
}

.nav-links a:hover::after {
    width: 100%;
    background: #007bff;
    color: #fff;
}

/* Enhanced Hero Section */
/* Hero Section */
.hero {
    position: relative;
    height: 80vh;
    overflow: hidden;
}

.hero img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
}

.hero-text {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    color: #fff;
    width: 90%;
    max-width: 800px;
}

.hero-text h1 {
    font-size: 3.5rem;
    font-weight: 700;
    margin-bottom: 20px;
    line-height: 1.2;
}

.hero-text p {
    font-size: 1.2rem;
    margin-bottom: 30px;
    opacity: 0.9;
}

.cta-button {
    display: inline-block;
    padding: 15px 40px;
    background: var(--secondary);
    color: #fff;
    text-decoration: none;
    border-radius: 30px;
    font-weight: 500;
    transition: var(--transition);
    box-shadow: var(--shadow);
}

.cta-button:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 12px rgba(0,0,0,0.15);
}

/* Enhanced Info Grid */
.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 40px;
    padding: 80px 20px;
}

.info-box {
    background: #fff;
    padding: 40px;
    border-radius: 15px;
    box-shadow: var(--shadow);
    transition: var(--transition);
    position: relative;
    overflow: hidden;
}

.info-box::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 3px;
    background: var(--secondary);
    transform: scaleX(0);
    transition: var(--transition);
}

.info-box:hover {
    transform: translateY(-10px);
    box-shadow: 0 8px 16px rgba(0,0,0,0.1);
}

.info-box:hover::before {
    transform: scaleX(1);
}


/* Footer */
footer {
    background: #333;
    color: #fff;
    padding: 50px 0;
    
}

.footer-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 40px;
    margin-bottom: 60px;
}

.footer-column {
    display: flex;
    flex-direction: column;
    gap: 10px;
    
}

.footer-column h3 {
    font-size: 1.4rem;
    margin-bottom: 15px;
    position: relative;
}

.footer-column h3::after {
    content: '';
    position: absolute;
    bottom: -5px;
    left: 0;
    width: 40px;
    height: 3px;
    background: #3498db; /* Secondary color */
}

.footer-column a {
    color: #fff;
    text-decoration: none;
    transition: color 0.3s;
    
}

.footer-column a:hover {
    color: #3498db; /* Change color on hover */
}

/* Responsive Design */
@media (max-width: 768px) {
    .nav-links {
        flex-direction: column;
    }
    
    .hero {
        height: 60vh;
    }
}

.down {
  transform: rotate(45deg);
  -webkit-transform: rotate(45deg);
}
.arrow {
  border: solid;
  border-width: 0 3px 3px 0;
  display: inline-block;
  padding: 3px;
}
    </style>
</head>
<body>

    <!-- Header -->
    <header>
        <div class="container">
            <h1 >Welcome to the CIAMS Portal</h1>
            <nav>
                <ul class="nav-links">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="login.php">Admin Login</a></li>
                    <li class="dropdown">
                        <a href="#">Faculties &nbsp <i class="arrow down"></i></a>
                        <div class="dropdown-content">
                            <a href="#">Arts</a>
                            <a href="#">Science</a>
                            <a href="#">Commerce</a>
                            <a href="#">Technology</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a href="#">Students &nbsp <i class="arrow down"></i></a>
                        <div class="dropdown-content">
                            <a href="#">Admissions</a>
                            <a href="#">Scholarship</a>
                            <a href="#">Examinations</a>
                            <a href="login.php">Results</a>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="overlay"></div>
        <img src="images/home3.jpeg" alt="University Campus">
        <div class="hero-text">
            <h2>Class Internal Assesment Result Management</h2>
            <p>Secure and reliable access to academic records</p>
            <a href="login.php" class="cta-button">View Results</a>
        </div>
    </section>

    <!-- Information Section -->
    <section class="info-grid">
        <div class="info-box">
            <h3>Courses</h3>
            <p>Discover a variety of programs and career options.</p>
        </div>
        <div class="info-box">
            <h3>Admissions</h3>
            <p>Find details on admissions, fees, and scholarships.</p>
        </div>
        <div class="info-box">
            <h3>Library</h3>
            <p>Access vast academic resources and research materials.</p>
        </div>
        <div class="info-box">
            <h3>Campus Life</h3>
            <p>Explore student activities, clubs, and facilities.</p>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-column">
                <h3>Contact Us</h3>
                <p>Email: sanjaisandy115@gmail.com</p>
                <p>Phone: +91-9952022462</p>
            </div>
            <div class="footer-column">
                <h3>Quick Links</h3>
                <a href="index.php">Home</a>
                <a href="login.php">Login</a>
                <a href="student_register.php">Register</a>
                <a href="login.php" >Results</a>
            </div>
        </div>
    </footer>

</body>
</html>