<?php

class Product_Widget_GutterSearchController extends Engine_Content_Widget_Abstract
{
  public function indexAction()
  {
    // Only product or user as subject
    if( Engine_Api::_()->core()->hasSubject('product') ) {
      $this->view->product = $product = Engine_Api::_()->core()->getSubject('product');
      $this->view->owner = $owner = $product->getOwner();
    } else if( Engine_Api::_()->core()->hasSubject('user') ) {
      $this->view->product = null;
      $this->view->owner = $owner = Engine_Api::_()->core()->getSubject('user');
    } else {
      return $this->setNoRender();
    }

    // Prepare data
    $productTable = Engine_Api::_()->getDbtable('products', 'product');

    // Make form
    $this->view->form = $form = new Product_Form_Search();
    $form->removeElement('show');

    // Process form
    $p = Zend_Controller_Front::getInstance()->getRequest()->getParams();
    $form->isValid($p);
    $values = $form->getValues();
    $this->view->formValues = array_filter($values);
    $values['user_id'] = $owner->getIdentity();
    $values['draft'] = "0";
    $values['visible'] = "1";
    $this->view->assign($values);
    
    // Other stuff
    $this->view->archiveList = $productTable->getArchiveList($owner);
    $this->view->userTags = Engine_Api::_()->getDbtable('tags', 'core')->getTagsByTagger('product', $owner);
    $this->view->userCategories = Engine_Api::_()->getDbtable('categories', 'product')
        ->getUserCategoriesAssoc($owner->getIdentity());
  }
}
