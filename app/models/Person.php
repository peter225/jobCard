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
        $this->sessionID = $sessionID;

        $sql = 'UPDATE user2 SET session_id = :sessionID WHERE username = :userName';

        $stmt = $this->dbInstance->prepare( $sql );

        $stmt->execute( array(':sessionID'=>$this->sessionID, ':userName'=>$this->userName) );

        return ( $stmt->rowCount() == 1 );
    }

    public function getSessionID()
    {
        return $this->sessionID;
    }

    public function fetchSessionID()
    {
        $sql = 'SELECT session_id FROM user2 WHERE username = :userName';

        $stmt = $this->dbInstance->prepare( $sql );

        $stmt->execute( array(':userName'=>$this->userName) );

        $row = $stmt->fetch( PDO::FETCH_ASSOC );

        return $row['session_id'];
    }

    public function loadProfile()   
    {
        try
        {
            $sql = 'SELECT * FROM user2 WHERE username = :userName';

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