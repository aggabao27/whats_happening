<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

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

  <main id="main">

    <section class="single-post-content">
      <div class="container">
        <div class="row">
          <div class="col-md-9 post-content" data-aos="fade-up">

            <!-- ======= Single Post Content ======= -->
            <?php 
              // Connect to database
              require_once 'serverlogin.php'; 

              $connect = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);

              if (!$connect) {
                die("Connection failed." . mysqli_connect_error());
              }
              //this is getting the querystring to make sure that it leads to the correct event number when clicked
              $eventNum = $_GET['eventNumber'];
              
              // Only select what is specified in this code
              $mySinglePostQuery = "SELECT evnts.*, groups.GroupName, groups.GroupImage, groups.GroupType, typ.EventType, groups.ContactName, groups.ContactEmail
                FROM Events evnts
                JOIN Groups groups ON evnts.GroupID = groups.GroupID
                JOIN EventTypes typ ON evnts.EventTypeID = typ.EventTypeID
                WHERE EventID = '$eventNum'";
              
              // From database, my query
              $result = mysqli_query($connect, $mySinglePostQuery);
              $row = $result->fetch_assoc();

              // Extract the first letter of a description and storing the rest of the description in another variable.
              $firstLetter = substr($row["EventDesc"], 0, 1);
              $descriptionPg = ltrim($row["EventDesc"], $firstLetter);
              
              // This is the date and time format to follow the assignment formatting of the webpage
              $date = date_format(date_create($row["EventDate"]), "D d M, Y");
              $time = date_format(date_create($row["EventDate"]), "h:i A");

              $str = <<<GROUPS

                <div class="single-post">
                  <div class="post-meta"><span class="date">{$row["EventType"]}</span> <span class="mx-1">&bullet;</span> <span>$date TIME: $time</span></div>
                  <h1 class="mb-5">{$row["EventTitle"]}</h1>
                  <h3> Organizers: {$row["GroupName"]}</h3>
                  <h3 class="mb-5">(Contact {$row["ContactName"]} at {$row["ContactEmail"]} for more info)</h3>

                  <p><span class="firstcharacter">$firstLetter</span>$descriptionPg</p>

                  <img src="{$row["EventImage"]}" alt="" class="img-fluid">
                </div>

              GROUPS;
              echo $str;
              // CLose the connection
              mysqli_close($connect);
            ?>

            <!-- ======= Comments ======= -->
            <div class="comments">
              <h5 class="comment-title py-4">2 Comments</h5>
              <div class="comment d-flex mb-4">
                <div class="flex-shrink-0">
                  <div class="avatar avatar-sm rounded-circle">
                    <img class="avatar-img" src="assets/img/person-5.jpg" alt="" class="img-fluid">
                  </div>
                </div>
                <div class="flex-grow-1 ms-2 ms-sm-3">
                  <div class="comment-meta d-flex align-items-baseline">
                    <h6 class="me-2">Jordan Singer</h6>
                    <span class="text-muted">2d</span>
                  </div>
                  <div class="comment-body">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Non minima ipsum at amet doloremque qui magni, placeat deserunt pariatur itaque laudantium impedit aliquam eligendi repellendus excepturi quibusdam nobis esse accusantium.
                  </div>

                  <div class="comment-replies bg-light p-3 mt-3 rounded">
                    <h6 class="comment-replies-title mb-4 text-muted text-uppercase">2 replies</h6>

                    <div class="reply d-flex mb-4">
                      <div class="flex-shrink-0">
                        <div class="avatar avatar-sm rounded-circle">
                          <img class="avatar-img" src="assets/img/person-4.jpg" alt="" class="img-fluid">
                        </div>
                      </div>
                      <div class="flex-grow-1 ms-2 ms-sm-3">
                        <div class="reply-meta d-flex align-items-baseline">
                          <h6 class="mb-0 me-2">Brandon Smith</h6>
                          <span class="text-muted">2d</span>
                        </div>
                        <div class="reply-body">
                          Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                        </div>
                      </div>
                    </div>
                    <div class="reply d-flex">
                      <div class="flex-shrink-0">
                        <div class="avatar avatar-sm rounded-circle">
                          <img class="avatar-img" src="assets/img/person-3.jpg" alt="" class="img-fluid">
                        </div>
                      </div>
                      <div class="flex-grow-1 ms-2 ms-sm-3">
                        <div class="reply-meta d-flex align-items-baseline">
                          <h6 class="mb-0 me-2">James Parsons</h6>
                          <span class="text-muted">1d</span>
                        </div>
                        <div class="reply-body">
                          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio dolore sed eos sapiente, praesentium.
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="comment d-flex">
                <div class="flex-shrink-0">
                  <div class="avatar avatar-sm rounded-circle">
                    <img class="avatar-img" src="assets/img/person-2.jpg" alt="" class="img-fluid">
                  </div>
                </div>
                <div class="flex-shrink-1 ms-2 ms-sm-3">
                  <div class="comment-meta d-flex">
                    <h6 class="me-2">Santiago Roberts</h6>
                    <span class="text-muted">4d</span>
                  </div>
                  <div class="comment-body">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto laborum in corrupti dolorum, quas delectus nobis porro accusantium molestias sequi.
                  </div>
                </div>
              </div>
            </div><!-- End Comments -->

            <!-- ======= Comments Form ======= -->
        
            <div class="row justify-content-center mt-5">

              <div class="col-lg-12">
                <h5 class="comment-title">Leave a Comment</h5>
                <div class="row">
                  <div class="col-lg-6 mb-3">
                    <label for="comment-name">Name</label>
                    <input type="text" class="form-control" id="comment-name" placeholder="Enter your name">
                  </div>
                  <div class="col-lg-6 mb-3">
                    <label for="comment-email">Email</label>
                    <input type="text" class="form-control" id="comment-email" placeholder="Enter your email">
                  </div>
                  <div class="col-12 mb-3">
                    <label for="comment-message">Message</label>

                    <textarea class="form-control" id="comment-message" placeholder="Enter your name" cols="30" rows="10"></textarea>
                  </div>
                  <div class="col-12">
                    <input type="submit" class="btn btn-primary" value="Post comment">
                  </div>
                </div>
              </div>
            </div><!-- End Comments Form -->

          </div>
          <div class="col-md-3">
            <!-- ======= Sidebar ======= -->
            <div class="aside-block">

              <ul class="nav nav-pills custom-tab-nav mb-4" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="pills-upcoming-tab" data-bs-toggle="pill" data-bs-target="#pills-upcoming" type="button" role="tab" aria-controls="pills-upcoming" aria-selected="true">Upcoming</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="pills-latest-tab" data-bs-toggle="pill" data-bs-target="#pills-latest" type="button" role="tab" aria-controls="pills-latest" aria-selected="false">Latest Added</button>
                </li>
              </ul>

              <div class="tab-content" id="pills-tabContent">

                <!-- Upcoming -->
                <div class="tab-pane fade show active" id="pills-upcoming" role="tabpanel" aria-labelledby="pills-upcoming-tab">
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
                    $groupQuery = "SELECT * FROM Events ORDER BY EventDate ASC";

                    // Execute the query and store the result
                    $result1 = mysqli_query($connect, $groupQuery);

                    // Check if the result set contains one row
                    if ($result1->num_rows > 0) {
                      // Fetch the row as an associative array
                      while ($row1 = $result1->fetch_assoc()) {
                        $eventTypeQuery = "SELECT * FROM EventTypes WHERE EventTypeID = " . $row1['EventTypeID'];
                        $result2 = mysqli_query($connect, $eventTypeQuery);
                        $row2 = $result2->fetch_assoc();

                        $groupTypeQuery = "SELECT * FROM Groups WHERE GroupID = " . $row1['GroupID'];
                        $result3 = mysqli_query($connect, $groupTypeQuery);
                        $row3 = $result3->fetch_assoc();

                        $date = date_format(date_create($row1["EventDate"]), "d-M-y");

                        $str = <<<GROUPS

                          <div class="post-entry-1 border-bottom">
                            <div class="post-meta"><span class="date">{$row2['EventType']}</span> <span class="mx-1">&bullet;</span> <span>$date</span></div>
                            <h2 class="mb-2"><a href="single-post.php?eventNumber={$row1["EventID"]}">{$row1['EventTitle']}</a></h2>
                            <span class="author mb-3 d-block">{$row3['GroupName']}</span>
                          </div>

                        GROUPS;
                        echo $str;
                      }
                    }
                    // Close the database connection
                    mysqli_close($connect);
                  ?>
                </div> <!-- End Upcoming -->

                <!-- Latest Added -->
                <div class="tab-pane fade" id="pills-latest" role="tabpanel" aria-labelledby="pills-latest-tab">
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
                    $groupQuery = "SELECT * FROM Events ORDER BY SubmitDate DESC";

                    // Execute the query and store the result
                    $result1 = mysqli_query($connect, $groupQuery);

                    // Check if the result set contains one row
                    if ($result1->num_rows > 0) {
                      // Fetch the row as an associative array
                      while ($row1 = $result1->fetch_assoc()) {
                        $eventTypeQuery = "SELECT * FROM EventTypes WHERE EventTypeID = " . $row1['EventTypeID'];
                        $result2 = mysqli_query($connect, $eventTypeQuery);
                        $row2 = $result2->fetch_assoc();

                        $groupTypeQuery = "SELECT * FROM Groups WHERE GroupID = " . $row1['GroupID'];
                        $result3 = mysqli_query($connect, $groupTypeQuery);
                        $row3 = $result3->fetch_assoc();

                        $date = date_format(date_create($row1["EventDate"]), "d-M-y");

                        $str = <<<GROUPS

                          <div class="post-entry-1 border-bottom">
                            <div class="post-meta"><span class="date">{$row2['EventType']}</span> <span class="mx-1">&bullet;</span> <span>$date</span></div>
                            <h2 class="mb-2"><a href="single-post.php?eventNumber={$row1["EventID"]}">{$row1['EventTitle']}</a></h2>
                            <span class="author mb-3 d-block">{$row3['GroupName']}</span>
                          </div>

                        GROUPS;
                        echo $str;
                      }
                    }
                    // Close the database connection
                    mysqli_close($connect);
                  ?>
                  
                </div> <!-- End Latest Added -->

              </div>
            </div>

           <div class="aside-block">
              <h3 class="aside-title">Events</h3>
              <ul class="aside-links list-unstyled">
                <li><a href="events.php"><i class="bi bi-chevron-right"></i> All Events</a></li>
                <li><a href="events.php"><i class="bi bi-chevron-right"></i> Music</a></li>
                <li><a href="events.php"><i class="bi bi-chevron-right"></i> Art+Culture</a></li>
                <li><a href="events.php"><i class="bi bi-chevron-right"></i> Sports</a></li>
                <li><a href="events.php"><i class="bi bi-chevron-right"></i> Food</a></li>
                <li><a href="events.php"><i class="bi bi-chevron-right"></i> Fund Raiser</a></li>
              </ul>
            </div><!-- End Categories -->

            <!-- Tags -->
            <div class="aside-block">
              <h3 class="aside-title">Tags</h3>
              <ul class="aside-tags list-unstyled">
                <!-- the updated href means that by clicking on the tags button, it should lead to the correct category-->
                <li><a href="events.php?eventsCategory=All">All Events</a></li>
                <li><a href="events.php?eventsCategory=Music">Music</a></li>
                <li><a href="events.php?eventsCategory=Art%2BCulture">Art+Culture</a></li>
                <li><a href="events.php?eventsCategory=Sports">Sports</a></li>
                <li><a href="events.php?eventsCategory=Food">Food</a></li>
                <li><a href="events.php?eventsCategory=Fund Raiser">Fund Raiser</a></li>
              </ul>
            </div><!-- End Tags -->

          </div>
        </div>
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