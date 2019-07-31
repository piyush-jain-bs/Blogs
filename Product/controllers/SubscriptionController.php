<?php

class Product_SubscriptionController extends Core_Controller_Action_Standard
{
  public function init()
  {
    // Get viewer
    $viewer = Engine_Api::_()->user()->getViewer();

    // only show to member_level if authorized
    if( !$this->_helper->requireAuth()->setAuthParams('product', $viewer, 'view')->isValid() ) {
      return;
    }

    // Get subject
    if( ($product_id = $this->_getParam('product_id')) &&
        ($product = Engine_Api::_()->getItem('product', $product_id)) instanceof Product_Model_Product ) {
      $subject = $product->getOwner('user');
      Engine_Api::_()->core()->setSubject($subject);
    } else if( ($user_id = $this->_getParam('user_id')) &&
        ($user = Engine_Api::_()->getItem('user', $user_id)) instanceof User_Model_User ) {
      $subject = $user;
      Engine_Api::_()->core()->setSubject($subject);
    } else {
      $subject = null;
    }

    // Must have a subject
    if( !$this->_helper->requireSubject()->isValid() ) {
      return;
    }

    // Must be allowed to view this member
    if( !$this->_helper->requireAuth()->setAuthParams($subject, $viewer, 'view')->isValid() ) {
      return;
    }
  }

  public function addAction()
  {
    // Must have a viewer
    if( !$this->_helper->requireUser()->isValid() ) {
      return;
    }

    // Get viewer and subject
    $viewer = Engine_Api::_()->user()->getViewer();
    $user = Engine_Api::_()->core()->getSubject('user');

    // Get subscription table
    $subscriptionTable = Engine_Api::_()->getDbtable('subscriptions', 'product');

    // Check if they are already subscribed
    if( $subscriptionTable->checkSubscription($user, $viewer) ) {
      $this->view->status = true;
      $this->view->message = Zend_Registry::get('Zend_Translate')
          ->_('You are already subscribed to this member\'s product.');

      return $this->_forward('success' ,'utility', 'core', array(
        'parentRefresh' => true,
        'messages' => array($this->view->message)
      ));
    }

    // Make form
    $this->view->form = $form = new Core_Form_Confirm(array(
      'title' => 'Subscribe?',
      'description' => 'Would you like to subscribe to this member\'s product?',
      'class' => 'global_form_popup',
      'submitLabel' => 'Subscribe',
      'cancelHref' => 'javascript:parent.Smoothbox.close();',
    ));

    // Check method
    if( !$this->getRequest()->isPost() ) {
      return;
    }

    // Check valid
    if( !$form->isValid($this->getRequest()->getPost()) ) {
      return;
    }


    // Process
    $db = $user->getTable()->getAdapter();
    $db->beginTransaction();

    try {
      $subscriptionTable->createSubscription($user, $viewer);
      $db->commit();
    } catch( Exception $e ) {
      $db->rollBack();
      throw $e;
    }

    // Success
    $this->view->status = true;
    $this->view->message = Zend_Registry::get('Zend_Translate')
        ->_('You are now subscribed to this member\'s product.');

    return $this->_forward('success' ,'utility', 'core', array(
      'parentRefresh' => true,
      'messages' => array($this->view->message)
    ));
  }

  public function removeAction()
  {
    // Must have a viewer
    if( !$this->_helper->requireUser()->isValid() ) {
      return;
    }

    // Get viewer and subject
    $viewer = Engine_Api::_()->user()->getViewer();
    $user = Engine_Api::_()->core()->getSubject('user');

    // Get subscription table
    $subscriptionTable = Engine_Api::_()->getDbtable('subscriptions', 'product');

    // Check if they are already not subscribed
    if( !$subscriptionTable->checkSubscription($user, $viewer) ) {
      $this->view->status = true;
      $this->view->message = Zend_Registry::get('Zend_Translate')
          ->_('You are already not subscribed to this member\'s product.');

      return $this->_forward('success' ,'utility', 'core', array(
        'parentRefresh' => true,
        'messages' => array($this->view->message)
      ));
    }

    // Make form
    $this->view->form = $form = new Core_Form_Confirm(array(
      'title' => 'Unsubscribe?',
      'description' => 'Would you like to unsubscribe from this member\'s product?',
      'class' => 'global_form_popup',
      'submitLabel' => 'Unsubscribe',
      'cancelHref' => 'javascript:parent.Smoothbox.close();',
    ));

    // Check method
    if( !$this->getRequest()->isPost() ) {
      return;
    }

    // Check valid
    if( !$form->isValid($this->getRequest()->getPost()) ) {
      return;
    }


    // Process
    $db = $user->getTable()->getAdapter();
    $db->beginTransaction();

    try {
      $subscriptionTable->removeSubscription($user, $viewer);
      $db->commit();
    } catch( Exception $e ) {
      $db->rollBack();
      throw $e;
    }


    // Success
    $this->view->status = true;
    $this->view->message = Zend_Registry::get('Zend_Translate')
        ->_('You are no longer subscribed to this member\'s product.');

    return $this->_forward('success' ,'utility', 'core', array(
      'parentRefresh' => true,
      'messages' => array($this->view->message)
    ));
  }
}