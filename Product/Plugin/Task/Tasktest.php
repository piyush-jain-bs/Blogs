<?php 

class Product_Plugin_Task_Tasktest extends Core_Plugin_Task_Abstract
{
  public function execute()
  {
  	Engine_Api::_()->getApi('settings', 'core')->setSetting("key", "value");

  }
}

?>