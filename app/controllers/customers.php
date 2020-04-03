<?php

class Customers extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function default()
	{
		try
		{
			if( ! isset( $_SESSION['customerID'] ) || ! isset( $_SESSION['sessionID'] ) )
			{
				$this->view('login/index');
				return;
			}

			$customer = $this->model('Customer');

			$customer->setUserName( $_SESSION['customerID'] );

			$customer->setDBInstance( $this->getDBInstance() );

			$customer->loadProfile();

			if( $customer->getSessionID() != $_SESSION['sessionID'] )
			{
				$this->view('login/index');
				return;
			}

			$this->view('customers/dashboard', ['customer'=>$customer] );
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
	}
}