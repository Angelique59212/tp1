<?php
require 'utils/DbConnect.php';
require 'config/Config.php';
require 'utils/Validation.php';
require 'Model/ServiceServ.php';

if (isset($_GET['noserv'])) {
    $serviceId = $_GET['noserv'];
    $serviceServ = new ServiceServ();
    $serviceDetails = $serviceServ->getNoserv($serviceId);

    if ($serviceDetails) {
        if (isset($_POST['noserv']) && isset($_POST['service']) && isset($_POST['ville'])) {
            $serviceId = $_POST['noserv'];
            $newService = $_POST['service'];
            $newVille = $_POST['ville'];

            $instance = DbConnect::getInstance();
            $conn = $instance->getPdo();

            $sql = "UPDATE serv 
                    SET service = :newService, ville = :newVille 
                    WHERE noserv = :serviceId";
            $stmt = $conn->prepare($sql);

            $stmt->bindParam(':newService', $newService);
            $stmt->bindParam(':newVille', $newVille);
            $stmt->bindParam(':serviceId', $serviceId);

            if ($stmt->execute()) {
                header("Location: affichage_services.php");
                exit;
            } else {
                echo "Oups";
            }
        }
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <title>Modifier le Service</title>
        </head>
        <body>
        <h1>Modifier le Service</h1>
        <form action="updateService.php?noserv=<?= $serviceId; ?>" method="post">
            <input type="hidden" name="noserv" value="<?= $serviceId; ?>">
            <label for="service">Service:
                <input type="text" name="service" value="<?= $serviceDetails['service']; ?>">
            </label>
            <label for="ville">Ville:
                <input type="text" name="ville" value="<?= $serviceDetails['ville']; ?>">
            </label>
            <button type="submit">Valider</button>
        </form>
        </body>
        </html>
        <?php
    } else {
        echo "Oups, non trouvé.";
    }
}
?>
