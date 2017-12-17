<?php
    include('conexionBD.php');

    session_start();// Starting Session
    $fecha_actual = getdate();
    $_SESSION['year']=$fecha_actual['year'];
    $_SESSION['mon']=$fecha_actual['mon'];
    $_SESSION['day']=$fecha_actual['mday'];
    $hora=$fecha_actual['hours']+1;
    if($fecha_actual['minutes']<10){
        $minuto="0".$fecha_actual['minutes'];
    }
    else{
        $minuto=$fecha_actual['minutes'];
    }
    if(($fecha_actual['hours']+1)==24){
        $_SESSION['hour']="00:".$minuto;
    }
    else{
        if(($fecha_actual['hours']+1)<10){
            $_SESSION['hour']="0".$hora.":".$minuto;
        }
        else{
            $_SESSION['hour']=$hora.":".$minuto;
        }

    }
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