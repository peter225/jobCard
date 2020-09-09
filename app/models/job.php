<?php

class Job 
{
	protected $jobID;
	protected $title;
	protected $deviceDescription;
	protected $deviceID;
    protected $ownerName;
    protected $ownerPhoneNumber;
	protected $fault;
	protected $deviceName;
	protected $dbInstance;
    protected $searchString;

	public function setDBInstance( PDO $dbInstance )
	{
		$this->dbInstance = $dbInstance;
	}

	public function getDBInstance()
	{
		return $this->dbInstance;
	}

	public function setJobID( $jobID )
	{
		$this->jobID = $jobID;
	}

	public function getJobID()
	{
		return $this->jobID;
	}

    public function setOwnerName($ownerName)
    {
        $this->ownerName = $ownerName;
    }

    public function getOwnerName()
    {
        return $this->ownerName;
    }

    public function setOwnerPhone($ownerPhoneNumber)
    {
        $this->ownerPhone = $ownerPhoneNumber;
    }

    public function getOwnerPhone()
    {
        return $this->ownerPhone;
    }

    public function search( Admin $admin )
    {
        try
        {
             if(isset($_POST['search-btn']))
             {
                $firstName = trim($_POST['firstname']);

                $sql = 'SELECT * FROM customer WHERE firstname =:firstName';

                $stmt = $this->dbInstance->prepare($sql);

                $stmt->execute( array(':firstName'=> $firstName) );

                $results = $stmt->fetchAll();

                return $results;
             } 
             else
             {
                echo "No results";
             }
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
        catch ( Error $e) 
        {
           throw new Error($e->getMessage() );
             
        }
    }

    public function setTitle( $title )
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setDeviceName($deviceName)
    {
        $this->deviceName = $deviceName;
    }
    
    public function getDeviceName()
    {
        return $this->deviceName;
    }

    public function setDeviceDescription($deviceDescription)
    {
        $this->deviceDescription = $deviceDescription;
    }
    
    public function getDeviceDescription()
    {
        return $this->deviceDescription;
    }

    public function setDeviceID($deviceID)
    {
        $this->deviceID = $deviceID;
    }
    
    public function getDeviceID()
    {
        return $this->deviceID;
    }

    public function setFault( $fault )
    {
        $this->fault = $fault;
    }
    
    public function getFault()
    {
        return $this->fault;
    }

    public function generateID( $digit )
	{
		$number = "";

        for ($i = 0; $i < $digit; $i++) 
        {
            $number .= mt_rand(0, 9);
        }

		return $number;
	}

	public function IDExists( $jobID )
	{

		$stmt = $this->dbInstance->prepare( 'SELECT COUNT(id) FROM job WHERE id = :ID' );

		$stmt->execute( array(':ID'=>$jobID ) );
        
		return ( $stmt->fetchColumn() > 0 );
	}
}	