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
	public function registerAdmins()
	{
		try
		{
			$firstName = $lastName = $email = $userName = $phoneNumber = $address = $dob =  "";

    		if( ! isset($_POST['register_admin']) )
                throw new CustomException("Ensure to use the Submit button");
        
			if( $_SERVER["REQUEST_METHOD"] != "POST" )
                throw new CustomException("Error Processing Request", 1);


            if( isset($_POST['first-name'] ) )
    		{
        		$firstName = trim( $_POST['first-name'] );
    		}
    		if( '' == $firstName )
            	throw new CustomException("enter firstname");

    		if(isset($_POST['last-name']))
    		{
        		$lastName = trim( $_POST['last-name'] );
    		}
    		if( '' == $lastName )
            	throw new CustomException("enter lastname");

            if(isset($_POST['username']))
    		{
        		$userName = trim( $_POST['username'] );
    		}
    		if( '' == $userName )
            	throw new CustomException("enter username");

            if( isset( $_POST['email'] ) )
    		{
        		$email = trim( $_POST['email'] );
    		}
    		
            if( '' == $email )

    			throw new CustomException("enter email");

            
            if( isset($_POST['phone-number']) )
            {
                $phoneNumber = trim( $_POST['phone-number'] );
            }
            
            if( '' == $phoneNumber )

                throw new CustomException("enter owner's mobile or phone number");


    		if(isset($_POST['address']))
    		{
        		$address = trim( $_POST['address'] );
    		}

            if( '' == $address )

            throw new CustomException("enter customer's address");
                    		
            if(isset($_POST['dob']))
    		{
        		$dob = trim( $_POST['dob'] );
    		}

            if( '' == $dob )
    			throw new CustomException("enter Customer's date of birth");


    		

            $superAdmin = $this->model('superAdmin');

            $superAdmin->setDBInstance( $this->getDBInstance() );

    		$superAdmin->setFirstName( $firstName );

    		$superAdmin->setLastName( $lastName );

    		$superAdmin->setUserName( $userName);

    		$superAdmin->setEmail( $email );

    		$superAdmin->setPhoneNumber( $phoneNumber );

    		$superAdmin->setAddress( $address );

    		$superAdmin->setDob( $dob );

    		if($superAdmin->saveAdminData())
    		{
    			$success['message'] =  'Admin successfully registered.';

                $success['title'] =  'Success';

                $this->response['success'] = $success;

                $this->response['error'] = false;

                echo  json_encode( $this->response );    
            }
            else
            {
                $error['message'] = 'Admins details not successfully saved.';

                $error['title'] = 'Error';

                $this->response['success'] = false;

                $this->response['error'] = $error;

                echo  json_encode( $this->response );       
            }
    		
    	}
    	catch( CustomException $e )
		{
			$this->response['success'] = false;

            $this->response['error']['message'] = $e->getMessage();

            $this->response['error']['title'] = 'Error';

            echo json_encode( $this->response );
		}
		catch( PDOException $e )
		{
			$this->response['success'] = false;

            $this->response['error']['message'] = $e->getMessage();

            $this->response['error']['title'] = 'Error';

            echo json_encode( $this->response );
		         
		}
		catch (Exception $e) 
		{
		    $this->response['success'] = false;

            $this->response['error']['message'] = $e->getMessage();

            $this->response['error']['title'] = 'Error';

            echo json_encode( $this->response );

		}
        catch (Error $e) 
        {
            $this->response['success'] = false;

            $this->response['error']['message'] = $e->getMessage();

            $this->response['error']['title'] = 'Error';

            echo json_encode( $this->response );
        }
	}
}