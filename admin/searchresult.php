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
                                                                        <i class="bi bi-eye"></i>
                                                                    </a>
                                                                </td>
                                                                <td>
                                                                    <a href="<?= $rows['material_file']; ?>" download class="btn btn-success">
                                                                        <i class="bi bi-download"></i>
                                                                    </a>
                                                                </td>
                                                                <td>
                                                                    <a href="edit.php?id=<?= $rows['id']; ?>" class="btn btn-warning">
                                                                        <i class="bi bi-pencil"></i>
                                                                    </a>
                                                                </td>
                                                                <td>
                                                                    <a href="config/delete.php?id=<?= $rows['id']; ?>" class="btn btn-danger">
                                                                        <i class="bi bi-trash"></i>
                                                                    </a>
                                                                </td>

                                                            </tr>
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
        header('location:login.php');
    }
} else {
    header('location:login.php');
}
?>