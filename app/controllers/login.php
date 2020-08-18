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

			$uName = $pWord = $role = "";

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

            //$passswordHash = password_hash( $pWord, PASSWORD_DEFAULT );
            //var_dump( $passswordHash );
            //return;


            $user->setDBInstance( $this->getDBInstance() );

            $user->setUserName( $uName );


            


            if( ! $user->verifyPassword ( $pWord) )

                throw new CustomException( "Unkown user" );
        	
        	$_SESSION['sessionID'] = Person::generateRandomNumber( 20 );

        	$user->setSessionID( $_SESSION['sessionID'] );

            if( $user instanceof Customer )
            {
                $_SESSION['customerID'] = $user->getUserName();

                $this->response['dashboard'] = 'Customers';
            }
            else if( $user instanceof Admin )
            {
                $_SESSION['adminID'] = $user->getUserName();

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
        catch (Error $e) 
        {
            $this->response['success'] = false;

            $this->response['error'] = $e->getMessage();

            echo json_encode( $this->response );
        }
	}
}