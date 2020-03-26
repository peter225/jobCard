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
    
    		if( "" == $uName || ""==$pWord )
        		throw new CustomException("Enter your username and/or passsword");
       
    		$user = $this->model('User');
    		$user->setDBInstance( $this->getDBInstance() );

    		$user->setUserName($uName);
    		$user->setPassWord($pWord);

    //$passswordHash = password_hash( $pWord, PASSWORD_DEFAULT );

    //var_dump( $passswordHash );
    
        	if( $user->verifyPassword ( $pWord ) )
        	{
        		$_SESSION['userID'] = $user->getUsername();
        		$_SESSION['sessionID'] = Person::generateRandomNumber( 20 );
        		$user->setSessionID( $_SESSION['sessionID'] );

            	$this->response['dashboard'] = 'Customers';
            	$this->response['success'] = 'OK';
            	$this->response['error'] = false;
           		echo  json_encode( $this->response );
        	}
        	else
        	{
        		$this->response['success'] = false;
            	$this->response['error'] = "Unknown User!";
            	echo json_encode( $this->response );
        	} 
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