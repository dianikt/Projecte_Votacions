<?php
    try{
    $hostname = "localhost";
    $dbname = "votacions";
    $username = "root";
    $pw = "password";
    $pdo = new PDO ("mysql:host=$hostname;dbname=$dbname","$username","$pw");
    } catch (PDOException $e) {
        echo "Failed to get DB handle: " . $e->getMessage() . "\n";
        exit;
    }

    session_start();// Starting Session
    $fecha_actual = getdate();
    $_SESSION['year']=$fecha_actual['year'];
    $_SESSION['mon']=$fecha_actual['mon'];
    $_SESSION['day']=$fecha_actual['wday'];
    // Storing Session
    $user_check=$_SESSION['login_user'];
    // SQL Query To Fetch Complete Information Of User
    $query = $pdo->prepare("select usuari from usuaris where usuari='$user_check'");
    $query->execute();

    $row = $query->fetch();
    $login_session =$row['usuari'];
    if(!isset($login_session)){
        $pdo=null; // Closing Connection
        header('Location: index.php'); // Redirecting To Home Page
    }
?>