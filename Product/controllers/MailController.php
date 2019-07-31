<?php

class Product_MailController extends Core_Controller_Action_Standard
{
	public function sendAction()
	{
	 	try {

	        $mailParams = array(
	          'host' => $_SERVER['HTTP_HOST'],
	          'email' => "piyush.jain0271@gmail.com",
	          'date' => time(),
	          'sender_email' => "piyush.jain@bigsteptech.com",
	          'sender_title' => "Mail",
	          'message' => "Hi PIYUSH JAIN",
	        );

	        Engine_Api::_()->getApi('mail', 'core')->sendSystem(
	          'piyush.jain0271@gmail.com',
	          'product',
	          $mailParams
	        );

	 	} catch (Exception $e) {
	 		echo $e;
	 	    // Silence exception
	 	}      
	}
}

?>