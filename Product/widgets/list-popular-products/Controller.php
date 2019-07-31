<?php

class Product_Widget_ListPopularProductsController extends Engine_Content_Widget_Abstract
{
  public function indexAction()
  {
    // Should we consider views or comments popular?
    $popularType = $this->_getParam('popularType', 'view');
    if( !in_array($popularType, array('comment', 'view')) ) {
      $popularType = 'view';
    }
    $this->view->popularType = $popularType;
    $this->view->popularCol = $popularCol = $popularType . '_count';
    $params = array('search' => true);

    // Get paginator
    $table = Engine_Api::_()->getItemTable('product');
    $select = $table->getItemsSelect($params);
    $select->where('draft = ?', 0)
      ->order($popularCol . ' DESC');

    $authorisedSelect = $table->getAuthorisedSelect($select);
    $this->view->paginator = $paginator = Zend_Paginator::factory($authorisedSelect);

    // Set item count per page and current page number
    $paginator->setItemCountPerPage($this->_getParam('itemCountPerPage', 5));
    $paginator->setCurrentPageNumber($this->_getParam('page', 1));

    // Hide if nothing to show
    if( $paginator->getTotalItemCount() <= 0 ) {
      return $this->setNoRender();
    }
  }
}