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

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $stmt = $conn->prepare('SELECT * FROM materials WHERE id = ?');
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                while ($rows = $result->fetch_assoc()) {
                    $type = $rows['type'];
                    $courseName = $rows['course_name'];
                    $courseCode = $rows['course_code'];
                    $semester = $rows['semester'];
                    $department = $rows['department'];
                    $level = $rows['level'];
                    $file = $rows['material_file'];
                    $year = $rows['year'];
                }
            }
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
                        <h1>Edit Materials</h1>
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">Edit</li>
                            </ol>
                        </nav>
                    </div><!-- End Page Title -->

                    <section class="section">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Fill in the details of the material you want to upload.</h5>

                                        <!-- General Form Elements -->

                                        <form action="config/update.php?id=<?= $id; ?>" method="post" enctype="multipart/form-data">
                                            <div class="row mb-3">
                                                <label for="inputText" class="col-sm-2 col-form-label">Type:</label>
                                                <div class="col-sm-10">
                                                    <select class="form-select" required name="type" aria-label="Default select example">
                                                        <option <?= ($type == 'Past Questions') ? 'selected' : ''; ?> value="Past Questions">Past Questions</option>
                                                        <option <?= ($type == 'PDFs/Notes') ? 'selected' : ''; ?> value="PDFs/Notes">PDFs/Notes</option>
                                                        <option <?= ($type == 'Textbook') ? 'selected' : ''; ?> value="Textbooks">Textbook</option>
                                                    </select>
                                                    <p class="text-info" style="font-size: 12px;">* Select the type</p>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="inputText" class="col-sm-2 col-form-label">Course Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="courseName" value="<?= $courseName; ?>" required class="form-control">
                                                    <p class="text-info" style="font-size: 12px;">* Indicate using (Multiple Courses) if the courses in the pdf file is more than one</p>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="inputEmail" class="col-sm-2 col-form-label">Course Code</label>
                                                <div class="col-sm-10">
                                                    <input type="text" value="<?= $courseCode; ?>" name="courseCode" required class="form-control">
                                                    <p class="text-info" style="font-size: 12px;">* Indicate using (Multiple Courses) if the courses in the pdf file is more than one</p>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="inputPassword" class="col-sm-2 col-form-label">Semester</label>
                                                <div class="col-sm-10">
                                                    <select class="form-select" name="semester" required aria-label="Default select example">
                                                        <option <?= ($semester == 'First Semester') ? 'selected' : ''; ?> value="First Semester">First Semester</option>
                                                        <option <?= ($semester == 'Second Semester') ? 'selected' : ''; ?> value="Second Semester">Second Semester</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="inputNumber" class="col-sm-2 col-form-label">Department</label>
                                                <div class="col-sm-10">
                                                    <input type="text" value="<?= $department; ?>" name="department" required class="form-control">
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="inputNumber" class="col-sm-2 col-form-label">Level</label>
                                                <div class="col-sm-10">
                                                    <select class="form-select" name="level" required aria-label="Default select example">
                                                        <option <?= ($level == 'ND I') ? 'selected' : ''; ?> value="ND I">ND I</option>
                                                        <option <?= ($level == 'ND II') ? 'selected' : ''; ?> value="ND II">ND II</option>
                                                        <option <?= ($level == 'HND I') ? 'selected' : ''; ?> value="HND I">HND I</option>
                                                        <option <?= ($level == 'HND II') ? 'selected' : ''; ?> value="HND II">HND II</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="inputNumber" class="col-sm-2 col-form-label">Upload File:</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" name="file" type="file" id="formFile">
                                                    <p class="text-info" style="font-size: 12px;">* You will have to re upload the file</p>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="inputDate" class="col-sm-2 col-form-label">Year</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="year" value="<?= $year; ?>" required class="form-control">
                                                    <p class="text-info" style="font-size: 12px;">* Indicate using (Multiple Years) if the courses in the pdf file is more than one</p>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-lg-12 col-sm-12 col-md-12 col-12">
                                                    <button type="submit" name="submit" class="btn btn-success w-100">Update</button>
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
        }
    } else {
        header('location:login.php');
    }
} else {
    header('location:login.php');
}
?>