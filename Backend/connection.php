<?php
    
	global $DB;
    
    // Declaring connection variables
    $drivers = PDO::getAvailableDrivers(); // ignore
    $mysqldriver = 'mysql:host=127.0.0.1;dbname=hng_task_1;';
    $username = 'root';
    $password = '';
    
    try{
        // Establishing connection
        $DB = new PDO($mysqldriver, $username, $password);
    }
    catch (PDOException $e) {
        die('Database connection failed ');
    }

?>