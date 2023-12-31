<?php
require 'index.php';
require 'utils/DbConnect.php';
require 'config/Config.php';

try {
    $instance = DbConnect::getInstance();
    $conn = $instance->getPdo();

    $query = "SELECT * FROM serv";
    $services = $conn->query($query); ?>

    <h1>Liste des Services</h1>
    <div class='card-container'>
        <?php foreach ($services as $service) { ?>
            <div class='card'>
                <img src="img/service.jpg" alt="service">
                <div class="container">
                    <h2><?= $service['service']; ?></h2>
                    <p>Ville : <?= $service['ville']; ?></p>
                    <a href="updateService.php?noserv=<?= $service['noserv']; ?>">Modifier</a>
                    <form action="deleteService.php" method="post">
                        <input type="hidden" name="noserv" value="<?= $service['noserv']; ?>">
                        <a href="deleteService.php?noserv=<?= $service['noserv']; ?>">Supprimer</a>
                    </form>
                </div>
            </div>
        <?php } ?>
    </div>
    <?php
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>
