<?php
require_once 'utils/DbConnect.php';
require_once 'config/Config.php';
require_once 'utils/Validation.php';
class ServiceServ
{
    public function addService($service, $ville):void
    {
        if (Validation::issetPostParams('service', 'ville')) {
            try {
                $instance = DbConnect::getInstance();
                $conn = $instance->getPdo();

                $stmt = $conn->prepare("
                    INSERT INTO serv(service, ville)
                    VALUES (:service, :ville)
                ");

                $status = $stmt->execute([
                    ":service" => Validation::sanitize($_POST['service']),
                    ":ville" => Validation::sanitize($_POST['ville'])
                ]);

                if ($status) {
                    header("Location: affichage_services.php");
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        } else {
            header('Location: index.php');
        }
    }

    public function updateService($noserv, $service, $ville)
    {
        if (Validation::issetPostParams('noserv', 'service', 'ville')) {
            try {
                $noserv = Validation::sanitize($noserv);
                $service = Validation::sanitize($service);
                $ville = Validation::sanitize($ville);

                $instance = DbConnect::getInstance();
                $conn = $instance->getPdo();

                $stmt = $conn->prepare("
                    UPDATE serv
                    SET service = :service, ville = :ville
                    WHERE noserv = :noserv
                ");

                $stmt->bindParam(":noserv", $noserv, PDO::PARAM_INT);
                $stmt->bindParam(":service", $service, PDO::PARAM_STR);
                $stmt->bindParam(":ville", $ville, PDO::PARAM_STR);

                $status = $stmt->execute();
                return $status;
            } catch (PDOException $e) {
                return false;
            }
        } else {
            return false;
        }
    }

    public function deleteService($noserv): bool
    {
        if (Validation::issetPostParams('deleteS')) {
            try {
                $instance = DbConnect::getInstance();
                $conn = $instance->getPdo();

                $stmt = $conn->prepare("
                    DELETE FROM serv WHERE noserv = :noserv
                ");
                $stmt->bindParam(":noserv", $noserv, PDO::PARAM_INT);
                $status = $stmt->execute();
                return $status;
            } catch (PDOException $e) {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getNoserv($noserv) {
        try {
            $instance = DbConnect::getInstance();
            $conn = $instance->getPdo();

            $stmt = $conn->prepare("SELECT * FROM serv WHERE noserv = :noserv");
            $stmt->bindParam(":noserv", $noserv, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }
}
