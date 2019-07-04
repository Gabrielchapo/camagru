<?php
    require_once('database.php');
    $connection = new PDO($DB_DSN, $DB_UNAME, $DB_PASSWORD);
    if (!$connection)
        die("An error has occured\n");
	$all_query = file_get_contents("./camagru.sql");
    try {
        $connection->exec($all_query);
        echo "Create table successfully\n";
    }
    catch (PDOException $e)
    {
        echo "An error occured\n";
        echo $e->getMessage();
        die();
    }