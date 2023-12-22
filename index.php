  <?php
  include 'dashboard/config/server.php';

  $sql = 'SELECT * FROM users';
  $result = $conn->query($sql);
  $numUsers = $result->num_rows;

  $sql = 'SELECT * FROM materials';
  $result = $conn->query($sql);
  $numResources = $result->num_rows;

  $sql = 'SELECT * FROM users WHERE contributions > 1';
  $result = $conn->query($sql);
  $numTopContributors = $result->num_rows;
  ?>


  <?php
  include 'includes/head.php';
  ?>

  <body>


    <?php
    include 'includes/header.php';
    ?>


    <div class="untree_co-hero overlay" style="background-image: url('assets/img/hero-img-1-min.jpg');">


      <div class="container">
        <div class="row align-items-center justify-content-center">

          <div class="col-12">

            <div class="row justify-content-center ">

              <div class="col-lg-6 text-center ">

                <h1 class="mb-4 heading text-white" data-aos="fade-up" data-aos-delay="100">Welcome To FPI E-Library</h1>
                <p class="mb-0" data-aos="fade-up" data-aos-delay="300"><a href="dashboard" class="btn btn-success">Explore Available Materials</a></p>

              </div>


            </div>

          </div>

        </div> <!-- /.row -->
      </div> <!-- /.container -->

    </div> <!-- /.untree_co-hero -->

    <div class="untree_co-section">
      <div class="container">
        <div class="row justify-content-between">
          <div class="col-lg-5 mb-5">
            <h5 class="line-bottom mb-4" data-aos="fade-up" data-aos-delay="0">Welcome to FPI E-Library</h5>
            <p data-aos="fade-up" data-aos-delay="100">Explore a world of academic excellence at FPI. This digital library is dedicated to providing students and educators with a wealth of resources to support their learning journey.</p>
            <ul class="list-unstyled ul-check mb-5 primary" data-aos="fade-up" data-aos-delay="200">
              <li>Access a rich collection of past questions for comprehensive exam preparation.</li>
              <li>Explore an extensive library of PDFs and notes covering various courses and topics.</li>
              <li>Discover a curated selection of textbooks to enhance your studies.</li>
            </ul>
            
            <div class="row count-numbers mb-5">
              <div class="col-4 col-lg-4" data-aos="fade-up" data-aos-delay="0">
                <span class="counter d-block"><span data-number="<?= $numUsers;?>"><?= $numUsers;?></span><span>+</span></span>
                <span class="caption-2">Happy Users</span>
              </div>
              <div class="col-4 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <span class="counter d-block"><span data-number="<?= $numTopContributors;?>"><?= $numTopContributors;?></span><span>+</span></span>
                <span class="caption-2">Top Contributors</span>
              </div>
              <div class="col-4 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <span class="counter d-block"><span data-number="<?= $numResources;?>"><?= $numResources;?></span><span>+</span></span>
                <span class="caption-2">Resources Available</span>
              </div>
            </div>


            <p data-aos="fade-up" data-aos-delay="200">
              <a href="dashboard" class="btn btn-success">Discover Available Resources</a>
            </p>

          </div>
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
            <!-- Replace the video link and image source with appropriate content -->
              <img src="assets/img/img_5.jpg" alt="Library Image" class="img-fluid rounded">
          </div>
        </div>
      </div>
    </div>
    <!-- /.untree_co-section -->


    <?php
    include 'includes/footer.php';
    include 'includes/foot.php';
    ?>

  </body>

  </html>