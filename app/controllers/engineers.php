<?php

/**
 * 
 */
class engineers extends Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function default()
	{
		try
		{
			if( ! isset( $_SESSION['engineerID'] ) || ! isset( $_SESSION['sessionID'] ) )
			{
				$this->view('login/engineer');
				return;
			}

			$engineer = $this->model('engineer');

			$engineer->setUserName( $_SESSION['engineerID'] );

			$engineer->setDBInstance( $this->getDBInstance() );

			$engineer->loadProfile();

			if( $engineer->getSessionID() != $_SESSION['sessionID'] )
			{
				$this->view('login/engineer');
				return;
			}

			$this->view( 'engineers/dashboard', ['engineer'=>$engineer] );
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

	public function jobDetails()
	{
		try
		{
			if( ! isset( $_SESSION['engineerID'] ) || ! isset( $_SESSION['sessionID'] ) )
			{
				$this->view('login/engineer');
				return;
			}
			
			$engineer = $this->model('engineer');

			$engineer->setUserName( $_SESSION['engineerID'] );

			$engineer->setDBInstance( $this->getDBInstance() );

			$engineer->loadProfile();

			if( $engineer->getSessionID() != $_SESSION['sessionID'] )
			{
				$this->view('login/engineer');
				return;
			}

			$this->view('engineers/jobDetails', ['engineer'=>$engineer]);
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
	
	public function fetchJobs()
	{
		try
		{
			

			$engineer = $this->model('engineer');

			$engineer->setUserName( $_SESSION['engineerID'] );

			$engineer->setDBInstance( $this->getDBInstance() );

			$engineer->loadProfile();

			if( $engineer->getSessionID() != $_SESSION['sessionID'] )
				throw new CustomException("time out!");

			$jobs = $engineer->fetchJobs();

			if( !empty( $jobs ))
			{

				$success['message'] = $jobs;

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

	public function updateStatus()
	{
		try
		{
			$id = $status = "";

			if( ! isset($_POST['update-status-btn']) )
    			throw new CustomException("Ensure to use the update button");
			
			if(isset($_POST['status']))
            {
                $status = trim( $_POST['status'] );
            }
            
            if( '' == $status )
                throw new CustomException("status not found");

            if(isset($_POST['id']))
            {
                $id = trim( $_POST['id'] );
            }
            
            if( '' == $id )
                throw new CustomException("id not found");
			

			$engineer = $this->model('engineer');

			$job = $this->model('job');

			$job->setDBInstance( $this->getDBInstance() );

			$engineer->setDBInstance( $this->getDBInstance() );

			$engineer->setID($engineer->getID());

			$job->setJobID($id);

			$job->setStatus($status);

//throw new CustomException($job->getJobID($id));

			if( $engineer->updateStatus($job))
			{

				$success['message'] = 'Jobs status successfully updated';

                $success['title'] =  'Success';

                $this->response['success'] = $success;

                $this->response['error'] = false;

                echo  json_encode( $this->response );

			}
			else
			{
				$error['message'] = 'Update unsuccessful';

                $error['title'] = 'Error';

                $this->response['success'] = false;

                $this->response['error'] = $error;

                echo  json_encode( $this->response );
			}
		}
		catch( PDOException $e )
		{
			$this->response['success'] = false;

            $this->response['error']['message'] = $e->getMessage();

            $this->response['error']['title'] = 'Error';

            echo json_encode( $this->response );
		}
		catch( CustomException $e )
		{
			$this->response['success'] = false;

            $this->response['error']['message'] = $e->getMessage();

            $this->response['error']['title'] = 'Error';

            echo json_encode( $this->response );
		}
		catch( Exception $e )
		{
			$this->response['success'] = false;

            $this->response['error']['message'] = $e->getMessage();

            $this->response['error']['title'] = 'Error';

            echo json_encode( $this->response );
		}
		catch( Error $e )
		{
			$this->response['success'] = false;

            $this->response['error']['message'] = $e->getMessage();

            $this->response['error']['title'] = 'Error';

            echo json_encode( $this->response );
		}
	}
}