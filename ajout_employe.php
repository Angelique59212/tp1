<?php
require_once "Model/ServiceEmploye.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $emploi = $_POST['emploi'];
    $noserv = $_POST['noserv'];
    $sup = $_POST['sup'];

    if (!empty($nom) && !empty($prenom) && !empty($emploi) && !empty($noserv)) {
        $serviceEmploye = new ServiceEmploye();
        $serviceEmploye->addEmploye($nom, $prenom, $emploi, $noserv, $sup);
        header("Location: affichage_employes.php");
        exit;
    } else {
        echo "Il manque des champs.";
    }
}



