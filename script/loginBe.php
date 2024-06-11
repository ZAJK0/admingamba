<?php
// Check if the form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Prepare and execute a query to check the user's credentials
        $sql = "SELECT id, password FROM admin WHERE email = :email";
        $stmt = $DB->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        // Check if a user with the given email exists
        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $hashed_password = $user['password'];
            if ($password = $hashed_password){
                $_SESSION['user_id'] = $user['id'];
                header("Location: index.php"); // Redirect to a welcome page or dashboard
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
                echo "Invalid email or password.";
            }
        } else {
            // No user found with the given email
            echo "Invalid email or password.";
        }
    }
    ?>
