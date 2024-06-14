<?php include 'parts/head.php'; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.js" type="text/javascript"></script>

<body>
    <?php include "parts/nav.php"; ?>

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
        client.subscribe("/zajogamba/user");
    }

    // Called when a message arrives
    function onMessageArrived(message) {
        var idcard = message.payloadString;
        console.log("ID Card: " + idcard);
        sendIdCardToServer(idcard);
    }

    // Called when the connection is lost
    function onConnectionLost(responseObject) {
        if (responseObject.errorCode !== 0) {
            console.log("Connection lost: " + responseObject.errorMessage);
        }
    }

    // Function to send ID card to server
    function sendIdCardToServer(idcard) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "check.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Handle the response from the server
                var response = xhr.responseText;
                if (response === 'exists') {
                    window.location.href = "points.php?idcard=" + encodeURIComponent(idcard);
                } else if (response === 'not_exists') {
                    window.location.href = "add.php?idcard=" + encodeURIComponent(idcard);
                }
            }
        };
        xhr.send("idcard=" + encodeURIComponent(idcard));
    }
</script>


    <section class="waitSec">
        <div class="sectionPoints section">
            <p>PRILOZTE KARTU</p>
        </div>
    </section>
</body>
</html>
