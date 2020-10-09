<?php
/**if( isset($_POST['role']))
                
                $role = $_POST['role'];

            $user = null;
            
            if( 'Customer' == $role )
              $user = $this->model('Customer');

                
            else if( 'Admin' == $role )
                $user = $this->model('Admin');

            else if( 'superAdmin' == $role )
                $user = $this->model('superAdmin');
**/
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

                $user = $this->model('admin');

                $user->setID($_SESSION['adminID']);
            }

            else if( isset($_SESSION['customerID'] ) )
            {

                $user = $this->model('customer');

                $user->setID($_SESSION['customerID']);
            }

            else if( isset($_SESSION['superAdminID'] ) )
            {
                
                $user = $this->model('superAdmin');

                $user->setID($_SESSION['superAdminID']);
            }


            if( null != $user )
            {
                $user->setDBInstance( $this->getDBInstance() );
            
                $user->resetSessionID();
            }

            if( $user instanceof superAdmin )

                $this->view('login/superAdmin');

            else if( $user instanceof Admin )
                
                $this->view('login/admin');

            else if( $user instanceof Customer )
                
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