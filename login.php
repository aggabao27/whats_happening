<?php
// Include the server login file for database credentials
require_once 'serverlogin.php';

// Start the session
session_start();

// Check if the logout query string is present and logout is requested
if (!empty($_GET['logoutQS']) && $_GET['logoutQS'] == "logout") {
  // Unset all session variables
  session_unset();
  // Destroy the session
  session_destroy();
  // Redirect to the login page
  header("location: login.php");
  // Exit the script
  exit();
}

// Redirect user to the post page if already logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
  header("location: post.php");
  exit();
}

// Connect to the database
$connect = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);

// Check if the connection is successful
if (!$connect) {
  // Display error message and stop script execution
  die("Connection failed." . mysqli_connect_error());
}

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get username and password from the form
  $username = trim($_POST['Username']);
  $password = trim($_POST['Password']);

  // Check if username and password are provided
  if (isset($username) && isset($password)) {
    // Prepare a select statement to fetch user details
    $loginQuery = "SELECT AccountID, GroupID, Username, Password FROM Login WHERE Login.Username = ?";

    // Prepare the statement
    if ($result = mysqli_prepare($connect, $loginQuery)) {
      // Bind username as parameter to the statement
      mysqli_stmt_bind_param($result, "s", $username);

      // Execute the statement
      if (mysqli_stmt_execute($result)) {
        // Store the result from the statement
        mysqli_stmt_store_result($result);
        // Bind the result to variables
        mysqli_stmt_bind_result($result, $accountId, $groupId, $user, $pass);

        // Check if username exists, if yes then verify password
        if (mysqli_stmt_num_rows($result) == 1) {
          // Fetch the result
          if (mysqli_stmt_fetch($result)) {
            // Verify the password
            if ($pass == $password) {
              // Store data in session variables
              $_SESSION["loggedin"] = true;
              $_SESSION["AccountID"] = $accountId;
              $_SESSION["Username"] = $username;
              $_SESSION["GroupID"] = $groupId;

              // Display success message
              echo "You have logged in successfully! OK";
              // header("location: post.php");
              echo "<meta http-equiv='refresh' content='0;url=post.php'>";
              // Exit the script
              exit();
            } 
            else {
              // Password is not valid, display error message
              echo "Invalid password.";
              exit();
            }
          }
        } 
        else {
          // Username doesn't exist, display error message
          echo "Invalid username";
          exit();
        }
      } 
      else {
        // Something went wrong with the execution, display error message
        echo "Oops! Something went wrong. Please try again later.";
        exit();
      }
      // Close the prepared statement
      mysqli_stmt_close($result);
    }
    // Close the database connection
    mysqli_close($connect);
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <!-- Changed the title from the default to What's Happening -->
  <title>What's Happening</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500&family=Inter:wght@400;500&family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS Files -->
  <link href="assets/css/variables.css" rel="stylesheet">
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: ZenBlog
  * Updated: Jan 29 2024 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/zenblog-bootstrap-blog-template/
  * Author: BootstrapMade.com
  * License: https:///bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="index.php" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1>What's Happening</h1>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li class="dropdown"><a href="events.php?eventsCategory=All"><span>Events</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <li><a href="events.php?eventsCategory=All">All Events</a></li>
              <li><a href="events.php?eventsCategory=Music">Music</a></li>
              <li class="dropdown"><a href="events.php?eventsCategory=Art%2BCulture"><span>Art+Culture</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
              <li><a href="events.php?eventsCategory=Sports">Sports</a></li>
              <li><a href="events.php?eventsCategory=Food">Food</a></li>
              <li><a href="events.php?eventsCategory=Fund Raiser">Fund Raiser</a></li>
            </ul>
          </li>
          <li><a href="groups.php">Community Groups</a></li>
          <li><a href="about.php">About</a></li>
          <li><a href="post.php">Post Event</a></li>
          <li class="dropdown"><a href="login.php"><span>Login</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <li><a href="login.php">Login</a></li>
              <li><a href="login.php?logoutQS=logout">Logout</a></li>
            </ul>
          </li>
        </ul>
      </nav><!-- .navbar -->

      <div class="position-relative">
        <a href="#" class="mx-2"><span class="bi-facebook"></span></a>
        <a href="#" class="mx-2"><span class="bi-twitter"></span></a>
        <a href="#" class="mx-2"><span class="bi-instagram"></span></a>

        <a href="#" class="mx-2 js-search-open"><span class="bi-search"></span></a>
        <i class="bi bi-list mobile-nav-toggle"></i>

        <!-- ======= Search Form ======= -->
        <div class="search-form-wrap js-search-form-wrap">
          <form action="search-result.html" class="search-form">
            <span class="icon bi-search"></span>
            <input type="text" placeholder="Search" class="form-control">
            <button class="btn js-search-close"><span class="bi-x"></span></button>
          </form>
        </div><!-- End Search Form -->

      </div>

    </div>

  </header><!-- End Header -->

  <!-- Changed the title from Contact Us to Login -->
  <!-- Removed the top row (address, phone number, and email) as specified -->
  <main id="main">
    <section id="contact" class="contact mb-5">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-12 text-center mb-5">
            <h1 class="page-title">Login</h1>
          </div>
        </div>

        <div class="form mt-5 col-md-8 mx-auto">
          
          <form action="login.php" method="post" role="form" class="php-email-form">
              <div class="form-group">
                <input type="text" name="Username" class="form-control" id="Username" placeholder="Your Username" required>
              </div>
            <div class="form-group">
              <input type="password" class="form-control" name="Password" placeholder="Your Password" required>
            </div>
            <div class="my-3">
              <div class="loading">Loading</div>
              <div class="error-message"></div>
              <div class="sent-message">You have successfully logged in!</div>
            </div>
            <!-- Changed the button title from Send Message to Login -->
            <div class="text-center"><button type="submit">Login</button></div>
          </form>
        </div><!-- End Login Form -->
        <h6 class="text-center mt-3 mb-1">Don't have an account?</h6>
        <h6 class="text-center">Sign up your group and start posting your events.</h6>
        <div class="text-center"><button type="button" class="btn btn-success" onclick="window.location.href='createAccount.php'">Create Account</button></div>
        
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    <div class="footer-content">
      <div class="container">

        <div class="row g-5">
          <div class="col-lg-4">
            <h3 class="footer-heading">About What's Happening</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam ab, perspiciatis beatae autem deleniti voluptate nulla a dolores, exercitationem eveniet libero laudantium recusandae officiis qui aliquid blanditiis omnis quae. Explicabo?</p>
            <p><a href="about.php" class="footer-link-more">Learn More</a></p>
          </div>
          <div class="col-6 col-lg-2">
            <h3 class="footer-heading">Navigation</h3>
            <ul class="footer-links list-unstyled">
              <!-- I added a change in the events href by adding a querystring because we will be moving from one page to another whenever we click on the
                categories of the events, no matter where the location is. If we are in navigation, sidebar, or footer, clicking on any sports, food, music, etc, 
                should lead to the corresponding webpage. I have made sure to do this to every single php document that I have attached in the assignment to ensure
                each page functions just like the rest. -->
              <li><a href="index.php"><i class="bi bi-chevron-right"></i> Home</a></li>
              <li><a href="events.php?eventsCategory=All"><i class="bi bi-chevron-right"></i> Events</a></li>
              <li><a href="groups.php"><i class="bi bi-chevron-right"></i> Community Groups</a></li>
              <li><a href="about.php"><i class="bi bi-chevron-right"></i> About</a></li>
              <li><a href="post.php"><i class="bi bi-chevron-right"></i> Post Event</a></li>
              <li><a href="login.php"><i class="bi bi-chevron-right"></i> Login</a></li>
            </ul>
          </div>
          <div class="col-6 col-lg-2">
            <h3 class="footer-heading">Events</h3>
            <ul class="footer-links list-unstyled">
              <!-- I updated the list for each and every single php document so that clicking on any of the category in the events leads to the correct page
                and is showing up pictures with headings as well as description, etc.-->
              <li><a href="events.php?eventsCategory=All"><i class="bi bi-chevron-right"></i> All Events</a></li>
              <li><a href="events.php?eventsCategory=Music"><i class="bi bi-chevron-right"></i> Music</a></li>
              <li><a href="events.php?eventsCategory=Art%2BCulture"><i class="bi bi-chevron-right"></i> Art+Culture</a></li>
              <li><a href="events.php?eventsCategory=Sports"><i class="bi bi-chevron-right"></i> Sports</a></li>
              <li><a href="events.php?eventsCategory=Food"><i class="bi bi-chevron-right"></i> Food</a></li>
              <li><a href="events.php?eventsCategory=Fund Raiser"><i class="bi bi-chevron-right"></i> Fund Raiser</a></li>

            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="footer-legal">
      <div class="container">

        <div class="row justify-content-between">
          <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
            <div class="copyright">
              © Copyright <strong><span>ZenBlog</span></strong>. All Rights Reserved
            </div>

            <div class="credits">
              <!-- All the links in the footer should remain intact. -->
              <!-- You can delete the links only if you purchased the pro version. -->
              <!-- Licensing information: https://bootstrapmade.com/license/ -->
              <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/herobiz-bootstrap-business-template/ -->
              Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>

          </div>

          <div class="col-md-6">
            <div class="social-links mb-3 mb-lg-0 text-center text-md-end">
              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="google-plus"><i class="bi bi-skype"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>

          </div>

        </div>

      </div>
    </div>

  </footer>

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>