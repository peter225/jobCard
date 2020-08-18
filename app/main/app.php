<?php

$loader = require 'vendor/autoload.php';

$loader->add( '', [ 'app/main', 'app/controllers', 'app/models' ] );
	
class App
{
    protected $controller = 'home';
    protected $method = 'default';
    protected $params;
    
    public function __construct()
    {
        $url = $this->parseURL();
               
        if( isset( $url[0] ) && file_exists( 'app/controllers/' . strtolower( $url[0] ) . '.php' ) )
        {
            if( 'controller' != strtolower( $url[0] ) )
            {
                $this->controller = $url[0];

                unset( $url[0]);
            }
        }
       
        require_once 'app/controllers/' . strtolower( $this->controller ). '.php';
            
        $this->controller = new $this->controller;
       
        if( isset( $url[1] ) )
        {
            if( method_exists( $this->controller, $url[1] ) )
            {
                $this->method = $url[1];
                
                unset( $url[1] );
            }
        }
       
        $this->params = $url ? array_values( $url ) : [];
       
        call_user_func_array( [ $this->controller, $this->method ], $this->params );
    }
    
    protected function parseURL()
    {
        if( isset( $_GET['url'] ) )
        {
            //return $url = explode( '/', filter_var( rtrim( $_GET['url'], '/') ), FILTER_SANITIZE_URL );
    return $url = explode( '/', filter_var( rtrim( $_GET['url'], '/' ), FILTER_SANITIZE_URL ) );
        }
    }
}