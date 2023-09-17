<?php
require 'utils/DbConnect.php';
require 'config/Config.php';
require 'Model/ServiceEmploye.php';

if (isset($_GET['noemp'])) {
    $noemp = $_GET['noemp'];
    $serviceEmploye = new ServiceEmploye();
    $employeDetails = $serviceEmploye->getNoemp($noemp);

    if ($employeDetails) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newNom = $_POST['nom'];
            $newPrenom = $_POST['prenom'];
            $newEmploi = $_POST['emploi'];
            $newNoserv = $_POST['noserv'];
            $newSup = $_POST['sup'];

            $status = $serviceEmploye->updateEmploye($noemp, $newNom, $newPrenom, $newEmploi, $newNoserv, $newSup);

            if ($status) {
                header("Location: affichage_employes.php");
                exit;
            } else {
                echo "Erreur";
            }
        }
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <title>Modifier l'Employé</title>
        </head>
        <body>
        <h1>Modifier l'Employé</h1>
        <form action="updateEmployes.php?noemp=<?= $noemp; ?>" method="post">
            <input type="hidden" name="noemp" value="<?= $noemp; ?>">
            <label for="nom">Nom:
                <input type="text" name="nom" value="<?= $employeDetails->getNom(); ?>">
            </label>
            <label for="prenom">Prénom:
                <input type="text" name="prenom" value="<?= $employeDetails->getPrenom(); ?>">
            </label>
            <label for="emploi">Emploi:
                <input type="text" name="emploi" value="<?= $employeDetails->getEmploi(); ?>">
            </label>
            <label for="noserv">Numéro de service:
                <input type="text" name="noserv" value="<?= $employeDetails->getNoserv(); ?>">
            </label>
            <label for="sup">Supérieur:
                <input type="text" name="sup" value="<?= $employeDetails->getSup(); ?>">
            </label>
            <button type="submit">Valider</button>
        </form>
        </body>
        </html>
        <?php
    } else {
        echo "Oups";
    }
}
?>
