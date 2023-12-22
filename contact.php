<?php
include 'dashboard/config/server.php';

if (isset($_POST['submit'])) {
  function val($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  $name = val($_POST['name']);
  $email = val($_POST['email']);
  $subject = val($_POST['subject']);
  $message = val($_POST['message']);

  $stmt = $conn->prepare('INSERT INTO emails (name, email, subject, message) VALUES (?, ?, ?, ?)');
  $stmt->bind_param('ssss', $name, $email, $subject, $message);
  $result = $stmt->execute();
  if ($result) {
    header('location:./contact?success=Message sent.');
    exit;
  }
  $stmt->close();
}

?>

<?php
include 'includes/head.php';
?>

<body>


  <?php
  include 'includes/header.php';
  ?>


  <div class="untree_co-hero overlay" style="background-image: url('assets/img/img-school-41-min.jpg');">
    <div class="container">
      <div class="row align-items-center justify-content-center">
        <div class="col-12">
          <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
              <h1 class="mb-4 heading text-white" data-aos="fade-up" data-aos-delay="100">Get In Touch</h1>
              <div class="mb-5 text-white desc mx-auto" data-aos="fade-up" data-aos-delay="200">
                <p>Welcome to the FPI E-Library's Contact Us page. Feel free to reach out to us for any inquiries, assistance, or feedback. We're here to help you on your academic journey.</p>
              </div>

              <p class="mb-0" data-aos="fade-up" data-aos-delay="300"><a href="dashboard" class="btn btn-success">Explore Our Resources</a></p>

            </div>
          </div>
        </div>
      </div><!-- /.row -->
    </div><!-- /.container -->
  </div>
  <!-- /.untree_co-hero -->




  <div class="untree_co-section">
    <div class="container">

      <div class="row mb-5">
        <div class="col-lg-4 mb-5 order-2 mb-lg-0" data-aos="fade-up" data-aos-delay="100">
          <div class="contact-info">

            <div class="address mt-4">
              <i class="icon-room"></i>
              <h4 class="mb-2">Location:</h4>
              <p>Federal Polytechnic Ilaro, Ogun State</p>
            </div>

            <div class="open-hours mt-4">
              <i class="icon-clock-o"></i>
              <h4 class="mb-2">Open Hours:</h4>
              <p>
                Always Open
              </p>
            </div>

            <div class="email mt-4">
              <i class="icon-envelope"></i>
              <h4 class="mb-2">Email:</h4>
              <p>novacode@gmail.com</p>
            </div>

          </div>
        </div>
        <div class="col-lg-7 mr-auto order-1" data-aos="fade-up" data-aos-delay="200">
          <?php
          if (isset($_GET['success'])) {
          ?>
            <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
              <strong><?= $_GET['success']; ?></strong>
            </div>
            <script>
              // Close the alert after 3 seconds (adjust as needed)
              setTimeout(function() {
                document.getElementById('success-alert').style.display = 'none';
              }, 3000);
            </script>
          <?php
          }
          ?>
          <form action="" method="post">
            <div class="row">
              <div class="col-6 mb-3">
                <input type="text" name="name" required class="form-control" placeholder="Your Name">
              </div>
              <div class="col-6 mb-3">
                <input type="email" name="email" required class="form-control" placeholder="Your Email">
              </div>
              <div class="col-12 mb-3">
                <input type="text" name="subject" required class="form-control" placeholder="Subject">
              </div>
              <div class="col-12 mb-3">
                <textarea id="" name="message" required cols="30" rows="7" class="form-control" placeholder="Message"></textarea>
              </div>

              <div class="col-12">
                <input type="submit" name="submit" value="Send Message" class="btn btn-primary">
              </div>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>
  <!-- /.untree_co-section -->

  <div class="site-footer">


    <div class="container">

      <?php
      include 'includes/footer.php';
      include 'includes/foot.php';
      ?>

</body>

</html>