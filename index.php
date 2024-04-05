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
  <!-- Updated the header by removing the last slide -->
  <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="index.php" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1>What's Happening</h1>
      </a>
      <!-- Updated the top navigation bar -->
      <!-- Changed the titles in the lists as specified in the Assignment 1 document - this updated the titles in the dropdown -->
      <!-- I also made sure to change the reference to index.php instead of using the given default reference -->
      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="index.php">Home</a></li>
          <!-- Created a query string named eventsCategory so that whenever we cick on the nav bar, it leads to the corresponding web page-->
          <li class="dropdown"><a href="events.php?eventsCategory=All"><span>Events</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <!-- Assigning the eventsCategory querystring to have a value of all would show all images in events for All categories, not just specific to
                   to one filter. For example, if i were to select food under events in the nav bar, it will show up anything related to food, otherwise, do not
                   show any images.
               -->
              <li><a href="events.php?eventsCategory=All">All Events</a></li>
              <!-- Assigning querystring to equal music will only show music, and the same applies to Art+Culture, sports, food, and fundraiser -->
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

    <!-- ======= Hero Slider Section ======= -->
    <section id="hero-slider" class="hero-slider">
      <div class="container-md" data-aos="fade-in">
        <div class="row">
          <div class="col-12">
            <div class="swiper sliderFeaturedPosts">
              <div class="swiper-wrapper">
                <div class="swiper-slide">
                  <!-- I made no changes in the href below as it wasnt specified in the assignment -->
                  <a href="single-post.html" class="img-bg d-flex align-items-end" style="background-image: url('assets/img/post-slide-1.jpg');">
                    <div class="img-bg-inner">
                      <h2>What's Happening in your Community</h2>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem neque est mollitia! Beatae minima assumenda repellat harum vero, officiis ipsam magnam obcaecati cumque maxime inventore repudiandae quidem necessitatibus rem atque.</p>
                    </div>
                  </a>
                </div>

                <?php

                  // Connect to the database
                  require_once 'serverlogin.php'; 

                  $connect = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);

                  if (!$connect) {
                    die("Connection failed." . mysqli_connect_error());
                  }

                  // Code executes a SQL query to select the columns EventTitle, EventID, and EventDesc from the Events table
                  $myIndexQuery = "SELECT EventTitle, EventID, EventDesc FROM Events ORDER BY SubmitDate DESC LIMIT 1";
                  // Stores the result of the query execution, which is fetched using the mysqli_query function with the connection $connect and the query $myIndexQuery
                  $result = mysqli_query($connect, $myIndexQuery);
                  // Allows access to the values of the columns EventTitle, EventID, and EventDesc for the latest event in the Events table
                  $row = $result->fetch_assoc();

                  $str = <<<OUTPUT

                    <div class="swiper-slide">
                    <a href="single-post.php?eventNumber={$row["EventID"]}" class="img-bg d-flex align-items-end" style="background-image: url('assets/img/post-slide-2.jpg');">
                      <div class="img-bg-inner">
                        <h2>Latest Added Event</h2>
                        <p><strong>{$row["EventTitle"]}: </strong>{$row["EventDesc"]}</p>
                      </div>
                    </a>
                    </div>

                  OUTPUT;
                  echo $str;

                  // This is for the Happening Soon slider and the same process applied. However, this time, we are starting from earliest to latest date.
                  $myHappeningSoonQuery = "SELECT EventTitle, EventID, EventDesc FROM Events ORDER BY EventDate ASC LIMIT 1";
                  $result = mysqli_query($connect, $myHappeningSoonQuery);
                  $row = $result->fetch_assoc();

                  $str = <<<OUTPUT

                    <div class="swiper-slide">
                    <a href="single-post.php?eventNumber={$row["EventID"]}" class="img-bg d-flex align-items-end" style="background-image: url('assets/img/post-slide-3.jpg');">
                      <div class="img-bg-inner">
                        <h2>Happening Soon</h2>
                        <p><strong>{$row["EventTitle"]}: </strong>{$row["EventDesc"]}</p>
                      </div>
                    </a>
                    </div>

                  OUTPUT;
                  echo $str;

                  mysqli_close($connect);
                ?>

                
              </div>
              <div class="custom-swiper-button-next">
                <span class="bi-chevron-right"></span>
              </div>
              <div class="custom-swiper-button-prev">
                <span class="bi-chevron-left"></span>
              </div>

              <div class="swiper-pagination"></div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Hero Slider Section -->

  </main><!-- End #main -->

  <!-- Updated the bottom footer -->
  <!-- The lists listed under events was also updated to match the assignment document -->
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