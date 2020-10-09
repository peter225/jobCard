<?php
class superAdmin extends Person
{
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
}