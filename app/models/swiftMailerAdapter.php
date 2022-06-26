<?php

/**
 * 
 */
class swiftMailerAdapter 
{
	
	//require_once '/vendor/autoload.php';
	protected $message;

	Protected $sender;

	protected $receipent;


	public function sendMail()
	{
		try
		{
			$transport = Swift_SmtpTransport::newInstance('webmail.local', 25)
	      	->setUsername('peter@webmail.local')->setPassword('peter');

			$mailer = Swift_Mailer::newInstance($transport);

	    // Create a message
		    $message = Swift_Message::newInstance('Wonderful Subject')
		      ->setFrom(array('peter@webmail.local' => 'Peter Adeyemo'))
		      ->setTo(array('john@webmail.local' => 'John Adeyemo'))
		      ->setBody('Here is the message itself')
		      ;

			    // Send the message
			$result = $mailer->send($message);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
		catch(CustomException $e)
		{
			echo $e->getMessage();
		}
		catch(Error $e)
		{
			echo $e->getMessage();
		}
	}
}