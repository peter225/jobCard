<?php

class Database extends PDO
{
	private $servername = "peter-tech.mysql.database.azure.com";
	private $username = "peter225";
	private $password = "Adeyemo_azure1";
	private $dbname = 'peter-tech';
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