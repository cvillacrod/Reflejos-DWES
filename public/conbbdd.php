<?php

    use Google\Cloud\Firestore\FirestoreClient;

    if (!defined('DIR')) {
        define('DIR', __DIR__ . '/');
    }
    
    //función para la conexión a la base de datos de Firebase Cloud
    function conectarBD()
    {
        $credentialsPath = DIR . '../bbdd_key/key.json';
        $projectId='dwes-reflejos';

        require_once '../vendor/autoload.php';

        try {

            $db = new FirestoreClient([
                "keyFilePath" => $credentialsPath,
                "projectId" => $projectId,
                "region" => "eur3"
            ]);

            //printf('Created Cloud Firestore client with project ID: %s' . PHP_EOL, $projectId);
            //var_dump($db);

            return $db;
        } catch (Exception $e) {
            echo "Excepción: " . $e->getMessage();
            return null;
        }
    }

?>

