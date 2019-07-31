<?php  

class Product_AdminSettingsController extends Core_Controller_Action_Admin
{
	public function indexAction()
  	{
  		$this->view->navigation = $navigation = Engine_Api::_()->getApi('menus', 'core')->getNavigation('product_admin_main', array(), 'product_admin_main_settings');

		$this->view->form = $form = new Product_Form_Admin_Global();

		if( $this->getRequest()->isPost() && $form->isValid($this->_getAllParams()) )
	    {
		    $values = $form->getValues();

		    foreach ($values as $key => $value){
		        Engine_Api::_()->getApi('settings', 'core')->setSetting($key, $value);
		    }
		    $form->addNotice('Your changes have been saved.');
	    }
	} 

	public function categoriesAction()
  	{
	    $this->view->navigation = $navigation = Engine_Api::_()->getApi('menus', 'core')
	      ->getNavigation('product_admin_main', array(), 'product_admin_main_categories');

	    $this->view->categories = Engine_Api::_()->getDbtable('categories', 'product')->fetchAll();
	  		
  	}

  public function addCategoryAction()
  {
    // In smoothbox
    $this->_helper->layout->setLayout('admin-simple');

    // Generate and assign form
    $form = $this->view->form = new Product_Form_Admin_Category();
    $form->setAction($this->view->url(array()));

    // Check post
    if( !$this->getRequest()->isPost() ) {
      $this->renderScript('admin-settings/form.tpl');
      return;
    }
    if( !$form->isValid($this->getRequest()->getPost()) ) {
      $this->renderScript('admin-settings/form.tpl');
      return;
    }
    
    
    // Process
    $values = $form->getValues();

    $categoryTable = Engine_Api::_()->getDbtable('categories', 'product');
    $db = $categoryTable->getAdapter();
    $db->beginTransaction();

    $viewer = Engine_Api::_()->user()->getViewer();
    
    try {
      $categoryTable->insert(array(
        'user_id' => $viewer->getIdentity(),
        'category_name' => $values['label'],
      ));

      $db->commit();
    } catch( Exception $e ) {
      $db->rollBack();
      throw $e;
    }

    return $this->_forward('success', 'utility', 'core', array(
      'smoothboxClose' => 10,
      'parentRefresh'=> 10,
      'messages' => array('')
    ));
  }
  
  	public function deleteCategoryAction()
  	{
	    // In smoothbox
	    $this->_helper->layout->setLayout('admin-simple');
	    $category_id = $this->_getParam('id');
	    $this->view->product_id = $this->view->category_id = $category_id;
	    $categoriesTable = Engine_Api::_()->getDbtable('categories', 'product');
	    $category = $categoriesTable->find($category_id)->current();
	    
	    if( !$category ) {
	      return $this->_forward('success', 'utility', 'core', array(
	        'smoothboxClose' => 10,
	        'parentRefresh'=> 10,
	        'messages' => array('')
	      ));
	    } else {
	      $category_id = $category->getIdentity();
	    }
	    
	    if( !$this->getRequest()->isPost() ) {
	      // Output
	      $this->renderScript('admin-settings/delete.tpl');
	      return;
	    }
	    
	    // Process
	    $db = $categoriesTable->getAdapter();

	    $db->beginTransaction();
	    
	    try {
	      
	      $category->delete();
	      
	      $productTable = Engine_Api::_()->getDbtable('products', 'product');
	      $productTable->update(array(
	        'category_id' => 0,
	      ), array(
	        'category_id = ?' => $category_id,
	      ));
	      
	      $db->commit();
	    } catch( Exception $e ) {
	      $db->rollBack();
	      throw $e;
	    }
	    
	    return $this->_forward('success', 'utility', 'core', array(
	      'smoothboxClose' => 10,
	      'parentRefresh'=> 10,
	      'messages' => array('')
	    ));
  	}

  	public function editCategoryAction()
  	{
	    // In smoothbox
	    $this->_helper->layout->setLayout('admin-simple');
	    $category_id = $this->_getParam('id');
	    $this->view->product_id = $this->view->product_id = $id;
	    $categoriesTable = Engine_Api::_()->getDbtable('categories', 'product');
	    $category = $categoriesTable->find($category_id)->current();
	    
	    if( !$category ) {
	      return $this->_forward('success', 'utility', 'core', array(
	        'smoothboxClose' => 10,
	        'parentRefresh'=> 10,
	        'messages' => array('')
	      ));
	    } else {
	      $category_id = $category->getIdentity(); //will give the primary key
	    }
	    
	    $form = $this->view->form = new Product_Form_Admin_Category();
	    $form->setAction($this->getFrontController()->getRouter()->assemble(array()));
	    $form->setField($category);
	    
	    if( !$this->getRequest()->isPost() ) {
	      // Output
	      $this->renderScript('admin-settings/form.tpl');
	      return;
	    }
	    
	    if( !$form->isValid($this->getRequest()->getPost()) ) {
	      // Output
	      $this->renderScript('admin-settings/form.tpl');
	      return;
	    }
	    
	    // Process
	    $values = $form->getValues();
	    
	    // $categoryTable = Engine_Api::_()->getItemTable('product_category');

	    $categoryTable = Engine_Api::_()->getDbtable('categories', 'product');

	    $db = $categoriesTable->getAdapter();
	    $db->beginTransaction();
	    
	    try {
	      $category->category_name = $values['label'];
	      $category->save();
	      
	      $db->commit();
	    } catch( Exception $e ) {
	      $db->rollBack();
	      throw $e;
	    }

	    return $this->_forward('success', 'utility', 'core', array(
	      'smoothboxClose' => 10,
	      'parentRefresh'=> 10,
	      'messages' => array('')
	    ));
  	}
}

?>