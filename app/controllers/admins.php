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

			$this->view('admins/dashboard', ['admin'=>$admin]);
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

	/**public function payments()
	{
		try
		{
			if( ! isset( $_SESSION['userID'] ) || ! isset( $_SESSION['sessionID'] ) )
			{
				$this->view('login/index');
				return;
			}

			$customer = $this->model('User');

			$customer->setUserName( $_SESSION['userID'] );

			$customer->setDBInstance( $this->getDBInstance() );

			$customer->loadProfile();

			if( $customer->getSessionID() != $_SESSION['sessionID'] )
			{
				$this->view('login/index');
				return;
			}

			$this->view('customers/payments');	
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
	}**/
}