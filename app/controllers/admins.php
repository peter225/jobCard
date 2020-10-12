<?php

class Admins extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function default()
	{
		try
		{
			if( ! isset( $_SESSION['adminID'] ) || ! isset( $_SESSION['sessionID'] ) )
			{
				$this->view('login/admin');
				return;
			}

			$admin = $this->model('Admin');

			$admin->setUserName( $_SESSION['adminID'] );

			$admin->setDBInstance( $this->getDBInstance() );

			$admin->loadProfile();

			if( $admin->getSessionID() != $_SESSION['sessionID'] )
			{
				$this->view('login/admin');
				return;
			}

			$this->view( 'admins/dashboard', ['admin'=>$admin] );
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

	public function payments()
	{
		try
		{
			if( ! isset( $_SESSION['adminID'] ) || ! isset( $_SESSION['sessionID'] ) )
			{
				$this->view('login/admin');
				return;
			}

			$admin = $this->model('Admin');

			$admin->setUserName( $_SESSION['adminID'] );

			$admin->setDBInstance( $this->getDBInstance() );

			$admin->loadProfile();

			if( $admin->getSessionID() != $_SESSION['sessionID'] )
			{
				$this->view('login/admin');
				return;
			}

			$this->view('admins/payments', ['admin'=>$admin]);
		}
		catch( PDOException $e )
		{

		}
		catch( CustomException $e )
		{

		}
		catch( Exception $e )
		{

		}
		catch( Error $e )
		{

		}
	}

	public function task()
	{
		try
		{
			if( ! isset( $_SESSION['adminID'] ) || ! isset( $_SESSION['sessionID'] ) )
			{
				$this->view('login/admin');

				return;
			}

			$admin = $this->model('Admin');

			$admin->setUserName( $_SESSION['adminID'] );

			$admin->setDBInstance( $this->getDBInstance() );

			$admin->loadProfile();

			if( $admin->getSessionID() != $_SESSION['sessionID'] )
			{
				$this->view('login/admin');
				
				return;
			}

			$this->view('admins/task', ['admin'=>$admin]);
		}
		catch( PDOException $e )
		{

		}
		catch( CustomException $e )
		{

		}
		catch( Exception $e )
		{

		}
		catch( Error $e )
		{

		}
	}

	public function userList()
	{
		try
		{
			if( ! isset( $_SESSION['adminID'] ) || ! isset( $_SESSION['sessionID'] ) )
			{
				$this->view('login/admin');
				return;
			}

			$admin = $this->model('Admin');

			$admin->setUserName( $_SESSION['adminID'] );

			$admin->setDBInstance( $this->getDBInstance() );

			$admin->loadProfile();

			if( $admin->getSessionID() != $_SESSION['sessionID'] )
			{
				$this->view('login/admin');
				return;
			}

			$this->view('admins/usersList', ['admin'=>$admin]);
		}
		catch( PDOException $e )
		{

		}
		catch( CustomException $e )
		{

		}
		catch( Exception $e )
		{

		}
		catch( Error $e )
		{

		}
	}

	public function fetchCustomers()
	{
		try
		{
			if( ! isset( $_SESSION['adminID'] ) || ! isset( $_SESSION['sessionID'] ) )
			{
				$this->view('login/admin');
				return;
			}

			$admin = $this->model('Admin');

			$admin->setUserName( $_SESSION['adminID'] );

			$admin->setDBInstance( $this->getDBInstance() );

			$admin->loadProfile();

			if( $admin->getSessionID() != $_SESSION['sessionID'] )
				throw new CustomException("time out!");

			$customers = $admin->fetchCustomers();

			if( !empty( $customers ))
			{

				$success['message'] = $customers;

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


	public function registerCustomers()
	{
		try
		{
			if( ! isset( $_SESSION['adminID'] ) || ! isset( $_SESSION['sessionID'] ) )
			{
				$this->view('login/admin');
				return;
			}

			$admin = $this->model('Admin');

			$admin->setUserName( $_SESSION['adminID'] );

			$admin->setDBInstance( $this->getDBInstance() );

			$admin->loadProfile();

			if( $admin->getSessionID() != $_SESSION['sessionID'] )
			{
				$this->view('login/admin');
				return;
			}

			$this->view('admins/registerCustomers', ['admin'=>$admin]);
		}
		catch( PDOException $e )
		{

		}
		catch( CustomException $e )
		{

		}
		catch( Exception $e )
		{

		}
		catch( Error $e )
		{

		}
	}

	public function jobDetails()
	{
		try
		{
			if( ! isset( $_SESSION['adminID'] ) || ! isset( $_SESSION['sessionID'] ) )
			{
				$this->view('login/admin');
				return;
			}

			$admin = $this->model('Admin');

			$admin->setUserName( $_SESSION['adminID'] );

			$admin->setDBInstance( $this->getDBInstance() );

			$admin->loadProfile();

			if( $admin->getSessionID() != $_SESSION['sessionID'] )
			{
				$this->view('login/admin');
				return;
			}

			$this->view('admins/jobDetails', ['admin'=>$admin]);
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

	public function viewJob()
	{
		try 
		{
			$admin = $this->model('Admin');

			$job = $this->model('Job');
                        
            $admin->setDBInstance( $this->getDBInstance() );

            $job->setDBInstance($this->getDBInstance() );
            
            $admin->setID($admin->getID());

            $search = $job->searchJob($admin);
            
            if( !empty($search) )
            {
                
                $success['message'] =  $search;

                $success['title'] =  'Success';

                $this->response['success'] = $success;

                $this->response['error'] = false;

                echo  json_encode( $this->response );    
            }
            else
            {
                $error['message'] = 'No matching records';

                $error['title'] = 'Error';

                $this->response['dashboard'] = 'Admins';

                $this->response['success'] = false;

                $this->response['error'] = $error;

                echo  json_encode( $this->response );       
            }

		} 
		catch (Exception $e)
		{
			
		}
	}
}