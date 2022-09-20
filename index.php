<?php



// server should keep session data for AT LEAST 6 hours

require_once 'app/models/Database.php';
require_once 'app/main/app.php';


class Sessions
{
    protected $dbInstance = null;

    protected function getDBInstance(){
        if( null == $this->dbInstance )
        {
            $this->dbInstance = new Database();
        }
        
        return $this->dbInstance;
    }

    public function open() {
        
        if ($this->getDBInstance()) {
          return true;
        }
        else {
          return false;
        }
    } // end function _open()
  
    public function close() {
        if($this->getDBInstance() == null);
        return true;
    } // end function _close()
  
    public function read($sess_id) {
        
        $sql = "select data from sessions where sess_id=:sess_id";
        $statement = $this->getDBInstance()->prepare($sql);
        $statement->execute(array(':sess_id' => $sess_id));
        $num = $statement->rowCount();
        if ($num == 1) {
          $row = $statement->fetch(PDO::FETCH_ASSOC);
          $data = $row["data"];
          return $data;
        }
        else {
          return '';  //  return empty string if no data returned
        }
    } // end function _read()

    public function write($sess_id,$data) {
        $access = time();
        $sql = "select * from sessions where sess_id=:sess_id";
        $statement = $this->getDBInstance()->prepare($sql);
        $statement->execute(array(':sess_id' => $sess_id));
        $num = $statement->rowCount();
        if ($num === 0) {
        $sql = "insert into sessions (sess_id, _access, data) values ".
            "(:sess_id,:access,:data)";
        $statement2 = $this->getDBInstance()->prepare($sql);
        $myArray = array();
        $myArray[':sess_id'] = $sess_id;
        $myArray[':access'] = $access;
        $myArray[':data'] = $data;
        $statement2->execute($myArray);
        if ($statement2 === false) {
            return false;
        }
        else {
            // new data stored
            return true;
        }
        } // end case of inserting new session data
        else {
        $sql = "update sessions set _access = :access, " .
            "data = :data where sess_id = :sess_id";
        $statement2 = $this->getDBInstance()->prepare($sql);
        $myArray = array();
        $myArray[':sess_id'] = $sess_id;
        $myArray[':access'] = $access;
        $myArray[':data'] = $data;
        $statement2->execute($myArray);
        if ($statement2 === false) {
            return false;
        }
        else {
            // data updated
            return true;
        }
        } // end case of updating existing record
    }
    
    public function destroy($sess_id) {
        $sql= "delete from sessions where sess_id=:id";
        $statement = $this->getDBInstance()->prepare($sql);
        $statement->execute(array(':id' => $sess_id));
        if ($statement === true) {
        return true;
        }
        else {
        return false;
        }
    } // end function _destroy()

    public function gc($max) {
        $old = time() - $max;
        $sql = "delete from sessions where _access < :old";
        $statement = $this->getDBInstance()->prepare($sql);
        $statement->execute(array(':old' => $old));
        if ($statement === true) {
        return true;
        }
        else {
        return false;
        }
    } // end function _gc
    

}

$sess = new Sessions();
session_set_save_handler(
    array($sess,'open'),
    array($sess,'close'),
    array($sess,'read'),
    array($sess,'write'),
    array($sess,'destroy'),
    array($sess,'gc')
);

ini_set('session.gc_maxlifetime', 24*60*60 );

//session_save_path( 'app/sessions' );

ini_set('session.gc_probability', 1 );

ini_set( 'session.gc_divisor', 100 );

//each client should remember their session id for EXACTLY 6 hours
session_set_cookie_params( 24*60*60 );

session_start();

ini_set('date.timezone', 'Africa/Lagos');
$app = new App;