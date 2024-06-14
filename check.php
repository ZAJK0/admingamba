<?php
include 'config.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['idcard'])) {
        $idcard = $_POST['idcard'];

        try {
            // Prepare and execute a query to check if the idcard exists
            $sql = "SELECT user FROM body WHERE idcard = :idcard";
            $stmt = $DB->prepare($sql);
            $stmt->bindParam(':idcard', $idcard);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo 'exists'; // idcard exists
            } else {
                echo 'not_exists'; // idcard does not exist
            }
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    } else {
        echo "Invalid request.";
    }
} else {
    echo "Invalid request method.";
}
?>
