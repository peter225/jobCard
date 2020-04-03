<?php

class Logout extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function default()
	{
        try
        {
    		$user = null;
                       
            if( isset($_SESSION['adminID'] ) )
            {
                $user = $this->model('Admin');
                $user->setID($_SESSION['adminID']);
            }
            else if( isset($_SESSION['customerID'] ) )
            {
                $user = $this->model('Customer');
                $user->setID($_SESSION['customerID']);
            }

            if( null != $user )
            {
                $user->setDBInstance( $this->getDBInstance() );
            
                $user->resetSessionID();
            }

            if( $user instanceof Customer )
                $this->view('login/index');
            else if( $user instanceof Admin )
                $this->view('login/admin');

            else
                $this->view('login/index');
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