<?php  

class Product_Form_Admin_Global extends Engine_Form
{
 	public function init()
  	{
    
    	$this->setTitle('Global Settings');
    	$this->setDescription('These settings affect all members in your community.');

    	$this->addElement('Text', 'product_page', array(
    		'label' => "Entries Per Page",
    		'description' => "How many blog entries will be shown per page? (Enter a number between 1 and 999)",
            'value' => Engine_Api::_()->getApi('settings', 'core')->getSetting('product.page', 10),
    	));

    	$this->addElement('Button', 'submit', array(
    		'label' => "Save Changes",
    		'value' => "save",
    		'type' => "submit",
    	));
  	}
}


?>