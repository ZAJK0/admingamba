<?php
include 'parts/head.php';

session_start();

// Include the configuration file
require 'config.php';
// Check if the form was submitted



// if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $idcard = 0;
    if (isset($_POST['submit'])){
        try {
            $point = (float)$_POST['body'];
            $idcard = (float)$_GET['idcard'];
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        echo(gettype($idcard));

        echo($idcard);
        $meno = $_POST['meno'];
        $priezvisko = $_POST['priezvisko'];

        echo("dwwd");
        $user = ($meno." ".$priezvisko);
        // Prepare and execute a query to check the user's credentials
        echo($pridat);
        $sql = "INSERT INTO body (idcard, user, point) VALUES (:idcard, :user, :point)";
        // $sql = "UPDATE body INSERT INTO `body`( `idcard`, `user`, `point`) VALUES (:idcard,:user,:point')";
        $stmt = $DB->prepare($sql);
        $stmt->bindParam(':user', $user);
        $stmt->bindParam(':idcard', $idcard);
        $stmt->bindParam(':point', $point);
        
        
        if ($stmt->execute()) {
            header("Location: wait.php"); // Redirect to login page after logout
        } else {
            echo "Failed to update user information.";
        }
                
                
                // if ($user) {
                    //     $_SESSION['user'] = $email;
                    //     header("Location: ../index.php");
                    
                    // Check if a user with the given email exists
                    // if ($stmt->rowCount() > 0) {
                        // $user = $stmt->fetch(PDO::FETCH_ASSOC);
                        // echo($hashed_password);
                        // }
                        
                // }
                    // Verify the password
                    // if (password_verify($password, $hashed_password)) {
                        //     // Password is correct, start a new session
                        //     $_SESSION['user_id'] = $user['id'];
                        //     header("Location: index.php"); // Redirect to a welcome page or dashboard
                        //     exit();
                        // }
                        
        }
    


?>

<body>
<style>
        #messages {
            border: 1px solid #ccc;
            padding: 10px;
            height: 200px;
            overflow-y: scroll;
            width: 300px;
        }
    </style>
    <?php include "parts/nav.php"?>


    <section class="waitSec">
        <form method="POST" class="d-flex flex-column section createSec">
        <p class="createHead">Vytvoriť nový účet</p> 
        <input class="inputCreate" name="meno" type="text" placeholder="meno">
        <input class="inputCreate" name="priezvisko" type="text" placeholder="priezvisko">
        <input class="inputCreate" name="body" type="text" placeholder="body">
        <button type="submit" class="createButton" name="submit">Odoslať</button>
        <!-- <div class="d-flex flex-row justify-content-between contentPoint">
                <p class="namePoint"><?=$meno?></p>
                <div class="d-flex flex-row justify-content-between buttonsPoint">
                    <button type="submit" name="submit" class="buttonPointWhite d-flex justify-content-center align-items-center"><img src="img/send.svg" alt=""></button>
                    <a href="script/delete.php" class="buttonPointRed d-flex justify-content-center align-items-center"><img src="img/delete.svg" alt=""></a>
                    <a href="wait.php" class="buttonPointWhite d-flex justify-content-center align-items-center"><img src="img/exit.svg" alt=""></a>

                </div>
            </div>
            <p class="contentPoint fs-4">Balance: <?=$body?></p>
            <div class="d-flex flex-row justify-content-between contentPoint">
                <div class="d-flex flex-column mt-5">
                    <label class="fs-5" for="pridat">Pridať peniaze</label>
                    <input class="inputCreate" name="pridat" type="text">
                </div>
                <div class="d-flex flex-column mt-5">
                    <label class="fs-5" for="vybrat">Vybrať peniaze</label>
                    <input class="inputCreate" name="vybrat" type="text">

                </div>
            </div> -->
    </form>
    </section>

</body>
</html>