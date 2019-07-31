<?php

class Product_Form_Edit extends Product_Form_Create
{
  public function init()
  {
    parent::init();
    $this->setTitle('Edit Product Entry')
      ->setDescription('Edit your entry below, then click "Post Entry" to publish the entry on your product.');
    $this->submit->setLabel('Save Changes');
  }
}