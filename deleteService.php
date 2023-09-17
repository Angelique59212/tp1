<?php
require_once 'utils/DbConnect.php';
require_once 'config/Config.php';

if (isset($_GET['noserv'])) {
    $noserv = $_GET['noserv'];

    $instance = DbConnect::getInstance();
    $conn = $instance->getPdo();

    try {
        $stmt = $conn->prepare("DELETE FROM serv WHERE noserv = :noserv");
        $stmt->bindParam(":noserv", $noserv, PDO::PARAM_INT);

        if ($stmt->execute()) {
            header("Location: affichage_services.php");
            exit;
        } else {
            echo "Erreur";
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} else {
    echo "Oups.";
}
?>
