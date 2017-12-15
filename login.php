
<?php
include('conexionBD.php');
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $error = "Username or Password is invalid";
    }
    else
    {
// Define $username and $password
        $username=$_POST['username'];
        $password=$_POST['password'];
        $passw = SHA1($password);
    // SQL query to fetch information of registerd users and finds user match.
        $query = $pdo->prepare( "select usuari, password from usuaris where password ='$passw' AND usuari='$username'");
        $query->execute();
        $row = $query->fetch();
        $user = $row['usuari'];
        $pass = $row['password'];       
        
        if ($user == $username && $pass == $passw) {
            $_SESSION['login_user']=$username; // Initializing Session
            if($user == 'admin'){
              header('location: creacioConsultes.php');
          }else{
             header("location: profile.php");
             }// Redirecting To Other Page
        } else {
            $error = "Username or Password is invalidddd".$user;
        }
    }
}
?>
