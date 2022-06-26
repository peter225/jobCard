<?php
class superAdmin extends Person
{
	public function loadProfile()   
    {
        try
        {
            $sql = 'SELECT * FROM superadmin WHERE username = :userName';

            $stmt = $this->dbInstance->prepare( $sql );

            $stmt->execute( array(':userName'=>$this->userName ) );

            $row = $stmt->fetch( PDO::FETCH_ASSOC );

            $this->firstName = $row['firstname'];
            $this->lastName = $row['lastname'];
            $this->email = $row['email'];
            $this->gender = $row['gender'];
            $this->sessionID = $row['session_id'];
            $this->dob = $row['dob'];

        }
        catch( PDOException $e )
        {
            throw new PDOException( $e->getMessage() );
        }
    }
	public function fetchAdmins()
    {
        try
        {
            $admins = array();

            $stmt = $this->dbInstance->query( "SELECT COUNT(lastname) FROM admin" );

            if( $stmt->fetchColumn() > 0 )
            {
                $stmt = $this->dbInstance->query("SELECT * FROM admin");
                
                $admins = $stmt->fetchAll();
            }

            return $admins; 
        }
        catch( CustomException $e )
        {
            throw new CustomException("Error: ". $e->getMessage() );   
        }
        catch ( PDOException $e )
        {
            throw new PDOException ( $e->getMessage() );
        }
        catch(Exception $e)
        {
            throw new Exception("Error: ". $e->getMessage() );   
        }
        catch(Error $e)
        {
            throw new Error( $e->getMessage() );
                  
        }
    }
    public function saveAdminData()
    {
        try
        {

            $this->setDBInstance( $this->dbInstance );

            for(;;)
            {

                

                $_SESSION['sessionID'] = $this->generateRandomNumber( 20 );

                $this->setSessionID( $_SESSION['sessionID'] );

                
                if( ! $this->sessionIDExists($_SESSION['sessionID']) )break;

            }

                $sql = "INSERT INTO admin SET   username = :userName,
                                                firstname = :firstName, 
                                                lastname = :lastName, 
                                                email = :email, 
                                                phone = :phoneNumber, 
                                                dob = :DOB,
                                                session_id = :sessionID,
                                                address = :address";
            
            $stmt = $this->dbInstance->prepare( $sql );

            $stmt->execute(array(    
                                    ':firstName' => $this->getFirstName(),
                                    ':lastName' => $this->getLastName(), 
                                    ':email' => $this->getEmail(), 
                                     ':userName' => $this->getUserName(), 
                                    ':phoneNumber' => $this->getPhoneNumber(),  
                                     
                                    ':DOB' => $this->getDob(),
                                    ':sessionID' => $this->getSessionID(),
                                    ':address' => $this->getAddress()
                                ) 
                            );

            return ( $stmt->rowCount() == 1 );
        }
        catch( CustomException $e )
        {
            throw new CustomException("Error: ". $e->getMessage() );   
        }
        catch ( PDOException $e )
        {
            throw new PDOException ( $e->getMessage() );
        }
        catch(Exception $e)
        {
            throw new Exception("Error: ". $e->getMessage() );   
        }
        catch(Error $e)
        {
            throw new Error( $e->getMessage() );
                  
        }
    }
}