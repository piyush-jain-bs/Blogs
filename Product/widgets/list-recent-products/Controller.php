<?php

class Product_Widget_ListRecentProductsController extends Engine_Content_Widget_Abstract
{
  public function indexAction()
  {
    // die("asdf");
    // Should we consider creation or modified recent?
    $recentType = $this->_getParam('recentType', 'creation');
    if( !in_array($recentType, array('creation', 'modified')) ) {
      $recentType = 'creation';

    }
    $this->view->recentType = $recentType;
    $this->view->recentCol = $recentCol = $recentType . '_date';
    $params = array('search' => true);

    // Get paginator
    $table = Engine_Api::_()->getItemTable('product');
    $select = $table->getItemsSelect($params);
    $select->where('draft = ?', 0);

    if( $recentType == 'creation' ) {
      $select->order('product_id DESC');
    } else {
      $select->order($recentCol . ' DESC');
    }

    $authorisedSelect = $table->getAuthorisedSelect($select);
    $this->view->paginator = $paginator = Zend_Paginator::factory($authorisedSelect);

    // Set item count per page and current page number
    $paginator->setItemCountPerPage($this->_getParam('itemCountPerPage', 4));
    $paginator->setCurrentPageNumber($this->_getParam('page', 1));

    // Hide if nothing to show
    if( $paginator->getTotalItemCount() <= 0 ) {
      return $this->setNoRender();
    }
  }
}