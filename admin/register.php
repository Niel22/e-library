
<!DOCTYPE html>
<html lang="en">

<?php include 'includes/head.php'?>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-6 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="../index.php" class="logo d-flex align-items-center w-auto">
                  <span class=" d-lg-block">FPI E-LIBRARY</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Create an Account as an Admin</h5>
                    <p class="text-center small">Enter your personal details to create account</p>
                  </div>

                  <form class="row g-3 needs-validation" action="config/register.php" method="post" enctype="multipart/form-data" autocomplete="off">
                    <div class="col-12">
                      <label for="yourName" class="form-label">Username</label>
                      <input type="text" name="name" autocomplete="off" class="form-control" id="yourName" value="" required>
                      <div class="invalid-feedback">Please, enter your name!</div>
                    </div>

                    <div class="col-12">
                      <label for="yourEmail" class="form-label">Your Email</label>
                      <input type="email" name="email" autocomplete="off" class="form-control" id="yourEmail" required>
                      <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                      <?php
                      if (isset($_GET['exist'])) {
                      ?>
                        <div id="exist" style="font-size: 12px;" class=" text-danger">
                          <?= $_GET['exist']; ?>
                        </div>
                        <script>
                          // Close the alert after 3 seconds (adjust as needed)
                          setTimeout(function() {
                            document.getElementById('exist').style.display = 'none';
                          }, 3000);
                        </script>
                      <?php
                      }
                      ?>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" autocomplete="off" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="col-12">
                      <label for="yourEmail" class="form-label">Your Image</label>
                      <input type="file" name="image" class="form-control" id="yourEmail">
                      <div class="invalid-feedback"></div>
                      <?php
                      if (isset($_GET['format'])) {
                      ?>
                        <div id="exist" style="font-size: 12px;" class=" text-danger">
                          <?= $_GET['format']; ?>
                        </div>
                        <script>
                          // Close the alert after 3 seconds (adjust as needed)
                          setTimeout(function() {
                            document.getElementById('format').style.display = 'none';
                          }, 3000);
                        </script>
                      <?php
                      }
                      ?>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-success w-100" type="submit">Create Account</button>
                    </div>
                    
                  </form>

                </div>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <?php include 'includes/foot.php' ?>


</body>

</html>