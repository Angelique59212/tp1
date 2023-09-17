<?php
require 'index.php';
require 'utils/DbConnect.php';
require 'config/Config.php';

try {
    $instance = DbConnect::getInstance();
    $conn = $instance->getPdo();

    $query = "SELECT * FROM emp";
    $employes = $conn->query($query); ?>

    <h1>Liste des Employés</h1>
    <div class='card-container'>
        <?php foreach ($employes as $employe) { ?>
            <div class='card'>
                <img src="img/employe.jpg" alt="employé">
                <div class="container">
                    <h2><?= $employe['nom'] . ' ' . $employe['prenom']; ?></h2>
                    <p>Emploi : <?= $employe['emploi']; ?></p>
                    <p>Supérieur : <?= $employe['sup']; ?></p>
                    <p>Noserv : <?= $employe['noserv']; ?></p>
                    <a href="updateEmployes.php?noemp=<?= $employe['noemp']; ?>">Modifier</a>
                    <form action="deleteEmploye.php" method="post">
                        <input type="hidden" name="noemp" value="<?= $employe['noemp']; ?>">
                        <a href="deleteEmploye.php?noemp=<?= $employe['noemp']; ?>">Supprimer</a>
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
