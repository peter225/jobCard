<?php

class Database extends PDO
{
	
	private $servername = getenv('DB_HOST');
	private $username = getenv('DB_USERNAME');
	private $password = getenv('DB_PASSWORD');
	private $dbname = getenv('DB_DATABASE');
	private $sslcert    = "ssl/DigiCertGlobalRootCA.crt.pem";
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