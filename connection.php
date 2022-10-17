<?php

    try {
        $conn = new PDO('mysql:host=lourencocarvalho.pt;dbname=lourenco_dicts', 'lourenco_dictUser', 'cfIC0Z8gQ4bL');
    } catch (PDOException $e){
        $e->getMessage();
    }

?>