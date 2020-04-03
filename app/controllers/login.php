<?php

class Login extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function default()
	{
		$this->view('login/index');
	}

	public function loginUser()
	{
		try 
		{
			$uName = $pWord = "";

    		if( ! isset($_POST['submit-btn']) )
        	throw new CustomException("Ensure to use the login button");
        
			if( $_SERVER["REQUEST_METHOD"] != "POST" )
        	throw new CustomException("Error Processing Request", 1);
        
    		if(isset($_POST['username']))
    		{
        		$uName = trim( $_POST['username'] );
    		}

    		if(isset($_POST['psw']))
    		{
        		$pWord = trim( $_POST['psw'] );
    		}
    
    		if( "" == $uName || "" == $pWord )
        		throw new CustomException("Enter your username and/or passsword");

            if( isset($_POST['role']))
                $role = $_POST['role'];

            $user = null;
       
            if( 'Customer' == $role )
    		  $user = $this->model('Customer');

            else if( 'Admin' == $role )
                $user = $this->model('Admin');

            if( null == $user )
                throw new CustomException("Unkown role detected");
                
    		$user->setDBInstance( $this->getDBInstance() );

    		$user->setUserName($uName);

    		$user->setPassWord($pWord);

            //$passswordHash = password_hash( $pWord, PASSWORD_DEFAULT );

            //var_dump( $passswordHash );

            if( ! $user->verifyPassword ( $pWord ) )
                throw new CustomException( "Unknown User!" );
        	
        	$_SESSION['sessionID'] = Person::generateRandomNumber( 20 );

        	$user->setSessionID( $_SESSION['sessionID'] );

            if( $user instanceof Customer )
            {
                $_SESSION['customerID'] = $user->getUsername();
                $this->response['dashboard'] = 'Customers';
            }
            else if( $user instanceof Admin )
            {
                $_SESSION['adminID'] = $user->getUsername();
                $this->response['dashboard'] = 'Admins';            	
            }

        	$this->response['success'] = 'OK';

        	$this->response['error'] = false;

       		echo  json_encode( $this->response );
		}
		catch( CustomException $e )
		{
			$this->response['success'] = false;

            $this->response['error'] = $e->getMessage();

            echo json_encode( $this->response );
		}
		catch( PDOException $e )
		{
			$this->response['success'] = false;

            $this->response['error'] = $e->getMessage();

            echo json_encode( $this->response );
		         
		}
		catch (Exception $e) 
		{
		    $this->response['success'] = false;

            $this->response['error'] = $e->getMessage();

            echo json_encode( $this->response );
		}
	}
}