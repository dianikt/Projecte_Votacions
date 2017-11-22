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
?>