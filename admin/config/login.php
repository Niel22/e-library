<?php

include 'server.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    function val($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $email = val($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare('SELECT * FROM admin WHERE email = ?');
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows === 1){
        while($rows = $result->fetch_assoc()){
            if(password_verify($password, $rows['password'])){
            $user_id = $rows['admin_id'];
            session_start();
            $_SESSION['admin_id'] = $rows['admin_id'];
                header("location:../index.php");
            }else{
                header('location:../login.php?perror=Incorrect password');
            }
        }
    }else{
        header('location:../login.php?emerror=This email does not exist');
    }
}
?>