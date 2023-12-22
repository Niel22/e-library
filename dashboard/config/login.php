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

    $stmt = $conn->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows === 1){
        while($rows = $result->fetch_assoc()){
            if(password_verify($password, $rows['password'])){
            $user_id = $rows['user_id'];
            session_start();
            $_SESSION['user_id'] = $rows['user_id'];
                header("location:.././");
            }else{
                header('location:../pages-login?perror=Incorrect password');
            }
        }
    }else{
        header('location:../pages-login?emerror=This email does not exist');
    }
}
?>