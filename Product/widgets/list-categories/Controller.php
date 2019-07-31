<?php

class Product_Widget_ListCategoriesController extends Engine_Content_Widget_Abstract
{
  public function indexAction()
  {
    $this->view->categories = Engine_Api::_()->getApi('categories', 'core')
        ->getNavigation('product');
    if( count($this->view->categories) <= 1 ) {
      return $this->setNoRender();
    }
  }
}
