<?php
session_start();

if (!isset($_SESSION['adminlogin'])) {
    header('Location:login.php');
}

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'verify');

// Try connecting to the Database
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

//Check the connection
if($conn == false){
    die('Error: Cannot connect');
}
else
{
    echo "Connection Established";
}



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $reg = $_POST['reg'];
    $email = $_POST['email'];
    $dob_nonformated = $_POST['dob'];
    $dob = date('y-m-d', strtotime($dob_nonformated));
    $CertificateImg = addslashes(file_get_contents($_FILES['imagefile']['tmp_name']));

    $sql = "SELECT `Reg_no` from users WHERE Reg_no = '$reg'";

    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);
    
    $num = mysqli_num_rows($result);
    $cid = $_POST['cid'];

    if($num==0)
    {
        $sql1 = "INSERT INTO `users` (`Reg_no`, `Name`, `Email`, `DOB`) VALUES('$reg', '$name', '$email', '$dob')";
        mysqli_query($conn, $sql1);
        $sql2 = "INSERT INTO `certificates` (`reg_no`, `certificate`, `image`) VALUES('$reg', '$cid', '$CertificateImg')";
        mysqli_query($conn, $sql2);
    }
    else
    {
        $sql2 = "INSERT INTO `certificates` (`reg_no`, `certificate`, `image`) VALUES('$reg', '$cid', '$CertificateImg')";
        mysqli_query($conn, $sql2);
    }



    // $CertificateImg = $_POST['imagefile'];

    // echo "$name $reg $email $dob $cid";



    

    
    

}
// echo var_dump($GLOBALS);
// echo $result;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> Add a Certificate</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon-32x32.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;500&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

</head>

<body>

    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start -->
    <div class="container-fluid bg-dark text-light px-0 py-2">
        <div class="row gx-0 d-none d-lg-flex">
            <div class="col-lg-7 px-5 text-start">
                <div class="h-100 d-inline-flex align-items-center me-4">
                    <span class="fa fa-phone-alt me-2"></span>
                    <a class="text-link" href="tel:9999999999">+91 9999999999</a>
                </div>
                <div class="h-100 d-inline-flex align-items-center">
                    <span class="far fa-envelope me-2"></span>
                    <a class="text-link" href="mailto:pdclub@sggs.ac.in">pdclub@sggs.ac.in</a>
                </div>
            </div>
            <div class="col-lg-5 px-5 text-end">
                <div class="h-100 d-inline-flex align-items-center mx-n2">
                    <span>Follow Us:</span>
                    <a class="btn btn-link text-light" href="https://www.youtube.com"><i class="fab fa-youtube"></i></a>
                    <a class="btn btn-link text-light" href="https://facebook.com"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-link text-light" href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-link text-light" href="https://linkedin.com"><i
                            class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-link text-light" href="https://instagram.com"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0">
        <a href="index.html" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <h1 class="m-0">Personality Development Club</h1>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="index.html" class="nav-item nav-link" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">Home</a>
                <a href="about.html" class="nav-item nav-link">About</a>
                <!-- <a href="service.html" class="nav-item nav-link">Courses</a> -->
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Courses</a>
                    <div class="dropdown-menu bg-light m-0">
                        <a href="technical_courses.html" class="dropdown-item">Technical Courses</a>
                        <a href="personality_development_courses.html" class="dropdown-item">Personality Development
                            Courses</a>
                        <a href="#" class="dropdown-item active">Verify Your Certificate</a>
                    </div>
                </div>
                <a href="#" class="nav-item nav-link">Our Activities</a>
                <a href="our_clientele.html" class="nav-item nav-link">Our Clientele</a>
                <a href="Blogs.html" class="nav-item nav-link">Blogs</a>
                <a href="team.html" class="nav-item nav-link">Our Team</a>
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu bg-light m-0">
                        <!-- <a href="feature.html" class="dropdown-item">Features</a> -->
                        <!-- <a href="quote.html" class="dropdown-item">Free Quote</a> -->
                        <!-- <a href="team.html" class="dropdown-item">Our Team</a> -->
                        <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                        <a href="404.html" class="dropdown-item">404 Page</a>
                    </div>
                </div>
                <a href="contact.html" class="nav-item nav-link">Contact</a>
            </div>
            <!-- <a href="" class="btn btn-primary py-4 px-lg-4 rounded-0 d-none d-lg-block">Get A Quote<i class="fa fa-arrow-right ms-3"></i></a> -->
        </div>
    </nav>
    <!-- Navbar End -->
    <div style="margin:25px;">
    <form method="POST" enctype="multipart/form-data" class="row g-3">
        <div class="col-md-4">
            <label for="inputEmail4" class="form-label">Name</label>
            <input type="text" name = "name" class="form-control" id="inputEmail4"placeholder="Enter your name">
        </div>
        <div class="col-md-4">
            <label for="inputPassword4" class="form-label">Email</label>
            <input type="email" name = "email" class="form-control" id="inputPassword4" placeholder="Enter your Email">
        </div>
        <div class="col-md-4">
            <label for="inputAddress" class="form-label">Registeration Number</label>
            <input type="text" name = "reg" class="form-control" id="erg" placeholder="2020XXX000">
        </div>
        <div class="col-md-4">
            <label for="inputAddress2" class="form-label" >Date of Birth</label>
            <input type="date" name = "dob" class="form-control" id="dob" placeholder="27/04/2002" id="actualDate">
        </div>
        <div class="col-md-4">
            <label for="inputCity" class="form-label">Certificate ID</label>
            <input type="text" name = "cid" class="form-control" id="inputCity" placeholder="Enter Certificate No.">
        </div>
        <div class="col-md-4">
            <label for="inputState" class="form-label">Certificate</label>
            <input type="file" id="imagefile" name="imagefile">
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-success" name = "submit" >Insert Record</button>
        </div>
    </form>
    </div>

    <a href = "logout.php" type="button" class="ms-4 btn btn-outline-danger">Logout</a>


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer mt-5 py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-4">Our Club</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Vishnupuri, Nanded</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+91 999999999</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>pdclub@sggs.ac.in</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-square btn-outline-light rounded-circle me-2" href=""><i
                                class="fab fa-twitter"></i></a>
                        <a class="btn btn-square btn-outline-light rounded-circle me-2" href=""><i
                                class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square btn-outline-light rounded-circle me-2" href=""><i
                                class="fab fa-youtube"></i></a>
                        <a class="btn btn-square btn-outline-light rounded-circle me-2" href=""><i
                                class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-4">Our Courses</h4>
                    <a class="btn btn-link" href="technical_courses.html">Technical Courses</a>
                    <a class="btn btn-link" href="personality_development_courses.html">Personality Development
                        Courses</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-4">Quick Links</h4>
                    <a class="btn btn-link" href="about.html">About Us</a>
                    <a class="btn btn-link" href="contact.html">Contact Us</a>
                    <a class="btn btn-link" href="Blogs.html">Blog</a>
                    <a class="btn btn-link" id="switch" href="login.php">Admin Login</a>
                </div>


                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-4">Newsletter</h4>
                    <p class="blog">Improve your Competence, Culture and Character</p>
                    <div class="position-relative w-100">
                        <input class="form-control bg-light border-light w-100 py-3 ps-4 pe-5" type="text"
                            placeholder="Your email">
                        <button type="button"
                            class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Copyright Start -->
    <div class="container-fluid copyright py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; <a class="border-bottom" href="#">pdclub.in</a>, All Right Reserved.
                </div>
                <!-- <div class="col-md-6 text-center text-md-end"> -->
                <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                <!-- Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a> Distributed By <a href="https://themewagon.com">ThemeWagon</a> -->
                <!-- &copy; <a class="border-bottom" href="#">pdclub.in</a>, All Right Reserved. -->
                <!-- </div> -->
            </div>
        </div>
    </div>
    <!-- Copyright End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i
            class="bi bi-arrow-up"></i></a>




    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/parallax/parallax.min.js"></script>
    <script src="lib/isotope/isotope.pkgd.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>


</body>

</html>