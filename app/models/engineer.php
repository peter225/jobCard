<?php
/**
 * 
 */
class engineer extends Person
{
	public function fetchJobs()
    {
        try
        {
            $jobs = array();

            $stmt = $this->dbInstance->query( "SELECT COUNT(id) FROM jobs" );

            if( $stmt->fetchColumn() > 0 )
            {
                $stmt = $this->dbInstance->query("SELECT * FROM jobs");
                
                $jobs = $stmt->fetchAll();
            }

            return $jobs; 
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

    public function updateStatus(Job $job)
    {
        try
        { 

            $job->setDBInstance($this->dbInstance);

            $sql = "UPDATE jobs SET status =:status WHERE id =:ID";

            $stmt = $this->dbInstance->prepare($sql);

            $stmt->execute(array(':status'=>$job->getStatus(),
                                 ':ID'=>$job->getJobID()
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