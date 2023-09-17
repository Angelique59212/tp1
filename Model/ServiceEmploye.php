<?php
require '../utils/DbConnect.php';
require '../utils/Validation.php';

class ServiceEmploye
{
    public function addEmploye($nom, $prenom,$emploi, $noserv, $sup)
    {
        if (Validation::issetPostParams('nom', 'prenom','emploi','noserv', 'sup')) {
            try {
                $instance = DbConnect::getInstance();
                $conn = $instance->getPdo();

                $stmt = $conn->prepare("
                    INSERT INTO emp(nom, prenom,emploi, noserv, sup)
                    VALUES (:nom, :prenom,:emploi,:noserv, :sup)
                ");

                $status = $stmt->execute([
                    ":nom" => Validation::sanitize($nom),
                    ":prenom" => Validation::sanitize($prenom),
                    ":emploi" => Validation::sanitize($emploi),
                    ":noserv" => Validation::sanitize($noserv),
                    ":sup" => Validation::sanitize($sup)
                ]);
                if ($status) {
                    header("Location:affichage_employes.php");
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        } else {
            header('Location:index.php');
            exit();
        }
    }

    public function updateEmploye($noemp, $nom, $prenom, $service, $sup)
    {
        if (Validation::issetPostParams('noemp', 'nom', 'prenom', 'service', 'sup')) {
            try {
                $noemp = Validation::sanitize($noemp);
                $nom = Validation::sanitize($nom);
                $prenom = Validation::sanitize($prenom);
                $service = Validation::sanitize($service);
                $sup = Validation::sanitize($sup);

                $instance = DbConnect::getInstance();
                $conn = $instance->getPdo();

                $stmt = $conn->prepare("
                    UPDATE emp
                    SET nom = :nom, prenom = :prenom, noserv = :service, sup = :sup
                    WHERE noemp = :noemp
                ");

                $stmt->bindParam(":noemp", $noemp, PDO::PARAM_INT);
                $stmt->bindParam(":nom", $nom, PDO::PARAM_STR);
                $stmt->bindParam(":prenom", $prenom, PDO::PARAM_STR);
                $stmt->bindParam(":service", $service, PDO::PARAM_INT);
                $stmt->bindParam(":sup", $sup, PDO::PARAM_INT);

                $status = $stmt->execute();
                return $status;
            } catch (PDOException $e) {
                return false;
            }
        } else {
            return false;
        }
    }

    public function deleteEmploye($noemp)
    {
        if (Validation::issetPostParams('deleteE')) {
            try {
                $instance = DbConnect::getInstance();
                $conn = $instance->getPdo();

                $stmt = $conn->prepare("
                    DELETE FROM emp WHERE noemp = :noemp
                ");
                $stmt->bindParam(":noemp", $noemp, PDO::PARAM_INT);
                $status = $stmt->execute();
                return $status;
            } catch (PDOException $e) {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getNoemp($noemp) {
        try {
            $instance = DbConnect::getInstance();
            $conn = $instance->getPdo();

            $stmt = $conn->prepare("SELECT * FROM serv WHERE noemp = :noemp");
            $stmt->bindParam(":noemp", $noemp, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }
}