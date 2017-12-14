<?php
    include('conexionBD.php');

    session_start();// Starting Session
    $fecha_actual = getdate();
    $_SESSION['year']=$fecha_actual['year'];
    $_SESSION['mon']=$fecha_actual['mon'];
    $_SESSION['day']=$fecha_actual['wday'];
    // Storing Session
    $user_check=$_SESSION['login_user'];
    // SQL Query To Fetch Complete Information Of User
    $query = $pdo->prepare("select id_usuari, usuari, email from usuaris where usuari='$user_check'");
    $query->execute();
    $row = $query->fetch();
    $login_session =$row['usuari'];
    $id_session =$row['id_usuari'];
    $email_session =$row['email'];

    if(!isset($login_session)){
        $pdo=null; // Closing Connection      
        header('Location: index.php'); // Redirecting To Home Page
    }
?>