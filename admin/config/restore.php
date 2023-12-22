<?php

include 'server.php';
session_start();

if (isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $stmt = $conn->prepare('SELECT * FROM trashed WHERE id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($rows = $result->fetch_assoc()) {
                $user_id = $rows['user_id'];
                $type = $rows['type'];
                $courseName = $rows['course_name'];
                $courseCode = $rows['course_code'];
                $semester = $rows['semester'];
                $department = $rows['department'];
                $searched = $rows['searched'];
                $level = $rows['level'];
                $file = $rows['material_file'];
                $year = $rows['year'];
        }

        $stmt = $conn->prepare('INSERT INTO materials (type, course_name, course_code, semester, department, level, material_file, year, user_id, searched) VALUES ( ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?)');
        $stmt->bind_param('ssssssssss', $type, $courseName, $courseCode, $semester, $department, $level, $file, $year, $user_id, $searched);
        $result = $stmt->execute();

        $stmt = $conn->prepare('DELETE FROM trashed WHERE id = ?');
        $stmt->bind_param('i', $id);
        $result = $stmt->execute();
        if($result){
            header('location:'. $_SERVER['HTTP_REFERER']);
        }
    }
}
}
