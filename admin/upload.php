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
                    <h1>Upload Materials</h1>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Upload</li>
                        </ol>
                    </nav>
                </div><!-- End Page Title -->

                <section class="section">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php
                            if (isset($_GET['success'])) {
                            ?>
                                <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong><?= $_GET['success']; ?></strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Fill in the details of the material you want to upload.</h5>

                                    <!-- General Form Elements -->
                                    <form action="config/uploadfile.php" method="post" enctype="multipart/form-data">
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-2 col-form-label">Type:</label>
                                            <div class="col-sm-10">
                                                <select class="form-select" required name="type" aria-label="Default select example">
                                                    <option selected value="Past Questions">Past Questions</option>
                                                    <option value="PDFs/Notes">PDFs/Notes</option>
                                                    <option value="Textbooks">Textbook</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-2 col-form-label">Course Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="courseName" required class="form-control">
                                                <p class="text-info" style="font-size: 12px;">* Indicate using (Multiple Courses) if the courses in the pdf file is more than one</p>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Course Code</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="courseCode" required class="form-control">
                                                <p class="text-info" style="font-size: 12px;">* Indicate using (Multiple Courses) if the courses in the pdf file is more than one</p>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputPassword" class="col-sm-2 col-form-label">Semester</label>
                                            <div class="col-sm-10">
                                                <select class="form-select" name="semester" required aria-label="Default select example">
                                                    <option selected value="First Semester">First Semester</option>
                                                    <option value="Second Semester">Second Semester</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputNumber" class="col-sm-2 col-form-label">Department</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="department" required class="form-control">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputNumber" class="col-sm-2 col-form-label">Level</label>
                                            <div class="col-sm-10">
                                                <select class="form-select" name="level" required aria-label="Default select example">
                                                    <option selected value="ND I">ND I</option>
                                                    <option value="ND II">ND II</option>
                                                    <option value="HND I">HND I</option>
                                                    <option value="HND II">HND II</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputNumber" class="col-sm-2 col-form-label">Upload File:</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" name="file" required type="file" id="formFile">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputDate" class="col-sm-2 col-form-label">Year</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="year" required class="form-control">
                                                <p class="text-info" style="font-size: 12px;">* Indicate using (Multiple Years) if the courses in the pdf file is more than one</p>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-lg-12 col-sm-12 col-md-12 col-12">
                                                <button type="submit" name="submit" class="btn btn-success w-100">Upload</button>
                                            </div>
                                        </div>

                                    </form>

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
        header('location:login.php');
    }
} else {
    header('location:login.php');
}
?>