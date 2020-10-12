<?php

class Task extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function default()
	{
		$this->view('admins/task');
	}

    public function enableSearch()
    {
        try 
        {

            $admin = $this->model('Admin');

            $job = $this->model('Job');
                        
            $admin->setDBInstance( $this->getDBInstance() );

            $job->setDBInstance($this->getDBInstance() );
            
            $admin->setLastName($admin->getLastName());

            $search = $job->search( $admin );

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


	public function createJob()
	{
		try 
		{

			$jobTitle = $deviceName = $deviceDescription = $deviceID = $fault = $role= $ownerName = $ownerPhone = $customerId = $price = "";

    		if( ! isset($_POST['create_job']) )
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

            if(isset($_POST['customerId']))
    		{
        		$customerId = trim( $_POST['customerId'] );
    		}
    		
            if( '' == $customerId )
            	throw new CustomException("customer id not found");


            if( isset( $_POST['device-description'] ) )
    		{
        		$deviceDescription = trim( $_POST['device-description'] );
    		}
    		
            if( '' == $deviceDescription )
            	throw new CustomException("enter device description");

            if(isset($_POST['owner-name']))
            {
                $ownerName = trim( $_POST['owner-name'] );
            }
            
            if( '' == $ownerName )
            	throw new CustomException("enter owner's name");

            if(isset($_POST['owner-phone']))
            {
                $ownerPhone = trim( $_POST['owner-phone'] );
            }
            
            if( '' == $ownerPhone )
            	throw new CustomException("enter owner's mobile or phone number");


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

    		if(isset($_POST['price']))
    		{
        		$price = trim( $_POST['price'] );
    		}

            if( '' == $price )
    			throw new CustomException("enter Job's price");



            $admin = $this->model('Admin');

            $job = $this->model('Job');    
                        
    		$admin->setDBInstance( $this->getDBInstance() );

    		$admin->setID( $admin->getID() );

			$job->setOwnerID($customerId);
			
    		$job->setTitle($jobTitle);

            $job->setOwnerName($ownerName);

            $job->setOwnerPhone($ownerPhone);

            $job->setDeviceName($deviceName);

    		$job->setDeviceDescription($deviceDescription);

    		$job->setDeviceID($deviceID);

    		$job->setFault($fault);

    		$job->setPrice($price);

            $admin->setSessionID( $_SESSION['sessionID'] );
            
            

            if( $admin->saveJob( $job ) )
            {
                
                
                $success['message'] =  'Job details successfully saved.';

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
