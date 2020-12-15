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
            
            $job->setOwnerID($job->getOwnerID());

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

	public function updateJob()
	{
		try 
		{
			$jobTitle = $deviceName = $deviceDescription = $deviceID = $fault = 
			$balance = $id = $jobPrice = $pricePaid = "";

    		if( ! isset($_POST['update_job']) )
    			throw new CustomException("Ensure to use the Submit button");
        
			if( $_SERVER["REQUEST_METHOD"] != "POST" )
                throw new CustomException("Error Processing Request", 1);

            if( isset($_POST['job-title'] ) )
    		{
        		$jobTitle = trim( $_POST['job-title'] );
    		}
    		
            if( '' == $jobTitle )
            	throw new CustomException("enter the job title");

    		if(isset($_POST['device-name']))
    		{
        		$deviceName = trim( $_POST['device-name'] );
    		}
    		
            if( '' == $deviceName )
            	throw new CustomException("enter device name");

            if(isset($_POST['id']))
    		{
        		$id = trim( $_POST['id'] );
    		}
    		
            if( '' == $id )
            	throw new CustomException("id not found");


            if( isset( $_POST['device-description'] ) )
    		{
        		$deviceDescription = trim( $_POST['device-description'] );
    		}
    		
            if( '' == $deviceDescription )
            	throw new CustomException("enter device description");

            if(isset($_POST['device-id']))
    		{
        		$deviceID = trim( $_POST['device-id'] );
    		}

            if( '' == $deviceID )
            	throw new CustomException("enter device id");
                    		
            if(isset($_POST['fault']))
    		{
        		$fault = trim( $_POST['fault'] );
    		}

            if( '' == $fault )
    			throw new CustomException("enter what's wrong with the device");

    		if(isset($_POST['actualPrice']))
    		{
        		$jobPrice = trim( $_POST['actualPrice'] );
    		}

            if( '' == $jobPrice )
    			throw new CustomException("enter Job's price");

    		if(isset($_POST['amountPaid']))
    		{
        		$pricePaid = trim( $_POST['amountPaid'] );
    		}

            if( '' == $pricePaid )
    			throw new CustomException("enter Amount Paid");

    		if(isset($_POST['balance']))
    		{
        		$balance = trim( $_POST['balance'] );
    		}

            if( '' == $balance )
    			throw new CustomException("enter customer's balance");

            $admin = $this->model('Admin');

            $job = $this->model('Job');    
                        
    		$admin->setDBInstance( $this->getDBInstance() );

    		$job->setDBInstance( $this->getDBInstance() );

    		$admin->setID( $admin->getID() );

			$job->setJobID($id);
			
    		$job->setTitle($jobTitle);

            $job->setDeviceName($deviceName);

    		$job->setDeviceDescription($deviceDescription);

    		$job->setDeviceID($deviceID);

    		$job->setFault($fault);

    		$job->setActualPrice($jobPrice);

    		$job->setAmountPaid($pricePaid);

			$job->setBalance($balance);

    		if( $admin->updateJob($job) )
            {
               	$success['message'] = 'Jobs successfully updated';

                $success['title'] =  'Success';

                $this->response['success'] = $success;

                $this->response['error'] = false;

                echo  json_encode( $this->response );    
            }
            else
            {
                $error['message'] = 'Update unsuccessful';

                $error['title'] = 'Error';

                $this->response['dashboard'] = 'Admins';

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