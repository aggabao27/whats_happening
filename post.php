<?php
  require_once 'serverlogin.php'; 

  session_start();

  if (!isset($_SESSION['username']) && !isset($_SESSION['loggedin'])) {
    // Redirect user to welcome page
    header("location: login.php");
    exit();
  }

  $connect = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);

  if (!$connect) {
    die("Connection failed." . mysqli_connect_error());
  }

  // Making sure the request method is POST to be able to request form data. I did not use the GET method because it would show up the values in the link (publicly available for anyone to see)
  // This code checks if the server request method is POST. If it is, it retrieves data from the POST request and assigns it to corresponding variables
  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $eventType = $_POST['eventType'];
    $eventDate = $_POST['eventDate'];
    $eventTitle = $_POST['eventTitle'];
    $eventDescription = $_POST['eventDescription'];
    $eventTime = $_POST['eventTime'];
    $imageName = "files/images/events/".$_POST['imageName'].".jpg";

    // This code prepares an SQL statement for insertion into the Events table. The statement includes placeholders (?) for the values to be inserted
    $statement = $connect->prepare("INSERT INTO Events(EventTypeID, GroupID, EventDate, SubmitDate, EventTitle, EventImage, EventDesc) VALUES (?, ?, ?, ?, ?, ?, ?)");
    // The bind_param method binds the placeholders to the variables that hold the actual values to be inserted. The "iisssss" parameter specifies the types of the variables: i for integer, s for string 
    $statement->bind_param("iisssss", $EventTypeID, $GroupID, $EventDate, $SubmitDate, $EventTitle, $EventImage, $EventDesc);

    $eventTypeQuery = "SELECT * FROM EventTypes";
    // Stores the result of the query execution, which is fetched using the mysqli_query function with the connection $connect and the query $eventTypeQuery
    $result1 = mysqli_query($connect, $eventTypeQuery);

    // checks if the result from a previous query ($result1) contains one or more rows ($result1->num_rows > 0). If it does, it iterates over each row using a while loop and fetches the row as an associative array ($row = $result1->fetch_assoc())
    if ($result1->num_rows>0) {
      while ($row = $result1->fetch_assoc()) {
        if ($row["EventType"] === $eventType) {
          $EventTypeID = $row["EventTypeID"];
          break;
        }
      }
    }

    // This code retrieves all rows from the Groups table using the SQL query stored in $groupQuery. The mysqli_query function is used to execute the query with the database connection $connect, and the result is stored in $result2
    $groupQuery = "SELECT * FROM Groups";
    // Stores the result of the query execution, which is fetched using the mysqli_query function with the connection $connect and the query $groupQuery
    $result2 = mysqli_query($connect, $groupQuery);

    // If the result set ($result2) contains one or more rows ($result2->num_rows > 0), the code iterates over each row using a while loop and fetches the row as an associative array ($row1 = $result2->fetch_assoc())
    if ($result2->num_rows>0) {
      // checks if the value of the "GroupName" column in the current row ($row1["GroupName"]) is equal to a specific $communityGroup. If it is, it assigns the value of the "GroupID" column in that row to the $GroupID variable and exits the loop using break
      while ($row1 = $result2->fetch_assoc()) {
        $communityGroup = $_SESSION['GroupID'];
        if ($row1['GroupID'] == $communityGroup) {
          $GroupID = $row1['GroupID'];
          break;
        }
      }
    }

    $date = date("Y-m-d", strtotime($eventDate));
    $time = date("H:i:s", strtotime($eventTime));

    $EventDate = $date . " " . $time;
    $currentDate = date('Y-m-d H:i:s');
    $SubmitDate = $currentDate;
    $EventTitle = $eventTitle;
    $EventImage = $imageName;
    $EventDesc = $eventDescription;

    $statement->execute();

    $statement->close();
    echo "OK";
    exit();
  }
  mysqli_close($connect);
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
            <h1 class="page-title">Post New Event</h1>
            <?php
              // Include server login file
              require_once 'serverlogin.php'; 

              // Connect to the database
              $connect = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);

              // Check if the connection is successful
              if (!$connect) {
                // Display error message and stop script execution
                die("Connection failed." . mysqli_connect_error());
              }

              // Query to fetch group information based on GroupID from session
              $groupQuery = "SELECT * FROM Groups WHERE GroupID = " . $_SESSION['GroupID'];

              // Execute the query and store the result
              $result2 = mysqli_query($connect, $groupQuery);

              // Check if the result set contains one row
              if ($result2->num_rows == 1) {
                // Fetch the row as an associative array
                $row1 = $result2->fetch_assoc();
                // Display the group name
                echo "<h4>" . $row1['GroupName'] . "</h4>";
              }
              // Close the database connection
              mysqli_close($connect);
              ?>

          </div>
        </div>

        <div class="form mt-5">
          <!-- I have updated each div class and changed every single name, id, and placeholder value as specified in the assignment. I have also included to add
            the date format in the eventType value.-->
          <form action="post.php" method="post" role="form" class="php-email-form">
            <div class="form-group">
              <input type="text" class="form-control" name="eventTitle" id="eventTitle" placeholder="Your Event Title" required>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="eventDate" id="eventDate" placeholder="Your Event Date(Format: day-month-year)"  required>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="eventTime" id="eventTime" placeholder="Your Event Time(Format: H:M AM/PM)" required>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="eventType" id="eventType" placeholder="Your Event Type" required>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="imageName" id="imageName" placeholder="Your Image Name" required>
            </div>

            <div class="form-group">
              <textarea class="form-control" name="eventDescription" rows="5" placeholder="Your Event Description" required></textarea>
            </div>
            <div class="my-3">
              <div class="loading">Loading</div>
              <div class="error-message"></div>
              <div class="sent-message">Your message has been sent. Thank you!</div>
            </div>
            <!-- Changed the button title from Send Message to Login -->
            <!-- I updated the button to submit instead of keeping the default-->
            <div class="text-center"><button type="submit">Submit</button></div>
          </form>
        </div><!-- End Contact Form -->

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