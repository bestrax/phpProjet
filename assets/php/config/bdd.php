<?php

    $bdd = new PDO('mysql:host=127.0.0.1;port=3306;dbname=bread_express', 'bread', 'bread');
    $bdd->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

?>