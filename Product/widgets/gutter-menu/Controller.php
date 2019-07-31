<?php
class Product_Widget_GutterMenuController extends Engine_Content_Widget_Abstract
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
    
    // Get navigation
    $this->view->gutterNavigation = $gutterNavigation = Engine_Api::_()->getApi('menus', 'core')
      ->getNavigation('product_gutter');
  }
}
