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

}