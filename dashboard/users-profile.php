<?php

include 'config/server.php';
session_start();

if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];

  $stmt = $conn->prepare('SELECT * FROM users WHERE user_id = ?');
  $stmt->bind_param('i', $user_id);
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
      $stmt = $conn->prepare('SELECT * FROM users WHERE user_id = ?');
      $stmt->bind_param('s', $user_id);
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
                  <li class="breadcrumb-item"><a href="./">Home</a></li>
                  <li class="breadcrumb-item active">Profile</li>
                </ol>
              </nav>
            </div><!-- End Page Title -->

            <section class="section profile">
              <div class="row">
                <div class="col-xl-4">

                  <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                      <div class="profile-image-container <?= ($rows['contributions'] > 10 ? ' border border-4 border-primary' : " "); ?> d-flex justify-content-center align-center " style="width: 150px; height: 150px; border-radius: 50%; overflow: hidden;">
                        <div class="profile-image-container  d-flex justify-content-center align-center" style="width: 150px; height: 150px; border-radius: 50%; overflow: hidden;">
                          <img src="<?= $rows['image']; ?>" alt="Profile" style='width: 100%; height: 100%; object-fit: cover;'>
                        </div>
                      </div>
                      <h2><?= $rows['name']; ?><?= ($rows['contributions'] > 10 ? '<span class="m-1 bi bi-check-circle-fill text-primary" style="font-size: ;"></span>' : " "); ?> </h2>
                      <p class="mt-2"><?= $rows['department']; ?></p>
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
                            <div class="col-lg-3 col-md-4 label ">Username</div>
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
            <div class="col-12">
              <?php
              if (isset($_GET['download'])) {
              ?>
                <div id="download" class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong><?= $_GET['download']; ?></strong>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <script>
                  // Close the alert after 3 seconds (adjust as needed)
                  setTimeout(function() {
                    document.getElementById('download').style.display = 'none';
                  }, 3000);
                </script>
              <?php
              }
              ?>

              <?php
              if (isset($_GET['error'])) {
              ?>
                <div id="error" class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong><?= $_GET['error']; ?></strong>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <script>
                  // Close the alert after 3 seconds (adjust as needed)
                  setTimeout(function() {
                    document.getElementById('error').style.display = 'none';
                  }, 3000);
                </script>
              <?php
              }
              ?>
              <div class="card  ">
                <!-- Add filter dropdown if needed -->
                <div class="card-body ">
                  <h5 class="card-title">Your Uploads</h5>
                  <div class="table-responsive">
                    <?php
                    $sql = "SELECT * FROM materials WHERE user_id = $user_id ORDER BY id DESC";
                    $result = $conn->query($sql);
                    $numRows = $result->num_rows;
                    $rowLimit = 10;
                    $totalPage = ceil($numRows / $rowLimit);

                    if (isset($_GET['page'])) {
                      $page = $_GET['page'];
                    } else {
                      $page = 1;
                    }

                    $start = ($page - 1) * $rowLimit;
                    $sql = "SELECT * FROM materials WHERE user_id = $user_id LIMIT $start, $rowLimit";
                    $result = $conn->query($sql);
                    ?>
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Course Name</th>
                          <th>C.Code</th>
                          <th>Semester</th>
                          <th>Department</th>
                          <th>Level</th>
                          <th>Year</th>
                          <th colspan='2' class="text-center">Action</th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php
                        if ($result->num_rows > 0) {
                          while ($rows = $result->fetch_assoc()) {
                        ?>
                            <tr>
                              <td><?= $rows['course_name']; ?></td>
                              <td><?= $rows['course_code']; ?></td>
                              <td><?= $rows['semester']; ?></td>
                              <td><?= $rows['department']; ?></td>
                              <td><?= $rows['level']; ?></td>
                              <td><?= $rows['year']; ?></td>
                              <td>
                                <a target="_blank" href="<?= $rows['material_file']; ?>" class="btn btn-primary">
                                  <span class="d-none d-md-inline">View</span>
                                  <i class="d-md-none bi bi-eye"></i>
                                </a>
                              </td>
                              <td>
                                <a href="<?= $rows['material_file']; ?>" download class="btn btn-success">
                                  <span class="d-none d-md-inline">Download</span>
                                  <i class="d-md-none bi bi-download"></i>
                                </a>
                              </td>
                              <td>
                                <a data-bs-toggle="modal" data-bs-target="#delete" class="btn btn-danger">
                                  <i class="bi bi-trash"></i>
                                </a>
                              </td>
                              <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-body">
                                      Are you sure you want to delete.
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                      <a type="button" href="config/delete.php?id=<?= $rows['id']; ?>" class="btn btn-danger">Delete</a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </tr>
                        <?php
                          }
                        } else {
                          echo '<tr><td colspan="7">You have not uploaded anything yet.</td></tr>';
                        }
                        ?>
                      </tbody>
                    </table>
                    <?php
                    for ($btn = 1; $btn <= $totalPage; $btn++) {
                      echo '<a class="btn btn-success mx-1 mb-3 border"  class="text-light" href="?page=' . $btn . '">' . $btn . '</a>';
                    }
                    ?>

                  </div>
                </div>


              </div>
            </div>

          </main><!-- End #main -->

          <!-- ======= Footer ======= -->
          <?php include 'includes/footer.php' ?>
          <?php include 'includes/foot.php' ?>

    </body>

    </html>
<?php
  } else {
    header('location:pages-login.php');
  }
} else {
  header('location:pages-login.php');
}
?>