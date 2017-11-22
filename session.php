<?php
    try{
    $hostname = "localhost";
    $dbname = "votacions";
    $username = "root";
    $pw = "admin";
    $pdo = new PDO ("mysql:host=$hostname;dbname=$dbname","$username","$pw");
    } catch (PDOException $e) {
        echo "Failed to get DB handle: " . $e->getMessage() . "\n";
        exit;
    }

    session_start();// Starting Session
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