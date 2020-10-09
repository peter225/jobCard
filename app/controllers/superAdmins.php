<?php
/**
 * 
 */
class superAdmins extends Controller
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function default()
	{
		try
		{
			if( ! isset( $_SESSION['superAdminID'] ) || ! isset( $_SESSION['sessionID'] ) )
			{
				$this->view('login/superAdmin');
				return;
			}

			$superAdmin = $this->model('superAdmin');

			$superAdmin->setUserName( $_SESSION['superAdminID'] );

			$superAdmin->setDBInstance( $this->getDBInstance() );

			$superAdmin->loadProfile();

			if( $superAdmin->getSessionID() != $_SESSION['sessionID'] )
			{
				$this->view('login/superAdmin');
				return;
			}

			$this->view( 'superAdmin/dashboard', ['superAdmin'=>$superAdmin] );
		}
		catch( PDOException $e )
		{
			echo $e->getMessage();
		}
		catch( CustomException $e )
		{
			echo $e->getMessage();
		}
		catch( Exception $e )
		{
			echo $e->getMessage();
		}
		catch( Error $e )
		{
			echo $e->getMessage();
		}
	}
	public function jobType()
	{
		try
		{
			if( ! isset( $_SESSION['superAdminID'] ) || ! isset( $_SESSION['sessionID'] ) )
			{
				$this->view('login/superAdmin');

				return;
			}

			$superAdmin = $this->model('superAdmin');

			$superAdmin->setUserName( $_SESSION['superAdminID'] );

			$superAdmin->setDBInstance( $this->getDBInstance() );

			$superAdmin->loadProfile();

			if( $superAdmin->getSessionID() != $_SESSION['sessionID'] )
			{
				$this->view('login/superAdmin');
				
				return;
			}

			$this->view('superAdmin/jobType', ['superAdmin'=>$superAdmin]);
		}
		catch( PDOException $e )
		{
			$e->getMessage();
		}
		catch( CustomException $e )
		{
			$e->getMessage();
		}
		catch( Exception $e )
		{
			$e->getMessage();
		}
		catch( Error $e )
		{
			$e->getMessage();
		}
	}

	public function registration()
	{
		try
		{
			if( ! isset( $_SESSION['superAdminID'] ) || ! isset( $_SESSION['sessionID'] ) )
			{
				$this->view('login/superAdmin');

				return;
			}

			$superAdmin = $this->model('superAdmin');

			$superAdmin->setUserName( $_SESSION['superAdminID'] );

			$superAdmin->setDBInstance( $this->getDBInstance() );

			$superAdmin->loadProfile();

			if( $superAdmin->getSessionID() != $_SESSION['sessionID'] )
			{
				$this->view('login/superAdmin');
				
				return;
			}

			$this->view('superAdmin/registration', ['superAdmin'=>$superAdmin]);
		}
		catch( PDOException $e )
		{
			$e->getMessage();
		}
		catch( CustomException $e )
		{
			$e->getMessage();
		}
		catch( Exception $e )
		{
			$e->getMessage();
		}
		catch( Error $e )
		{
			$e->getMessage();
		}
	}

	public function adminsList()
	{
		try
		{
			if( ! isset( $_SESSION['superAdminID'] ) || ! isset( $_SESSION['sessionID'] ) )
			{
				$this->view('login/superAdmin');

				return;
			}

			$superAdmin = $this->model('superAdmin');

			$superAdmin->setUserName( $_SESSION['superAdminID'] );

			$superAdmin->setDBInstance( $this->getDBInstance() );

			$superAdmin->loadProfile();

			if( $superAdmin->getSessionID() != $_SESSION['sessionID'] )
			{
				$this->view('login/superAdmin');
				
				return;
			}

			$this->view('superAdmin/adminsList', ['superAdmin'=>$superAdmin]);
		}
		catch( PDOException $e )
		{
			$e->getMessage();
		}
		catch( CustomException $e )
		{
			$e->getMessage();
		}
		catch( Exception $e )
		{
			$e->getMessage();
		}
		catch( Error $e )
		{
			$e->getMessage();
		}
	}

	public function fetchAdmins()
	{
		try
		{
			if( ! isset( $_SESSION['superAdminID'] ) || ! isset( $_SESSION['sessionID'] ) )
			{
				$this->view('login/superAdmin');
				return;
			}

			$superAdmin = $this->model('superAdmin');

			$superAdmin->setUserName( $_SESSION['superAdminID'] );

			$superAdmin->setDBInstance( $this->getDBInstance() );

			$superAdmin->loadProfile();

			if( $superAdmin->getSessionID() != $_SESSION['sessionID'] )
				throw new CustomException("time out!");

			$admins = $superAdmin->fetchAdmins();

			if( !empty( $admins ))
			{

				$success['message'] = $admins;

				$response['success'] = $success;

				$response['error'] = false;

				echo( json_encode( $response) );

			}
			else
			{
				$error['message'] = "Error";

				$response['error'] = $error;
				
				$response['success'] = false;

				echo( json_encode( $response) );
			}
		}
		catch( PDOException $e )
		{
			$error['message'] = $e->getMessage();

			$response['error'] = $error;
				
			$response['success'] = false;

			echo( json_encode( $response) );
		}
		catch( CustomException $e )
		{
			$error['message'] = $e->getMessage();

			$response['error'] = $error;
				
			$response['success'] = false;

			echo( json_encode( $response) );
		}
		catch( Exception $e )
		{
			$error['message'] = 'Exception';

			$response['error'] = $error;
				
			$response['success'] = false;

			echo( json_encode( $response) );
		}
		catch( Error $e )
		{
			$error['message'] = 'Error';

			$response['error'] = $error;
				
			$response['success'] = false;

			echo( json_encode( $response) );
		}
	}
}