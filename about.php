<?php
include 'dashboard/config/server.php';


?>

<?php
include 'includes/head.php';
?>

<body>


    <?php
    include 'includes/header.php';
    ?>




    <div class="untree_co-hero overlay" style="background-image: url('assets/img/img-school-2-min.jpg');">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 text-center">
                            <h1 class="mb-4 heading text-white" data-aos="fade-up" data-aos-delay="100">Welcome to FPI E-Library</h1>
                            <div class="mb-5 text-white desc mx-auto" data-aos="fade-up" data-aos-delay="200">
                                <p>Empowering minds through knowledge – Explore a world of learning at FPI E-Library, where education transcends boundaries.</p>
                            </div>

                            <p class="mb-0" data-aos="fade-up" data-aos-delay="300"><a href="dashboard" class="btn btn-primary">Discover Resources</a></p>

                        </div>
                    </div>
                </div>
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </div>
    <!-- /.untree_co-hero -->




    <div class="services-section">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <div class="section-title mb-3" data-aos="fade-up" data-aos-delay="0">
                        <h2 class="line-bottom mb-4">Become a Top Contributor</h2>
                    </div>

                    <p data-aos="fade-up" data-aos-delay="100">Join our community of knowledge sharers and become a top contributor to the FPI E-Library. Your active participation helps enrich the learning experience for everyone.</p>

                    <ul class="ul-check list-unstyled mb-5 primary" data-aos="fade-up" data-aos-delay="200">
                        <li>Share educational materials with the community.</li>
                        <li>Contribute to the growth of our vast knowledge base.</li>
                        <li>Play a key role in fostering a collaborative learning environment.</li>
                    </ul>

                    <p data-aos="fade-up" data-aos-delay="300"><a href="dashboard/upload" class="btn btn-primary">Get Started</a></p>
                </div>
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="0">
                    <figure class="img-wrap-2">
                        <img src="assets/img/teacher-min.jpg" alt="Top Contributor Image" class="img-fluid">
                        <div class="dotted"></div>
                    </figure>
                </div>
            </div>
        </div>
    </div>


    <div class="untree_co-section bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-7 text-center" data-aos="fade-up" data-aos-delay="0">
                    <h2 class="line-bottom text-center mb-4">Top Contributors</h2>
                    <p>Meet the dedicated individuals who contribute significantly to our academic community.</p>
                </div>
            </div>
            <div class="row">
                <?php
                $sql = 'SELECT * FROM users WHERE contributions > 1 LIMIT 0, 6';
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($rows = $result->fetch_assoc()) {
                ?>
                        <?php $image = 'dashboard/' . $rows['image']; ?>
                        <div class="col-12 col-sm-6 col-md-6 mb-4 mb-lg-0 col-lg-4" data-aos="fade-up" data-aos-delay="0">
                            <div class="staff text-center">
                                <div class=" m-auto mb-4 d-flex justify-content-center align-center" style="width: 200px; height: 200px; overflow: hidden;"><img src="<?= $image; ?>" alt="<?= $rows['name']; ?>" style='width: 100%; height: 100%; object-fit: cover;'></div>
                                <div class="staff-body">
                                    <h3 class="staff-name mt-3"><?= $rows['name']; ?><span class="m-1 bi bi-check-circle-fill text-primary"></span></h3>
                                    <span class="d-block position mb-4">Top Contributor</span>
                                    <p class="mb-4">Passionate about sharing knowledge and contributing valuable resources to the community.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Repeat the above block for additional top contributors -->
                <?php
                    }
                } else {
                    echo '<h2 class="text-center">No Top Contributors</h2>';
                }
                ?>
            </div>
        </div>
    </div>
    <!-- /.untree_co-section -->



    <div class="untree_co-section">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-7 text-center" data-aos="fade-up" data-aos-delay="0">
                    <h2 class="line-bottom text-center mb-4">Explore Our Resources</h2>
                    <p>Discover a wealth of educational materials across various categories to enhance your learning experience.</p>
                </div>
            </div>
            <div class="row">
                <!-- Category: Past Questions -->
                <div class="col-12 col-sm-12 col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature">
                        <span class="uil uil-history"></span>
                        <h3>Past Questions</h3>
                        <p>Access a collection of past questions to aid in your preparation and understanding of previous exams.</p>
                        <a href="dashboard/pastquestion" class="btn btn-success">See more</a>
                    </div>
                </div>
                <!-- Category: PDFs and Notes -->
                <div class="col-12 col-sm-12 col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature">
                        <span class="uil uil-calculator-alt"></span>
                        <h3>PDFs and Notes</h3>
                        <p>Explore a repository of PDFs and comprehensive notes to support your academic journey.</p>
                        <a href="dashboard/pdfandnotes" class="btn btn-success">See more</a>
                    </div>
                </div>
                <!-- Category: Textbooks -->
                <div class="col-12 col-sm-12 col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature">
                        <span class="uil uil-book-open"></span>
                        <h3>Textbooks</h3>
                        <p>Access textbooks covering various subjects to deepen your understanding and knowledge.</p>
                        <a href="dashboard/textbooks" class="btn btn-success">See more</a>
                    </div>
                </div>
                <!-- Add more categories as needed -->
            </div>
        </div> <!-- /.container -->
    </div>
    <!-- /.untree_co-section -->




    <div class="untree_co-section">


        <div class="container">
            <div class="row">
                <div class="col-lg-5 mr-auto mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="0">
                    <img src="assets/img/img-school-3-min.jpeg" alt="Library Image" class="img-fluid">
                </div>
                <div class="col-lg-7 ml-auto" data-aos="fade-up" data-aos-delay="100">
                    <h3 class="line-bottom mb-4">Why Choose FPI E-Library?</h3>
                    <p>Discover the unique features that make the Federal Polytechnic Ilaro E-Library the ideal choice for your academic journey.</p>

                    <div class="custom-accordion" id="accordion_1">
                        <div class="accordion-item">
                            <h2 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Extensive Educational Resources</button>
                            </h2>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion_1">
                                <div class="accordion-body">
                                    <div class="d-flex">
                                        <div class="accordion-img mr-4">
                                            <img src="assets/img/img-school-3-min.jpeg" alt="Books" class="img-fluid">
                                        </div>
                                        <div>
                                            <p>Access a wealth of educational resources including past questions, PDFs, notes, and textbooks tailored to enhance your learning experience.</p>
                                            <p>Explore a vast ocean of knowledge right at your fingertips.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- .accordion-item -->

                        <div class="accordion-item">
                            <h2 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Active Community of Top Contributors</button>
                            </h2>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion_1">
                                <div class="accordion-body">
                                    <div class="d-flex">
                                        <div class="accordion-img mr-4">
                                            <img src=assets/img/img-school-3-min.jpeg" alt="Top Contributors" class="img-fluid">
                                        </div>
                                        <div>
                                            <p>Become a top contributor by actively uploading and sharing valuable educational materials. Join a community dedicated to academic excellence.</p>
                                            <p>Contribute to the collective growth of knowledge.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- .accordion-item -->
                        <div class="accordion-item">
                            <h2 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Effortless Navigation and User-Friendly Interface</button>
                            </h2>

                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion_1">
                                <div class="accordion-body">
                                    <div class="d-flex">
                                        <div class="accordion-img mr-4">
                                            <img src="assets/img/img-school-3-min.jpeg" alt="User-Friendly Interface" class="img-fluid">
                                        </div>
                                        <div>
                                            <p>Enjoy a seamless experience with our user-friendly interface. Effortlessly navigate through our extensive collection of educational materials.</p>
                                            <p>Your journey to knowledge begins with simplicity.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div> <!-- .accordion-item -->

                    </div>

                </div>
            </div>
        </div>

    </div> <!-- /.untree_co-section -->

    <?php
    include 'includes/footer.php';
    include 'includes/foot.php';
    ?>

</body>

</html>