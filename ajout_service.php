<?php
require_once 'utils/DbConnect.php';
require_once 'config/Config.php';
require_once "Model/ServiceServ.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $service = $_POST['service'];
    $ville = $_POST['ville'];

    if (!empty($service) && !empty($ville)) {
        $serviceServ = new ServiceServ();
        $serviceServ->addService($service, $ville);
        header("Location: affichage_services.php");
        exit;
    } else {
        echo "Des champs sont vides.";
    }
}
?>
