<?php

class registerCustomers extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function default()
	{
		$this->view('admins/registerCustomers');
	}

	public function registerCustomer()
	{
		try 
		{

			$firstName = $lastName = $email = $userName = $passWord = $phoneNumber = $address = $dob =  "";

    		if( ! isset($_POST['register_customer']) )
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

            if(isset($_POST['password']))
            {
                $passWord = trim( $_POST['password'] );
            }
            
            if( '' == $passWord )

                throw new CustomException("enter your password");

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


    		

            $admin = $this->model('Admin');

            $admin->setDBInstance( $this->getDBInstance() );

    		$admin->setFirstName( $firstName );

    		$admin->setLastName( $lastName );

    		$admin->setUserName( $userName);

    		$admin->setPassWord( $passWord );

    		$admin->setEmail( $email );

    		$admin->setPhoneNumber( $phoneNumber );

    		$admin->setAddress( $address );

    		$admin->setDob( $dob );

            $admin->setSessionID( $_SESSION['sessionID'] );
            
            

            if( $admin->saveCustomerData() )
            {
                
                
                $success['message'] =  'Customer successfully registered.';

                $success['title'] =  'Success';

                $this->response['success'] = $success;

                $this->response['error'] = false;

                echo  json_encode( $this->response );    
            }
            else
            {
                $error['message'] = 'Job details not successfully saved.';

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