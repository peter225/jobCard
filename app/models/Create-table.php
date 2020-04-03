<?php

require('Database.php');

require('Person.php');

try 
{

	$dbInstance = new Database();

	$sql = "CREATE TABLE if not exists admin(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    email VARCHAR(50),
    phone VARCHAR(15),
    gender VARCHAR(7),
    dob TIMESTAMP,
    username VARCHAR(30) NOT NULL,
    password VARCHAR (10) NULL,
    reg_date TIMESTAMP,
	session_id INT(20))";

	$stmt = $dbInstance->prepare( $sql );

	

	if( $stmt->rowCount() > 0 )
		echo "Table Admin has been created successfully";
	else
		echo "Table Admin has not been created successfully";

	
} 

catch ( PDOException $e)
{
	echo "Error <br>". $e->getMessage();	
}
catch ( CustomException $e)
{
	echo "Error <br>". $e->getMessage();	
}
catch ( Exception $e)
{
	echo "Error <br>". $e->getMessage();	
}

//$conn = null;

