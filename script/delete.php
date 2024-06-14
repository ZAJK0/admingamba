<?php
include '../config.php';
echo("sdfghj");
if (isset($_GET['idcard'])) {
    $idcard = $_GET['idcard'];

    // Prepare and execute the delete query
    $sql = "DELETE FROM body WHERE idcard = :idcard";
    $stmt = $DB->prepare($sql);
    $stmt->bindParam(':idcard', $idcard);

    if ($stmt->execute()) {
        header("Location: ../wait.php"); // Redirect to a different page after deletion
        exit();
    } else {
        echo "Failed to delete user information.";
    }
}
?>
