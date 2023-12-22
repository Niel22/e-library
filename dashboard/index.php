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
      <?php

        }
      }
      ?>
      <!-- End Header -->

      <!-- ======= Sidebar ======= -->
      <?php include 'includes/sidebar.php' ?>
      <!-- End Sidebar-->

      <main id="main" class="main">

        <div class="pagetitle">
          <h1>Dashboard</h1>
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
          <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">
              <div class="row">

                <!-- Sales Card -->
                <div class="col-xxl-4 col-md-6 col-12">
                  <div class="card info-card sales-card">

                    <div class="filter">
                      <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">

                        <li><a class="dropdown-item" href="./pastquestion">View</a></li>
                      </ul>
                    </div>
                    <div class="card-body">
                      <a href="./pastquestion">
                        <h5 class="card-title">Past Questions</h5>
                      </a>
                      <?php
                      $sql = 'SELECT * FROM materials WHERE type = "past questions"';
                      $result = $conn->query($sql);
                      $numPQ = $result->num_rows;
                      ?>
                      <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                          <i class="bi bi-file-earmark-text"></i>
                        </div>
                        <div class="ps-3">
                          <h6><?= $numPQ; ?></h6>

                        </div>
                      </div>
                    </div>

                  </div>
                </div><!-- End Sales Card -->

                <!-- Revenue Card -->
                <div class="col-xxl-4 col-md-6 col-12">
                  <div class="card info-card revenue-card">

                    <div class="filter">
                      <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">

                        <li><a class="dropdown-item" href="#">View</a></li>
                      </ul>
                    </div>

                    <div class="card-body">
                      <a href="./pdfandnotes">
                        <h5 class="card-title">PDFs & Notes</h5>
                      </a>
                      <?php
                      $sql = 'SELECT * FROM materials WHERE type = "PDFs/Notes"';
                      $result = $conn->query($sql);
                      $numPDF = $result->num_rows;
                      ?>
                      <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                          <i class="bi bi-file-pdf"></i>
                        </div>
                        <div class="ps-3">
                          <h6><?= $numPDF; ?></h6>

                        </div>
                      </div>
                    </div>

                  </div>
                </div><!-- End Revenue Card -->

                <!-- Customers Card -->
                <div class="col-xxl-4 col-xl-12">

                  <div class="card info-card customers-card">

                    <div class="filter">
                      <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">

                        <li><a class="dropdown-item" href="#">View</a></li>
                      </ul>
                    </div>

                    <div class="card-body">
                      <a href="./textbooks">
                        <h5 class="card-title">Textbooks</h5>
                      </a>
                      <?php
                      $sql = 'SELECT * FROM materials WHERE type = "Textbooks"';
                      $result = $conn->query($sql);
                      $numTXT = $result->num_rows;
                      ?>
                      <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                          <i class="bi bi-book"></i>
                        </div>
                        <div class="ps-3">
                          <h6><?= $numTXT; ?></h6>

                        </div>
                      </div>

                    </div>
                  </div>

                </div><!-- End Customers Card -->

                <!-- Recent Sales -->
                <div class="col-12">
                  <div class="card  ">
                    <!-- Add filter dropdown if needed -->
                    <div class="card-body ">
                      <h5 class="card-title">Top Searched Materials</h5>
                      <div class="table-responsive">
                        <?php
                        $sql = "SELECT * FROM materials WHERE searched > 10 ORDER BY id ASC";
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
                        $sql = "SELECT * FROM materials WHERE searched > 10 LIMIT $start, $rowLimit";
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
                                </tr>
                            <?php
                              }
                            } else {
                              echo '<tr><td colspan="7">No PDF/Note available</td></tr>';
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
                </div><!-- End Top Selling -->

              </div>
            </div><!-- End Left side columns -->
        </section>

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