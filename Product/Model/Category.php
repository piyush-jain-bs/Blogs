<?php

class Product_Model_Category extends Core_Model_Category
{
  protected $_searchTriggers = false;
  protected $_route = 'product_general';

  public function getTitle()
  {
    return $this->category_name;
  }
  
  public function getUsedCount()
  {
    $productTable = Engine_Api::_()->getItemTable('product');
    return $productTable->select()
        ->from($productTable, new Zend_Db_Expr('COUNT(product_id)'))
        ->where('category_id = ?', $this->category_id)
        ->query()
        ->fetchColumn();
  }

  public function isOwner($owner)
  {
    return false;
  }

  public function getOwner($recurseType = null)
  {
    return $this;
  }

  public function getHref($params = array())
  {
    return Zend_Controller_Front::getInstance()->getRouter()
            ->assemble($params, $this->_route, true) . '?category=' . $this->category_id;
  }
}
