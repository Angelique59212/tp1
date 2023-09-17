<?php
require 'utils/DbConnect.php';
require 'config/Config.php';
require 'Model/ServiceEmploye.php';

if (isset($_GET['noemp'])) {
    $noemp = $_GET['noemp'];
    $serviceEmploye = new ServiceEmploye();
    $status = $serviceEmploye->deleteEmploye($noemp);

    if ($status) {
        header("Location: affichage_employes.php");
        exit;
    } else {
        echo "Erreur";
    }
} else {
    echo "Paramètre 'noemp' manquant.";
}
?>
