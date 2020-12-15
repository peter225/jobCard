<?php
/**
 * Created by PhpStorm.
 * User: ADEYEMO
 * Date: 2/15/2019
 * Time: 1:27 PM
 */

class CustomException extends Exception
{
    public function __construct( $message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct( $message, $code, $previous );
    }
}