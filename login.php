<?php
session_start();

// Include the configuration file
require 'config.php';
// Check if the form was submitted



    // if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_POST['submit'])){
            $email = $_POST['email'];
            $password = $_POST['password'];
            // Prepare and execute a query to check the user's credentials
            $sql = "SELECT * FROM `admin` WHERE email = :email AND heslo = :heslo";
            echo($password);
            $stmt = $DB->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':heslo', $password);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $hashed_password = $user['heslo'];
                
            // if ($user) {
            //     $_SESSION['user'] = $email;
            //     header("Location: ../index.php");
            
            // Check if a user with the given email exists
            // if ($stmt->rowCount() > 0) {
            // $user = $stmt->fetch(PDO::FETCH_ASSOC);
            // echo($hashed_password);
            // }
            if ($password = $hashed_password){
                $_SESSION['user_id'] = $user['id'];
                header("Location: pokladne.php"); // Redirect to a welcome page or dashboard
                exit();    
            }
            // Verify the password
            // if (password_verify($password, $hashed_password)) {
            //     // Password is correct, start a new session
            //     $_SESSION['user_id'] = $user['id'];
            //     header("Location: index.php"); // Redirect to a welcome page or dashboard
            //     exit();
            // }
            else {
                // Invalid password
                $error = "Invalid email or password.";
            }
        } else {
            // No user found with the given email
            $error = "Invalid email or password.";
        }
    ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="loginBody">
    <section class="loginSec">
        <!-- <div class="d-flex justify-content-center align-items-center"> -->
        <img src="img/logo.png" class="loginLogo" alt="">
        <!-- </div> -->
        <form class="loginForm" method="post">
            <!-- <p><?=$error?></p> -->
            <div class="mb-3 loginInput">
                <label for="email" class="form-label">Email</label>
                <input name="email" type="email" class="form-control" id="email" required>
            </div>
            <div class="mb-3 loginInput">
                <label for="password" class="form-label">Heslo</label>
                <input name="password" type="password" class="form-control" id="password" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Prihlásiť sa</button>
        </form>
    </section>
</body>
</html>
