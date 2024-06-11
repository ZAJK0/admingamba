<?php
include 'parts/head.php';
?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.js" type="text/javascript"></script>

<body>

    <?php include "parts/nav.php"?>
    <!-- <h1>MQTT Communication</h1>

    <div id="messages"></div>
    <input type="text" id="inputMessage">
    <button onclick="sendMessage()">Send Message</button> -->
    <section class="waitSec">
        <div class="section">
            <p>PRILOZTE KARTU</p>
        </div>
    </section>
    <script>
        // Create a client instance
        var client = new Paho.MQTT.Client("broker.hivemq.com", Number(8000), "clientId" + Math.random());

        // Set callback handlers
        client.onConnectionLost = onConnectionLost;
        client.onMessageArrived = onMessageArrived;

        // Connect the client
        client.connect({ onSuccess: onConnect });

        // Called when the client connects
        function onConnect() {
            console.log("Connected to MQTT broker.");
            // Subscribe to a topic
            client.subscribe("/zajogamba/switchh");

        }

        // Called when a message arrives
        function onMessageArrived(message) {

            if (message.payloadString == "NONAME"){
                window.location.href = "add.php";
            }
            else{
                window.location.href = "points.php";
            }
            
        }

        // Called when the connection is lost
        function onConnectionLost(responseObject) {
            if (responseObject.errorCode !== 0) {
                console.log("Connection lost: " + responseObject.errorMessage);
            }
        }

        // Function to send message
        
    </script>

</body>
</html>