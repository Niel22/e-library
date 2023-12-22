<!DOCTYPE html>
<html lang="en">

<?php include 'includes/head.php' ?>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="../index.php" class="logo d-flex align-items-center w-auto">
                  <span class=" d-lg-block">FPI E-LIBRARY</span>
                </a>
              </div><!-- End Logo -->


              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                    <p class="text-center small">Enter your username & password to login</p>
                  </div>

                  <form class="row g-3 needs-validation" action="config/login.php" method="post">

                    <div class="col-12">
                      <label for="email" class="form-label">Email</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="email" name="email" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Please enter your email.</div>
                      </div>
                      <?php
                      if (isset($_GET['emerror'])) {
                      ?>
                        <div id="emerror-alert" style="font-size: 12px;" class=" text-danger">
                          <?= $_GET['emerror']; ?>
                        </div>
                        <script>
                          // Close the alert after 3 seconds (adjust as needed)
                          setTimeout(function() {
                            document.getElementById('emerror-alert').style.display = 'none';
                          }, 3000);
                        </script>
                      <?php
                      }
                      ?>
                    </div>

                    <div class="col-12">
                      <div class="d-flex justify-content-between">
                      <label for="yourPassword" class="form-label">Password</label>
                      </div>
                      <div class="input-group has-validation">
                        <input type="password" name="password" class="form-control" id="yourPassword" required>
                        <div class="invalid-feedback">Please enter your password!</div>
                      </div>
                      <?php
                      if (isset($_GET['perror'])) {
                      ?>
                        <div id="perror-alert" style="font-size: 12px;" class=" text-danger">
                          <?= $_GET['perror']; ?>
                        </div>
                        <script>
                          // Close the alert after 3 seconds (adjust as needed)
                          setTimeout(function() {
                            document.getElementById('perror-alert').style.display = 'none';
                          }, 3000);
                        </script>
                      <?php
                      }
                      ?>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-success w-100" type="submit">Login</button>
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