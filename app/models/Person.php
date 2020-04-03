<?php
class Person
{
	protected $userName;
    protected $passWord;
    protected $dbInstance;
    protected $firstName;
	protected $lastName;
	protected $email;
	protected $phoneNumber;
	protected $gender;
    protected $sessionID;
    protected $delTable;
	protected $dob;

    public function setDBInstance( PDO $dbInstance )
    {
        $this->dbInstance = $dbInstance;
    }

    public function getDBInstance()
    {
        return $this->dbInstance;
    }

    public function setID( $id )
    {
        $this->ID = $id;
    }

    public function getID()
    {
        return $this->ID;
    }

    public function setUserName($uName)
    {
        $this->userName=$uName;
    }
    
    public function getUserName()
    {
        return $this->userName;
    }
    
    public function setPassWord($pWord)
    {
        $this->passWord=$pWord;
    }

    public function getPassWord()
    {
        return $this->passWord;
    }

    public function setFirstName($firstName)
    {
        $this->firstName=$firstName;
    }

    public function getFirstName()
    {
    	return $this->firstName;
    }

    public function setLastName($lastName)
    {
        $this->lastName=$lastName;
    }

    public function getLastName()
    {
    	return $this->lastName;
    }

    public function setEmail($email)
    {
        $this->email=$email;
    }

    public function getEmail()
    {
    	return $this->email;
    }

    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber=$phoneNumber;
    }

    public function getPhoneNumber()
    {
    	return $this->phoneNumber;
    }

    public function setGender($gender)
    {
        $this->gender=$gender;
    }

    public function getGender()
    {
    	return $this->gender;
    }

    public function setDob($dob)
    {
        $this->dob=$dob;
    }
    public function getDob()
    {
    	return $this->dob;
    }

    public function setSessionID( $sessionID )
    {
        try
        {
            $this->sessionID = $sessionID;

            $sql = '';

            if( $this instanceof Customer )
                $sql = 'UPDATE user SET session_id = :sessionID WHERE username = :userName';
            else if( $this instanceof Admin )
                $sql = 'UPDATE admin SET session_id = :sessionID WHERE username = :userName';

            if( '' == $sql )
                throw new CustomException("Unrecognised role");
                
            $stmt = $this->dbInstance->prepare( $sql );

            $stmt->execute( array(':sessionID'=>$this->sessionID, ':userName'=>$this->userName) );

            return ( $stmt->rowCount() == 1 );
        }
        catch (PDOException $e) 
        {
           throw new PDOException($e->getMessage() );
        }
        catch (CustomException $e) 
        {
           throw new CustomException( $e->getMessage() );
        }
        catch ( Exception $e) 
        {
           throw new Exception($e->getMessage() );    
        }
    }

    public function resetSessionID()
    {
        $sql = 'UPDATE user SET session_id = NULL WHERE username = :userName';

        $stmt = $this->dbInstance->prepare( $sql );

        $stmt->execute( array(':userName'=>$this->userName) );

        return ( $stmt->rowCount() == 1 );
    }

    public function getSessionID()
    {
        return $this->sessionID;
    }

    public function fetchSessionID()
    {
        try
        {
            $sql = '';

            if( $this instanceof Customer )
                $sql = 'SELECT session_id FROM user WHERE username = :userName';
            else if( $this instanceof Admin )
                $sql = 'SELECT session_id FROM admin WHERE username = :userName';

            if( '' == $sql )
                throw new CustomException("Unrecognised role");
            
            $stmt = $this->dbInstance->prepare( $sql );

            $stmt->execute( array(':userName'=>$this->userName) );

            $row = $stmt->fetch( PDO::FETCH_ASSOC );

            return $row['session_id'];
        }
        catch (PDOException $e) 
        {
           throw new PDOException($e->getMessage() );
        }
        catch (CustomException $e) 
        {
           throw new CustomException( $e->getMessage() );
        }
        catch ( Exception $e) 
        {
           throw new Exception($e->getMessage() );    
        }
    }

    public function loadProfile()   
    {
        try
        {
            $sql = '';

            if( $this instanceof Customer )
                $sql = 'SELECT * FROM user WHERE username = :userName';
            else if( $this instanceof Admin )
                $sql = 'SELECT * FROM admin WHERE username = :userName';

            if( '' == $sql )
                throw new CustomException("Unrecognised role");
                
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
        catch (PDOException $e) 
        {
           throw new PDOException($e->getMessage() );
             
        }
        catch (CustomException $e) 
        {
           throw new CustomException( $e->getMessage() );
             
        }
        catch ( Exception $e) 
        {
           throw new Exception($e->getMessage() );
             
        }
    }
    
    public function verifyPassword( $pWord )
    {
        try 
        {
            $sql = "";

            if( $this instanceof Customer )
                $sql = "SELECT password FROM user WHERE username = :userName";
            else if( $this instanceof Admin )
                $sql = "SELECT password FROM admin WHERE username = :userName";

            if( "" == $sql )
                throw new CustomException("Unrecognised role" );

            $stmt = $this->dbInstance->prepare( $sql );

            $stmt->execute( array ( ':userName'=>$this->userName ) );

            $row = $stmt->fetch( PDO::FETCH_ASSOC );

            $passwordHash = $row['password'];

            //throw new CustomException( $passwordHash );
            
            return ( password_verify( $pWord, $passwordHash ) );
        }
        catch (PDOException $e) 
        {
           throw new PDOException($e->getMessage() );
             
        }
        catch (CustomException $e) 
        {
           throw new CustomException( $e->getMessage() );
             
        }
        catch ( Exception $e) 
        {
           throw new Exception($e->getMessage() );
             
        }
    }

    public static function generateRandomNumber( $digit )
    {
        $number = "";

        for ($i = 0; $i < $digit; $i++) 
        {
            $number .= mt_rand(0, 9);
        }

        return $number;
    }
}