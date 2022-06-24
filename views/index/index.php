<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <title><?php echo ESTABLISHMENT . ' :: ' . $this->title ?></title>
        <meta content="" name="description">
        <meta content="" name="keywords">

        <!-- Favicons -->
        <link href="<?php echo ASSETS_URL ?>img/favicon.png" rel="icon">
        <link href="<?php echo ASSETS_URL ?>img/apple-touch-icon.png" rel="apple-touch-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="<?php echo VENDORS_URL ?>aos/aos.css" rel="stylesheet">
        <link href="<?php echo VENDORS_URL ?>bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo VENDORS_URL ?>bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="<?php echo VENDORS_URL ?>boxicons/css/boxicons.min.css" rel="stylesheet">
        <link href="<?php echo VENDORS_URL ?>glightbox/css/glightbox.min.css" rel="stylesheet">
        <link href="<?php echo VENDORS_URL ?>swiper/swiper-bundle.min.css" rel="stylesheet">

        <!-- Template Main CSS File -->
        <link href="<?php echo ASSETS_URL ?>css/style.css" rel="stylesheet">
    </head>

    <body>

        <!-- ======= Top Bar ======= -->
        <section id="topbar" class="d-flex align-items-center">
            <div class="container d-flex justify-content-center justify-content-md-between">
                <div class="contact-info d-flex align-items-center">
                    <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@example.com">contact@example.com</a></i>
                    <i class="bi bi-phone d-flex align-items-center ms-4"><span>+2347073635354</span></i>
                </div>
                <div class="social-links d-none d-md-flex align-items-center">
                    <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
                </div>
            </div>
        </section>

        <!-- ======= Header ======= -->
        <header id="header" class="d-flex align-items-center">
            <div class="container d-flex align-items-center justify-content-between">

                <h1 class="logo"><a href="#">2 Factor Auth<span>.</span></a></h1>

                <nav id="navbar" class="navbar">
                    <ul>
                        <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                        <li><a class="nav-link scrollto" href="#about">About</a></li>
                        <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                        <li class="dropdown"><a href="#"><span>Account</span> <i class="bi bi-chevron-down"></i></a>
                            <ul>
                                <li><a href="<?php echo URL ?>/logout">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                    <i class="bi bi-list mobile-nav-toggle"></i>
                </nav><!-- .navbar -->

            </div>
        </header><!-- End Header -->

        <!-- ======= Hero Section ======= -->
        <section id="hero" class="d-flex align-items-center">
            <div class="container" data-aos="zoom-out" data-aos-delay="100">
                <h1>Welcome  <span><?php echo Session::get("name") ?></span></h1>
                <h2>Authentication takes place when someone tries to log into a computer resource (such as a network, device, or application)</h2>
                <div class="d-flex">
                    <a href="#about" class="btn-get-started scrollto">Get Started</a>
                    <a href ="https://www.youtube.com/watch?v=0mvCeNsTa1g" class="glightbox btn-watch-video"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
                </div>
            </div>
        </section><!-- End Hero -->

        <main id="main">



            <!-- ======= About Section ======= -->
            <section id="about" class="about section-bg">
                <div class="container" data-aos="fade-up">

                    <div class="section-title">
                        <h2>About</h2>
                        <h3>Find Out More <span>About 2Factor Authentication</span></h3>
                        <p>These are factors associated with the user, and are usually biometric methods, including fingerprint, face, voice, or iris recognition. Behavioral biometrics such as keystroke dynamics can also be used.</p>
                    </div>

                    <div class="row">
                        <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
                            <img src="<?php echo ASSETS_URL ?>img/about.png" class="img-fluid" alt="">
                        </div>
                        <div class="col-lg-6 pt-4 pt-lg-0 content d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="100">
                            <h3>Multi-factor authentication.</h3>
                            <p class="fst-italic">
                                Multi-factor authentication is an electronic authentication method in which a user is granted access to a 
                                website or application only after successfully presenting two or more pieces of evidence to an authentication mechanism: knowledge, possession, and inherence
                            </p>
                            <ul>
                                <li>
                                    <i class="bx bx-store-alt"></i>
                                    <div>
                                        <h5>Knowledge</h5>
                                        <p>Knowledge factors are the most commonly used form of authentication. In this form, the user is required to prove knowledge of a secret in order to authenticate.</p>
                                    </div>
                                </li>
                                <li>
                                    <i class="bx bx-images"></i>
                                    <div>
                                        <h5>Possession</h5>
                                        <p>Possession factors ("something only the user has") have been used for authentication for centuries, in the form of a key to a lock.</p>
                                    </div>
                                </li>
                            </ul>
                            <p>
                                Increasingly, a fourth factor is coming into play involving the physical location of the user. While hard wired to the corporate network, a user could be allowed to login using only a pin code. Whereas if the user was off the network, entering a code from a soft token as well could be required. This could be seen as an acceptable standard where access into the office is controlled.
                            </p>
                        </div>
                    </div>

                </div>
            </section><!-- End About Section -->

            <!-- ======= Skills Section ======= -->
            <section id="skills" class="skills">
                <div class="container" data-aos="fade-up">

                    <div class="row skills-content">

                        <div class="col-lg-6">

                            <div class="progress">
                                <span class="skill">HTML <i class="val">100%</i></span>
                                <div class="progress-bar-wrap">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>

                            <div class="progress">
                                <span class="skill">CSS <i class="val">90%</i></span>
                                <div class="progress-bar-wrap">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>

                            <div class="progress">
                                <span class="skill">JavaScript <i class="val">75%</i></span>
                                <div class="progress-bar-wrap">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-6">

                            <div class="progress">
                                <span class="skill">PHP <i class="val">80%</i></span>
                                <div class="progress-bar-wrap">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>

                            <div class="progress">
                                <span class="skill">WordPress/CMS <i class="val">90%</i></span>
                                <div class="progress-bar-wrap">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>

                            <div class="progress">
                                <span class="skill">Photoshop <i class="val">55%</i></span>
                                <div class="progress-bar-wrap">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </section><!-- End Skills Section -->

            <!-- ======= Counts Section ======= -->
            <section id="counts" class="counts">
                <div class="container" data-aos="fade-up">

                    <div class="row">

                        <div class="col-lg-3 col-md-6">
                            <div class="count-box">
                                <i class="bi bi-emoji-smile"></i>
                                <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="1" class="purecounter"></span>
                                <p>Happy Clients</p>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
                            <div class="count-box">
                                <i class="bi bi-journal-richtext"></i>
                                <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1" class="purecounter"></span>
                                <p>Projects</p>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                            <div class="count-box">
                                <i class="bi bi-headset"></i>
                                <span data-purecounter-start="0" data-purecounter-end="1463" data-purecounter-duration="1" class="purecounter"></span>
                                <p>Hours Of Support</p>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                            <div class="count-box">
                                <i class="bi bi-people"></i>
                                <span data-purecounter-start="0" data-purecounter-end="15" data-purecounter-duration="1" class="purecounter"></span>
                                <p>Hard Workers</p>
                            </div>
                        </div>

                    </div>

                </div>
            </section><!-- End Counts Section -->




            <!-- ======= Contact Section ======= -->
            <section id="contact" class="contact">
                <div class="container" data-aos="fade-up">

                    <div class="section-title">
                        <h2>Contact</h2>
                        <h3><span>Contact Us</span></h3>
                        <p>To know more about 2 Factors Authentical system, Contact us</p>
                    </div>

                    <div class="row" data-aos="fade-up" data-aos-delay="100">
                        <div class="col-lg-6">
                            <div class="info-box mb-4">
                                <i class="bx bx-map"></i>
                                <h3>Our Address</h3>
                                <p>P.M.B 05 Jalingo Road, Bali Taraba State</p>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="info-box  mb-4">
                                <i class="bx bx-envelope"></i>
                                <h3>Email Us</h3>
                                <p>contact@example.com</p>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="info-box  mb-4">
                                <i class="bx bx-phone-call"></i>
                                <h3>Call Us</h3>
                                <p>+234 07028373637</p>
                            </div>
                        </div>

                    </div>

                    <div class="row" data-aos="fade-up" data-aos-delay="100">

                        <div class="col-lg-6 ">
                            <iframe class="mb-4 mb-lg-0" src="https://www.google.com/maps/embed?pb=!1m26!1m12!1m3!1d15809.007990066977!2d10.962011777107488!3d7.868677809292817!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m11!3e6!4m3!3m2!1d7.853303899999999!2d10.9637456!4m5!1s0x10f8161e8be4957d%3A0xbda1128c13ae0baa!2sfederal%20polytechnic%20bali!3m2!1d7.884051899999999!2d10.977570799999999!5e0!3m2!1sen!2sng!4v1637972202117!5m2!1sen!2sng" frameborder="0" style="border:0; width: 100%; height: 384px;" allowfullscreen></iframe>
                        </div>

                        <div class="col-lg-6">
                            <form action="javascript:void(0)" method="post" role="form" class="php-email-form">
                                <div class="row">
                                    <div class="col form-group">
                                        <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                                    </div>
                                    <div class="col form-group">
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                                </div>
                                <div class="my-3">
                                    <div class="loading">Loading</div>
                                    <div class="error-message"></div>
                                    <div class="sent-message">Your message has been sent. Thank you!</div>
                                </div>
                                <div class="text-center"><button type="submit">Send Message</button></div>
                            </form>
                        </div>

                    </div>

                </div>
            </section><!-- End Contact Section -->

        </main><!-- End #main -->

        <!-- ======= Footer ======= -->
        <footer id="footer">




            <div class="container py-4">
                <div class="copyright">
                    &copy; Copyright <strong><span>2Factor Authentication</span></strong>. All Rights Reserved
                </div>
                <div class="credits">Designed by <a href="#">Name</a>
                </div>
            </div>
        </footer><!-- End Footer -->

        <div id="preloader"></div>
        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

        <!-- Vendor JS Files -->
        <script src="<?php echo VENDORS_URL ?>purecounter/purecounter.js"></script>
        <script src="<?php echo VENDORS_URL ?>aos/aos.js"></script>
        <script src="<?php echo VENDORS_URL ?>bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo VENDORS_URL ?>glightbox/js/glightbox.min.js"></script>
        <script src="<?php echo VENDORS_URL ?>isotope-layout/isotope.pkgd.min.js"></script>
        <script src="<?php echo VENDORS_URL ?>swiper/swiper-bundle.min.js"></script>
        <script src="<?php echo VENDORS_URL ?>waypoints/noframework.waypoints.js"></script>
        <script src="<?php echo VENDORS_URL ?>php-email-form/validate.js"></script>

        <!-- Template Main JS File -->
        <script src="<?php echo ASSETS_URL ?>js/main.js"></script>

    </body>

</html>