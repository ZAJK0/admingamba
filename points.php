<?php
include 'parts/head.php';

session_start();

// Include the configuration file
require 'config.php';
// Check if the form was submitted



// if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idcard = isset($_GET['idcard']) ? $_GET['idcard'] : null;

    $point=0;
    $sql = "SELECT point, user FROM `body` WHERE idcard = :idcard";
    $stmt = $DB->prepare($sql);
    $stmt->bindParam(':idcard', $idcard);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $body = $user['point'];
    $meno = $user['user'];
    if (isset($_POST['submit'])){
        try {
            $pridat = (float)$_POST['pridat'];
            $vybrat = (float)$_POST['vybrat'];
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        if ($pridat != 0){
            $point = $point+10*$pridat;
        }
        
        if ($vybrat != 0 && $vybrat*10 <= $body){
            $point = $point-10*$vybrat;
        }
        $body = $body+$point;


        // Prepare and execute a query to check the user's credentials
        $sql = "SELECT * FROM `body` WHERE idcard = :idcard";
        $sql = "UPDATE body SET point = :point WHERE idcard = :idcard";
        $stmt = $DB->prepare($sql);
        $stmt->bindParam(':idcard', $idcard);
        $stmt->bindParam(':point', $body);
        if ($stmt->execute()) {
        } else {
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.js" type="text/javascript"></script>

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
    <!-- <h1>MQTT Communication</h1>

    <div id="messages"></div>
    <input type="text" id="inputMessage">
    <button onclick="sendMessage()">Send Message</button> -->

    <!-- <div id="messages"></div>
    <input type="text" id="inputMessage">
    <button onclick="sendMessage()">Send Message</button> -->

    <section class="waitSec">
        <form method="POST" class="d-flex flex-column section sectionPoints">
            <div class="d-flex flex-row justify-content-between contentPoint">
                <p class="namePoint"><?=$meno?></p>
                <div class="d-flex flex-row justify-content-between buttonsPoint">
                    <button type="submit" name="submit" class="buttonPointWhite d-flex justify-content-center align-items-center"><img src="img/send.svg" alt=""></button>
                    <a href="script/delete.php?idcard=<?=$idcard?>" class="buttonPointRed d-flex justify-content-center align-items-center"><img src="img/delete.svg" alt=""></a>
                    <a href="wait.php" class="buttonPointWhite d-flex justify-content-center align-items-center"><img src="img/exit.svg" alt=""></a>

                </div>
            </div>
            <p class="contentPoint fs-4">Balance: <?=$body?></p>
            <div class="d-flex flex-row justify-content-between contentPoint">
                <div class="d-flex flex-column mt-5">
                    <label class="fs-5" for="pridat">Pridať peniaze</label>
                    <input class="inputPoint" name="pridat" type="text">
                </div>
                <div class="d-flex flex-column mt-5">
                    <label class="fs-5" for="vybrat">Vybrať peniaze</label>
                    <input class="inputPoint" name="vybrat" type="text">

                </div>
            </div>
    </form>
    </section>
    <script>
        // // Create a client instance
        // var client = new Paho.MQTT.Client("broker.hivemq.com", Number(8000), "clientId" + Math.random());

        // // Set callback handlers
        // client.onConnectionLost = onConnectionLost;
        // client.onMessageArrived = onMessageArrived;

        // // Connect the client
        // client.connect({ onSuccess: onConnect });

        // // Called when the client connects
        // function onConnect() {
        //     console.log("Connected to MQTT broker.");
        //     // Subscribe to a topic
        //     client.subscribe("/zajogamba/switch");

        // }

        // // Called when a message arrives
        // function onMessageArrived(message) {
        //     var messagesDiv = document.getElementById("messages");
        //     var newMessage = document.createElement("div");
        //     newMessage.textContent = "Received: " + message.payloadString;
        //     messagesDiv.appendChild(newMessage);
        //     messagesDiv.scrollTop = messagesDiv.scrollHeight;  // Scroll to the bottom
        // }

        // // Called when the connection is lost
        // function onConnectionLost(responseObject) {
        //     if (responseObject.errorCode !== 0) {
        //         console.log("Connection lost: " + responseObject.errorMessage);
        //     }
        // }

        // Function to send message
        // function sendMessage() {
        //     var message = "RESET";
        //     var topic = "/zajogamba/switch";
        //     var mqttMessage = new Paho.MQTT.Message(message);
        //     mqttMessage.destinationName = topic;
        //     client.send(mqttMessage);
        //     console.log("Message sent: " + message);

        //     var messagesDiv = document.getElementById("messages");
        //     var newMessage = document.createElement("div");
        //     newMessage.textContent = "Sent: " + message;
        //     messagesDiv.appendChild(newMessage);
        //     messagesDiv.scrollTop = messagesDiv.scrollHeight;  // Scroll to the bottom
        
    </script>

</body>
</html>