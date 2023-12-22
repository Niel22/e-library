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
                    <h1>Trash</h1>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Trash</li>
                        </ol>
                    </nav>
                </div><!-- End Page Title -->

                <section class="section dashboard">
                    <div class="row">


                        <!-- Recent Sales -->
                        <div class="col-12">
                            <div class="card  ">
                                <!-- Add filter dropdown if needed -->
                                <div class="card-body ">
                                    <p class="card-title">This section is showcasing all the deleted materials</p>
                                    <div class="table-responsive">
                                        <?php
                                        $sql = "SELECT * FROM materials WHERE type = 'trasheds' ORDER BY id DESC";
                                        $result = $conn->query($sql);
                                        $numRows = $result->num_rows;
                                        $rowLimit = 8 ;
                                        $totalPage = ceil($numRows / $rowLimit);
                                        for ($btn = 1; $btn <= $totalPage; $btn++) {
                                            echo '<a class="btn btn-success mx-1 mb-3 border"  class="text-light" href="?page=' . $btn . '">' . $btn . '</a>';
                                        }
                                        if (isset($_GET['page'])) {
                                            $page = $_GET['page'];
                                        } else {
                                            $page = 1;
                                        }

                                        $start = ($page - 1) * $rowLimit;
                                        $sql = "SELECT * FROM trashed LIMIT $start, $rowLimit";
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
                                                    <th>Type</th>
                                                    <th colspan='3' class="text-center">Action</th>
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
                                                            <td><?= $rows['type']; ?></td>
                                                            <td>
                                                                <a target="_blank" href="<?= $rows['material_file']; ?>" class="btn btn-primary">
                                                                    <i class="bi bi-eye"></i>
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <a href="config/restore.php?id=<?= $rows['id']; ?>" class="btn btn-success">
                                                                    <i class="bi bi-arrow-clockwise"></i>
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <a href="config/deletetrash.php?id=<?= $rows['id']; ?>" class="btn btn-danger">
                                                                    <i class="bi bi-trash"></i>
                                                                </a>
                                                            </td>



                                                        </tr>
                                                        </tr>
                                                <?php
                                                    }
                                                } else {
                                                    echo '<tr><td colspan="7">No trasheds available</td></tr>';
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