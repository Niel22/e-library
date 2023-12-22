<?php

include 'config/server.php';
session_start();

if (isset($_SESSION['admin_id'])) {
  $admin_id = $_SESSION['admin_id'];

  $stmt = $conn->prepare('SELECT * FROM admin WHERE admin_id = ?');
  $stmt->bind_param('i', $admin_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows == 1) {
?>

    <!DOCTYPE html>
    <html lang="en">

    <?php include 'includes/head.php' ?>

    <body>

      <!-- ======= Header ======= -->
      <?php
      $stmt = $conn->prepare('SELECT * FROM admin WHERE admin_id = ?');
      $stmt->bind_param('s', $admin_id);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows === 1) {
        while ($rows = $result->fetch_assoc()) {

      ?>
          <?php include 'includes/header.php' ?>

          <!-- End Header -->

          <!-- ======= Sidebar ======= -->
          <?php include 'includes/sidebar.php' ?>
          <!-- End Sidebar-->

          <main id="main" class="main">

            <div class="pagetitle">
              <h1>Profile</h1>
              <nav>
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                  <li class="breadcrumb-item active">Profile</li>
                </ol>
              </nav>
            </div><!-- End Page Title -->

            <section class="section profile">
              <div class="row">
                <div class="col-xl-4">

                  <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                      <div class="profile-image-container d-flex justify-content-center align-center" style="width: 150px; height: 150px; border-radius: 50%; overflow: hidden;">
                        <img src="<?= $rows['image']; ?>" alt="Profile" style='width: 100%; height: 100%; object-fit: cover;'>
                      </div>
                      <h2><?= $rows['name']; ?></h2>
                    </div>
                  </div>

                </div>

                <div class="col-xl-8">

                  <div class="card">
                    <div class="card-body pt-3">
                      <!-- Bordered Tabs -->
                      <ul class="nav nav-tabs nav-tabs-bordered">

                        <li class="nav-item">
                          <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                        </li>

                        <li class="nav-item">
                          <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                        </li>

                      </ul>
                      <div class="tab-content pt-2">

                        <div class="tab-pane fade show active profile-overview" id="profile-overview">
                          <h5 class="card-title">Profile Details</h5>

                          <div class="row">
                            <div class="col-lg-3 col-md-4 label ">Admin Name</div>
                            <div class="col-lg-9 col-md-8"><?= $rows['name']; ?></div>
                          </div>


                          <div class="row">
                            <div class="col-lg-3 col-md-4 label">Email</div>
                            <div class="col-lg-9 col-md-8"><?= $rows['email']; ?></div>
                          </div>

                        </div>

                    <?php

                  }
                }
                    ?>


                    <div class="tab-pane fade pt-3" id="profile-change-password">
                      <!-- Change Password Form -->
                      <form action="config/changepassword.php" method="post">
                        <div class="row mb-3">
                          <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="password" type="password" class="form-control" id="currentPassword">
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="newpassword" type="password" class="form-control" id="newPassword">
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="confirmpassword" type="password" class="form-control" id="renewPassword">
                          </div>
                        </div>

                        <div class="text-center">
                          <button type="submit" name="submit" class="btn btn-success">Change Password</button>
                        </div>
                      </form><!-- End Change Password Form -->

                    </div>
                      </div><!-- End Bordered Tabs -->

                    </div>
                  </div>

                </div>
              </div>
            </section>


          </main><!-- End #main -->

          <!-- ======= Footer ======= -->
          <?php include 'includes/footer.php' ?>
          <?php include 'includes/foot.php' ?>

    </body>

    </html>
<?php
  } else {
    header('location:login.php');
  }
} else {
  header('location:login.php');
}
?>