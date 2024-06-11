<?php
include 'parts/head.php';
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

    <div id="messages"></div>
    <input type="text" id="inputMessage">
    <button onclick="sendMessage()">Send Message</button>

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
            client.subscribe("/zajogamba/switch");

        }

        // Called when a message arrives
        function onMessageArrived(message) {
            var messagesDiv = document.getElementById("messages");
            var newMessage = document.createElement("div");
            newMessage.textContent = "Received: " + message.payloadString;
            messagesDiv.appendChild(newMessage);
            messagesDiv.scrollTop = messagesDiv.scrollHeight;  // Scroll to the bottom
        }

        // Called when the connection is lost
        function onConnectionLost(responseObject) {
            if (responseObject.errorCode !== 0) {
                console.log("Connection lost: " + responseObject.errorMessage);
            }
        }

        // Function to send message
        function sendMessage() {
            var message = "RESET";
            var topic = "/zajogamba/switch";
            var mqttMessage = new Paho.MQTT.Message(message);
            mqttMessage.destinationName = topic;
            client.send(mqttMessage);
            console.log("Message sent: " + message);

            var messagesDiv = document.getElementById("messages");
            var newMessage = document.createElement("div");
            newMessage.textContent = "Sent: " + message;
            messagesDiv.appendChild(newMessage);
            messagesDiv.scrollTop = messagesDiv.scrollHeight;  // Scroll to the bottom
        }
    </script>

</body>
</html>