<?php

include 'server.php';
session_start();

if (isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];

    if (isset($_POST['submit'])) {
        $id = $_GET['id'];
        function val($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $type = $_POST['type'];
        $courseName = val($_POST['courseName']);
        $CourseCode = $_POST['courseCode'];
        $semester = $_POST['semester'];
        $department = val($_POST['department']);
        $level = $_POST['level'];
        $year = $_POST['year'];
        $file = $_FILES['file'];

        $fileName = $file['name'];
        $fileTempName = $file['tmp_name'];

        $fileDiv = explode('.', $fileName);
        $fileExt = strtolower(end($fileDiv));

        $extList = array('pdf', 'jpeg', 'jpg', 'png', 'docx', 'xlsx');
        if (in_array($fileExt, $extList)) {

            $fileUrl = 'assets/materials/' . $fileName;
            $filePath = '../../dashboard/' . $fileUrl;
            $moved = move_uploaded_file($fileTempName, $filePath);
            if ($moved) {
                $stmt = $conn->prepare('UPDATE materials SET type=?, course_name=?, course_code=?, semester=?, department=?, level=?, material_file=?, year=? WHERE id=?');
                $stmt->bind_param('sssssssss', $type, $courseName, $CourseCode, $semester, $department, $level, $fileUrl, $year, $id);
                $result = $stmt->execute();
                header('location:../index.php');
            } else {
                echo "Error Occur";
            }
        } else {
            echo " Let the file be in 'pdf', 'jpeg', 'jpg', 'png', 'docx', 'xlsx' format";
        }
    } else {
        header('location:../edit.php');
    }
}
?>