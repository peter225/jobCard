<?php
	
abstract class Controller
{
    protected $response = array();
    
    protected $dbInstance = null;

    public function __construct()
    {

    }
    
    protected function model( $model )
    {
        require_once 'app/models/' . strtolower( $model ) . '.php';
        
        return new $model();
    }
    
    protected function getDBInstance()
    {
        if( null == $this->dbInstance )
        {
            $this->dbInstance = new Database();
        }
        
        return $this->dbInstance;
    }
    
    protected function view( $view, $data = [] )
    {
        require_once 'app/views/' . strtolower( $view ) . '.php';
    }

    /**
     * @author Adeyemo Peter
     * This method cleans up a $user input
     * Notice that this method expects $input to be $value and not an array.
     * If otherwise, use cleanInputs() on an array instead
     * @param mixed $input
     * @return mixed $input
     */
    protected function cleanInput( $input )
    {
        if( is_array( $input ) )
            return $this->cleanInputs( $input );

        $input = strip_tags( $input );

        $input = trim( $input );

        $input = htmlspecialchars( $input, ENT_QUOTES );

        return $input;
    }

    /**
     * @author Adeyemo Peter
     * This method cleans up $user inputs
     * Notice that this method expects each element of $inputs to be $value and not an array.
     * If otherwise, use cleanInput() on each element instead
     * @param array $inputs
     * @return array $inputs
     */
    protected function cleanInputs( array $inputs )
    {
        $cleanInputs = array();

        foreach ( $inputs as $key => $input )
        {
            $cleanInputs[$key] = $this->cleanInput( $input );
        }

        return $cleanInputs;
    }
}