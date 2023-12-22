<?php

include 'server.php';
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    if (isset($_POST['submit'])) {
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
        $file = $_FILES['file'];
        $year = $_POST['year'];

        $fileName = $file['name'];
        $fileTempName = $file['tmp_name'];

        $fileDiv = explode('.', $fileName);
        $fileExt = strtolower(end($fileDiv));

        $extList = array('pdf', 'jpeg', 'jpg', 'png', 'docx', 'xlsx');
        if (in_array($fileExt, $extList)) {

            $fileUrl = 'assets/materials/' . $courseName . '.'. $fileExt;
            $filePath = '../' . $fileUrl;
            $moved = move_uploaded_file($fileTempName, $filePath);
            if ($moved) {
                $stmt = $conn->prepare('INSERT INTO materials (type, course_name, course_code, semester, department, level, material_file, year, user_id) VALUES (?, ?,  ?, ?, ?, ?, ?, ?, ?)');
                $stmt->bind_param('sssssssss', $type, $courseName, $CourseCode, $semester, $department, $level, $fileUrl, $year, $user_id);
                $result = $stmt->execute();

                if ($result) {
                    $sql = "UPDATE users SET contributions = contributions + 1 WHERE user_id = $user_id";
                    $result = $conn->query($sql);
                    header('location:../upload?success=Uploaded Successfully');
                }
            } else {
                echo "Error Occur";
            }
        } else {
            echo " Let the file be in 'pdf', 'jpeg', 'jpg', 'png', 'docx', 'xlsx' format";
        }
    } else {
        header('location:../upload');
    }
}
