<?php

class Admin extends Person
{
    
    public function loadProfile()   
    {
        try
        {
            $sql = 'SELECT * FROM admin WHERE username = :userName';

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

    public function saveJob( Job $job )
    {
        try
        {


            $job->setDBInstance( $this->dbInstance );

            for(;;)
            {

                $jobID = $job->generateID(9);

                $job->setJobID( $jobID );

                if( ! $job->IDExists( $jobID ) )

                    break;

            }

            $sql = "INSERT INTO jobs SET  id = :ID, 
                                          job_title = :jobTitle, 
                                          device_name = :deviceName, 
                                          device_description = :deviceDescription, 
                                          device_id = :deviceID, 
                                          fault = :Fault, 
                                          owner_name = :ownerName, 
                                          owner_phone = :ownerPhone,
                                          customer_id = :customerId";
            
            $stmt = $this->dbInstance->prepare( $sql );

            
            

            $stmt->execute(array(   
                                    ':ID'=>$job->getJobID(), 
                                    ':jobTitle'=>$job->getTitle(), 
                                    ':deviceName'=>$job->getDeviceName(), 
                                    ':deviceDescription'=>$job->getDeviceDescription(), 
                                    ':deviceID'=>$job->getDeviceID(), 
                                    ':Fault' => $job->getFault(),  
                                    ':ownerName'=>$job->getOwnerName(), 
                                    ':ownerPhone'=>$job->getOwnerPhone(),
                                    ':customerId'=>$job->getOwnerID()
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

    public function saveCustomerData()
    {
        try
        {

            $this->setDBInstance( $this->dbInstance );

            for(;;)
            {

                $this->ID = $this->generateRandomNumber(9);

                $this->setID( $this->ID );

                $_SESSION['sessionID'] = $this->generateRandomNumber( 20 );

                $this->setSessionID( $_SESSION['sessionID'] );

                $this->passWord = $this->hashPassword($this->passWord);

                $this->setPassWord($this->passWord);

                if( ! $this->IDExists( $this->ID ) && ! $this->sessionIDExists($_SESSION['sessionID']) )

                    break;

            }

                $sql = "INSERT INTO customer SET customer_id = :ID, 
                                                 firstname = :firstName, 
                                                 lastname = :lastName, 
                                                 email = :email, 
                                                 password = :psw, 
                                                 username = :userName, 
                                                 phone = :phoneNumber, 
                                                 gender = :gender,
                                                 dob = :DOB,
                                                 session_id = :sessionID,
                                                 address = :address";
            
            $stmt = $this->dbInstance->prepare( $sql );

            $stmt->execute(array(   ':ID' => $this->getID(), 
                                    ':firstName' => $this->getFirstName(),
                                    ':lastName' => $this->getLastName(), 
                                    ':email' => $this->getEmail(), 
                                    ':psw' => $this->getPassWord(), 
                                    ':userName' => $this->getUserName(), 
                                    ':phoneNumber' => $this->getPhoneNumber(),  
                                    ':gender' => $this->getGender(), 
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
    
    public function fetchCustomers()
    {
        try
        {
            $customers = array();

            $stmt = $this->dbInstance->query( "SELECT COUNT(lastname) FROM customer" );

            if( $stmt->fetchColumn() > 0 )
            {
                $stmt = $this->dbInstance->query("SELECT * FROM customer");
                
                $customers = $stmt->fetchAll();
            }

            return $customers; 
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