<?php

class User extends Person
{
       // public function check()
        //{
            //try
            //{
            //$sql = "SELECT * FROM user WHERE username=:userName";

            //$stmt = $this->dbInstance->prepare( $sql );

            //$stmt->execute( array ( ':userName'=>$this->userName ) );

            //return ( $stmt->rowCount() == 1 );
            //}
            //catch( PDOException $e )
            //{
            //throw new  PDOException( "Error: ". $e->getMesssage() );
            //}
            //catch( Exception $e )
            //{ 
            //throw new Exception( "Error: ". $e->getMesssage() );
            //} 
        //}

    public function verifyPassword( $pWord )
    {
            try 
            {
                $sql = "SELECT password FROM user2 WHERE username = :userName";

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
}