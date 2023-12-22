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
                    <h1>Search Result</h1>
                </div><!-- End Page Title -->

                <section class="section dashboard">
                    <div class="row">


                        <!-- Recent Sales -->
                        <div class="col-12">
                            <div class="card  ">
                                <!-- Add filter dropdown if needed -->
                                <?php
                                if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                                    function val($data)
                                    {
                                        $data = trim($data);
                                        $data = stripslashes($data);
                                        $data = htmlspecialchars($data);
                                        return $data;
                                    }

                                    $searchquery = val($_POST['searchquery']);

                                    $stmt = $conn->prepare('SELECT * FROM materials WHERE `type` LIKE ?  OR course_name LIKE ? OR course_code LIKE ? OR  semester LIKE ? OR department LIKE ? OR level LIKE ? OR year LIKE ? ');
                                    $likepattern = "%$searchquery%";
                                    $stmt->bind_param('sssssss', $likepattern, $likepattern, $likepattern, $likepattern, $likepattern, $likepattern, $likepattern);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                ?>
                                    <div class="card-body ">
                                        <p class="card-title text-dark">This section is showcasing the available results for <?= '"' . $searchquery . '"'; ?></p>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead style="background-color: black;">
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
                                                            $stmt = $conn->prepare('UPDATE materials SET searched = searched + 1 WHERE id = ?');
                                                            $stmt->bind_param('i', $rows['id']);
                                                            $stmt->execute();
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
                                                        echo '<tr><td colspan="7" class="text-center">"' . $searchquery . '" Not Found For your search</td></tr>';
                                                    }
                                                }
                                                ?>
                                                </tbody>
                                            </table>
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