<?php
include('session.php');
// Storing Session
$user_check=$_SESSION['login_user'];
// SQL Query To Fetch Complete Information Of User
$query = $pdo->prepare("select usuari from usuaris where usuari='$user_check'");
$query->execute();
$row = $query->fetch();
$login_session =null;
if(!isset($login_session)){
    header('Location: index.php'); // Redirecting To Home Page
}
session_destroy();
$pdo=null;

?>