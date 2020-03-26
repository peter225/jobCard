<?php

class Database extends PDO
{
	private $servername = "localhost";
	private $username = "root";
	private $password = "";
	private $dbname = 'jobCard';
	private $conn;
	private $dsn;

	public function __construct()
	{
		try
		{
			$this->dsn = "mysql:host=" . $this->servername . ";dbname=" . $this->dbname;

			parent::__construct( $this->dsn, $this->username, $this->password );

			$this->setAttribute( PDO::ATTR_EMULATE_PREPARES, true );

			$this->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );			
			
			return $this;
		}
		catch( PDOException $e )
		{
			throw new PDOException( $e->getMessage() );
		}
	}
	
}