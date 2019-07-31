<?php

class Product_IndexController extends Core_Controller_Action_Standard
{
  public function indexAction()
  {



     // Prepare data
    $viewer = Engine_Api::_()->user()->getViewer();

    // Permissions
    $this->view->canCreate = $this->_helper->requireAuth()->setAuthParams('product', null, 'create')->checkRequire();

    // Make form
    // Note: this code is duplicated in the product.browse-search widget
    $this->view->form = $form = new Product_Form_Search();
    $form->removeElement('draft');
    if( !$viewer->getIdentity() ) {
      $form->removeElement('show');
    }

    // Process form
    $defaultValues = $form->getValues();
    if( $form->isValid($this->_getAllParams()) ) {
      $values = $form->getValues();
    } else {
      $values = $defaultValues;
    }
    $this->view->formValues = array_filter($values);
    $values['draft'] = "0";
    $values['visible'] = "1";

    // Do the show thingy
    if( @$values['show'] == 2 ) {
      // Get an array of friend ids
      $table = Engine_Api::_()->getItemTable('user');
      $select = $viewer->membership()->getMembersSelect('user_id');
      $friends = $table->fetchAll($select);
      // Get stuff
      $ids = array();
      foreach( $friends as $friend )
      {
        $ids[] = $friend->user_id;
      }
      //unset($values['show']);
      $values['users'] = $ids;
    }

    $this->view->assign($values);

    // Get products
    $paginator = Engine_Api::_()->getItemTable('product')->getProductsPaginator($values);

    $items_per_page = Engine_Api::_()->getApi('settings', 'core')->product_page;
    $paginator->setItemCountPerPage($items_per_page);

    $this->view->paginator = $paginator->setCurrentPageNumber( $values['page'] );

    if( !empty($values['category']) ) {
      $this->view->categoryObject = Engine_Api::_()->getDbtable('categories', 'product')
          ->find($values['category'])->current();
    }

    // Render
    $this->_helper->content
        //->setNoRender()
        ->setEnabled()
        ;
  }

  public function createAction()
  {
	    if( !$this->_helper->requireUser()->isValid() ) {return;}
	    if( !$this->_helper->requireAuth()->setAuthParams('product', null, 'create')->isValid()) return;

	    // Render
	    $this->_helper->content
	        //->setNoRender()
	        ->setEnabled()
	        ;

	    // set up data needed to check quota
	    $viewer = Engine_Api::_()->user()->getViewer();
	    $values['user_id'] = $viewer->getIdentity();
	    $paginator = Engine_Api::_()->getItemTable('product')->getProductsPaginator($values);


	    $this->view->quota = $quota = Engine_Api::_()->authorization()->getPermission($viewer->level_id, 'product', 'max');

	    $this->view->current_count = $paginator->getTotalItemCount();


	    // Prepare form
	    $this->view->form = $form = new Product_Form_Create();

	    // If not post or form not valid, return
	    if( !$this->getRequest()->isPost() ) {
	      return;
	    }

	    if( !$form->isValid($this->getRequest()->getPost()) ) {
	      return;
	    }


	    // Process
	    $table = Engine_Api::_()->getItemTable('product');
	    $db = $table->getAdapter();
	    $db->beginTransaction();

	    try {
		      // Create product
		      $viewer = Engine_Api::_()->user()->getViewer();
		      $formValues = $form->getValues();

		      if( empty($formValues['auth_view']) ) {
		        $formValues['auth_view'] = 'everyone';
		      }

		      if( empty($formValues['auth_comment']) ) {
		        $formValues['auth_comment'] = 'everyone';
		      }

		      $values = array_merge($formValues, array(
		        'owner_type' => $viewer->getType(),
		        'owner_id' => $viewer->getIdentity(),
		        'view_privacy' => $formValues['auth_view'],
		      ));

		      $product = $table->createRow();
		      $product->setFromArray($values);
		      $product->save();

		      if( !empty($values['photo']) ) {
		        $product->setPhoto($form->photo);
		      }

		      // Auth
		      $auth = Engine_Api::_()->authorization()->context;
		      
		      $roles = array('owner', 'owner_member', 'owner_member_member', 'owner_network', 'registered', 'everyone');

		      $viewMax = array_search($values['auth_view'], $roles);
		      $commentMax = array_search($values['auth_comment'], $roles);


		      foreach( $roles as $i => $role ) {
		        $auth->setAllowed($product, $role, 'view', ($i <= $viewMax));
		        $auth->setAllowed($product, $role, 'comment', ($i <= $commentMax));
		      }

		      // Add tags
		      $tags = preg_split('/[,]+/', $values['tags']);
		      $product->tags()->addTagMaps($viewer, $tags);

		      // Add activity only if product is published

		      if( $values['draft'] == 0 ) {
		        $action = Engine_Api::_()->getDbtable('actions', 'activity')->addActivity($viewer, $product, 'product_new');

		        // make sure action exists before attaching the product to the activity
		        if( $action ) {
		          Engine_Api::_()->getDbtable('actions', 'activity')->attachActivity($action, $product);
		        }

		      }

		      // Send notifications for subscribers
		      Engine_Api::_()->getDbtable('subscriptions', 'product')
		          ->sendNotifications($product);

		      // Commit
		      $db->commit();

	    } catch( Exception $e ) {

		    return $this->exceptionWrapper($e, $form, $db);
	    }

	    return $this->_helper->redirector->gotoRoute(array('action' => 'manage'));
    }

    // USER SPECIFIC METHODS
    public function manageAction()
    {
	    if( !$this->_helper->requireUser()->isValid() ) return;

	    // Render
	    $this->_helper->content
	        //->setNoRender()
	        ->setEnabled()
	        ;


	    // Prepare data
	    $viewer = Engine_Api::_()->user()->getViewer();
	    $this->view->form = $form = new Product_Form_Search();
	    $this->view->canCreate = $this->_helper->requireAuth()->setAuthParams('product', null, 'create')->checkRequire();

	    $form->removeElement('show');

	    // Process form
	    $defaultValues = $form->getValues();
	    if( $form->isValid($this->_getAllParams()) ) {
	      $values = $form->getValues();
	    } else {
	      $values = $defaultValues;
	    }
	    $this->view->formValues = array_filter($values);
	    $values['user_id'] = $viewer->getIdentity();

	    // Get paginator
	    $this->view->paginator = $paginator = Engine_Api::_()->getItemTable('product')->getProductsPaginator($values);
	    $items_per_page = Engine_Api::_()->getApi('settings', 'core')->product_page;
	    $paginator->setItemCountPerPage($items_per_page);
	    $this->view->paginator = $paginator->setCurrentPageNumber( $values['page'] );
    }

    public function deleteAction()
  	{
	    $viewer = Engine_Api::_()->user()->getViewer();
	    $product = Engine_Api::_()->getItem('product', $this->getRequest()->getParam('product_id'));

	    if( !$this->_helper->requireAuth()->setAuthParams($product, null, 'delete')->isValid()) return;

	    // In smoothbox
	    $this->_helper->layout->setLayout('default-simple');

	    $this->view->form = $form = new Product_Form_Delete();

	    if( !$product ) {
	      $this->view->status = false;
	      $this->view->error = Zend_Registry::get('Zend_Translate')->_("Product entry doesn't exist or not authorized to delete");
	      return;
	    }

	    if( !$this->getRequest()->isPost() ) {
	      $this->view->status = false;
	      $this->view->error = Zend_Registry::get('Zend_Translate')->_('Invalid request method');
	      return;
	    }

	    $db = $product->getTable()->getAdapter();

	    $db->beginTransaction();

	    try {
	      $product->delete();

	      $db->commit();
	    } catch( Exception $e ) {
	      $db->rollBack();
	      throw $e;
	    }

	    $this->view->status = true;
	    $this->view->message = Zend_Registry::get('Zend_Translate')->_('Your product entry has been deleted.');
	    return $this->_forward('success' ,'utility', 'core', array(
	      'parentRedirect' => Zend_Controller_Front::getInstance()->getRouter()->assemble(array('action' => 'manage'), 'product_general', true),
	      'messages' => Array($this->view->message)
	    ));
  	}

  	public function editAction()
  	{
	    if( !$this->_helper->requireUser()->isValid() ) return;

	    $viewer = Engine_Api::_()->user()->getViewer();
	    $product = Engine_Api::_()->getItem('product', $this->_getParam('product_id'));
	    if( !Engine_Api::_()->core()->hasSubject('product') ) {
	      Engine_Api::_()->core()->setSubject($product);
	    }

	    if( !$this->_helper->requireSubject()->isValid() ) return;
	    if( !$this->_helper->requireAuth()->setAuthParams($product, $viewer, 'edit')->isValid() ) return;

	    // Get navigation
	    $this->view->navigation = $navigation = Engine_Api::_()->getApi('menus', 'core')
	      ->getNavigation('product_main');

	    // Prepare form
	    $this->view->form = $form = new Product_Form_Edit();

	    // Populate form
	    $form->populate($product->toArray());

	    $tagStr = '';
	    foreach( $product->tags()->getTagMaps() as $tagMap ) {
	      $tag = $tagMap->getTag();
	      if( !isset($tag->text) ) continue;
	      if( '' !== $tagStr ) $tagStr .= ', ';
	      $tagStr .= $tag->text;
	    }
	    $form->populate(array(
	      'tags' => $tagStr,
	    ));
	    $this->view->tagNamePrepared = $tagStr;

	    $auth = Engine_Api::_()->authorization()->context;
	    $roles = array('owner', 'owner_member', 'owner_member_member', 'owner_network', 'registered', 'everyone');

	    foreach( $roles as $role ) {
	      if ($form->auth_view){
	        if( $auth->isAllowed($product, $role, 'view') ) {
	         $form->auth_view->setValue($role);
	        }
	      }

	      if ($form->auth_comment){
	        if( $auth->isAllowed($product, $role, 'comment') ) {
	          $form->auth_comment->setValue($role);
	        }
	      }
	    }

	    // hide status change if it has been already published
	    if( $product->draft == "0" ) {
	      $form->removeElement('draft');
	    }


	    // Check post/form
	    if( !$this->getRequest()->isPost() ) {
	      return;
	    }
	    if( !$form->isValid($this->getRequest()->getPost()) ) {
	      return;
	    }


	    // Process
	    $db = Engine_Db_Table::getDefaultAdapter();
	    $db->beginTransaction();

	    try {
	      $values = $form->getValues();

	      if( empty($values['auth_view']) ) {
	        $values['auth_view'] = 'everyone';
	      }
	      if( empty($values['auth_comment']) ) {
	        $values['auth_comment'] = 'everyone';
	      }

	      $values['view_privacy'] = $values['auth_view'];

	      $product->setFromArray($values);
	      $product->modified_date = date('Y-m-d H:i:s');
	      $product->save();

	      // Add photo
	      if( !empty($values['photo']) ) {
	        $product->setPhoto($form->photo);
	      }

	      // Auth
	      $viewMax = array_search($values['auth_view'], $roles);

	      $commentMax = array_search($values['auth_comment'], $roles);

	      foreach( $roles as $i => $role ) {

	        $auth->setAllowed($product, $role, 'view', ($i <= $viewMax));
	        $auth->setAllowed($product, $role, 'comment', ($i <= $commentMax));
	      }

	      // handle tags
	      $tags = preg_split('/[,]+/', $values['tags']);
	      $product->tags()->setTagMaps($viewer, $tags);

	      // insert new activity if product is just getting published
	      $action = Engine_Api::_()->getDbtable('actions', 'activity')->getActionsByObject($product);
	      if( count($action->toArray()) <= 0 && $values['draft'] == '0' ) {
	        $action = Engine_Api::_()->getDbtable('actions', 'activity')->addActivity($viewer, $product, 'product_new');
	          // make sure action exists before attaching the product to the activity
	        if( $action != null ) {
	          Engine_Api::_()->getDbtable('actions', 'activity')->attachActivity($action, $product);
	        }
	      }

	      // Rebuild privacy
	      $actionTable = Engine_Api::_()->getDbtable('actions', 'activity');
	      foreach( $actionTable->getActionsByObject($product) as $action ) {
	        $actionTable->resetActivityBindings($action);
	      }

	      // Send notifications for subscribers
	      Engine_Api::_()->getDbtable('subscriptions', 'product')
	          ->sendNotifications($product);

	      $db->commit();

	    }
	    catch( Exception $e ) {
	      $db->rollBack();
	      throw $e;
	    }

	    return $this->_helper->redirector->gotoRoute(array('action' => 'manage'));
  	}

  	public function viewAction()
  	{

  		$this->_helper->user2()->user3();
	    // Check permission

	    $viewer = Engine_Api::_()->user()->getViewer();

	    $product = Engine_Api::_()->getItem('product', $this->_getParam('product_id'));

	    if( $product ) {
	      Engine_Api::_()->core()->setSubject($product);
	    }

	    if( !$this->_helper->requireSubject()->isValid() ) {
	      return;
	    }
	    if( !$this->_helper->requireAuth()->setAuthParams($product, $viewer, 'view')->isValid() ) {
	      return;
	    }
	    if( !$product || !$product->getIdentity() ||
	        ($product->draft && !$product->isOwner($viewer)) ) {
	      return $this->_helper->requireSubject->forward();
	    }

	    // Prepare data
	    $productTable = Engine_Api::_()->getDbtable('products', 'product');

	    if (strpos($product->body, '<') === false) {
	        $product->body = nl2br($product->body);
	    }

	    $this->view->product = $product;
	    $this->view->owner = $owner = $product->getOwner();
	    $this->view->viewer = $viewer;

	    if( !$product->isOwner($viewer) ) {
	      $productTable->update(array(
	        'view_count' => new Zend_Db_Expr('view_count + 1'),
	      ), array(
	        'product_id = ?' => $product->getIdentity(),
	      ));
	    }

	    // Get tags
	    $this->view->productTags = $product->tags()->getTagMaps();

	    // Get category
	    if( !empty($product->category_id) ) {
	      $this->view->category = Engine_Api::_()->getDbtable('categories', 'product')
	          ->find($product->category_id)->current();
	    }

	    // Get styles
	    $table = Engine_Api::_()->getDbtable('styles', 'core');
	    $style = $table->select()
	      ->from($table, 'style')
	      ->where('type = ?', 'user_product')
	      ->where('id = ?', $owner->getIdentity())
	      ->limit(1)
	      ->query()
	      ->fetchColumn();
	    if( !empty($style) ) {
	      try {
	        $this->view->headStyle()->appendStyle($style);
	      }
	      // silence any exception, exceptin in development mode
	      catch (Exception $e) {
	        if (APPLICATION_ENV === 'development') {
	          throw $e;
	        }
	      }
	    }

	    // Render
	    $this->_helper->content
	        //->setNoRender()
	        ->setEnabled()
	        ;
  	}

  	public function listAction()
  	{
	    // Preload info
	    $this->view->viewer = $viewer = Engine_Api::_()->user()->getViewer();
	    $this->view->owner = $owner = Engine_Api::_()->getItem('user', $this->_getParam('user_id'));
	    Engine_Api::_()->core()->setSubject($owner);

	    if( !$this->_helper->requireSubject()->isValid() ) {
	      return;
	    }


	    // Make form
	    $form = new Product_Form_Search();
	    // Process form
	    $defaultValues = $form->getValues();
	    if( $form->isValid($this->getRequest()->getParams()) ) {
	      $values = $form->getValues();
	    } else {
	      $values = $defaultValues;
	    }
	    $this->view->formValues = array_filter($values);
	    $values['user_id'] = $owner->getIdentity();

	    // Prepare data
	    $productTable = Engine_Api::_()->getDbtable('products', 'product');

	    // Get paginator
	    $this->view->paginator = $paginator = Engine_Api::_()->getItemTable('product')->getproductsPaginator($values);
	    $items_per_page = Engine_Api::_()->getApi('settings', 'core')->product_page;
	    $paginator->setItemCountPerPage($items_per_page);
	    $this->view->paginator = $paginator->setCurrentPageNumber( $values['page'] );

	    // Render
	    $this->_helper->content
	        //->setNoRender()
	        ->setEnabled()
	        ;
  	}

 	public function styleAction()
  	{
	    if( !$this->_helper->requireUser()->isValid() ) return;
	    if( !$this->_helper->requireAuth()->setAuthParams('product', null, 'style')->isValid()) return;

	    // In smoothbox
	    $this->_helper->layout->setLayout('default-simple');

	    // Require user
	    if( !$this->_helper->requireUser()->isValid() ) return;
	    $user = Engine_Api::_()->user()->getViewer();

	    // Make form
	    $this->view->form = $form = new Product_Form_Style();

	    // Get current row
	    $table = Engine_Api::_()->getDbtable('styles', 'core');
	    $select = $table->select()
	      ->where('type = ?', 'user_product') // @todo this is not a real type
	      ->where('id = ?', $user->getIdentity())
	      ->limit(1);

	    $row = $table->fetchRow($select);

	    // Check post
	    if( !$this->getRequest()->isPost() )
	    {
	      $form->populate(array(
	        'style' => ( null === $row ? '' : $row->style )
	      ));
	      return;
	    }

	    if( !$form->isValid($this->getRequest()->getPost()) )
	    {
	      return;
	    }

	    // Cool! Process
	    $style = $form->getValue('style');

	    // Save
	    if( null == $row )
	    {
	      $row = $table->createRow();
	      $row->type = 'user_product'; // @todo this is not a real type
	      $row->id = $user->getIdentity();
	    }

	    $row->style = $style;
	    $row->save();

	    $this->view->draft = true;
	    $this->view->message = Zend_Registry::get('Zend_Translate')->_("Your changes have been saved.");
	    $this->_forward('success', 'utility', 'core', array(
	        'smoothboxClose' => true,
	        'parentRefresh' => false,
	        'messages' => array($this->view->message)
	    ));
  	}

 	public function uploadPhotoAction()
  	{
	    $viewer = Engine_Api::_()->user()->getViewer();

	    $this->_helper->layout->disableLayout();

	    if( !Engine_Api::_()->authorization()->isAllowed('album', $viewer, 'create') ) {
	      return false;
	    }

	    if( !$this->_helper->requireAuth()->setAuthParams('album', null, 'create')->isValid() ) return;

	    if( !$this->_helper->requireUser()->checkRequire() )
	    {
	      $this->view->status = false;
	      $this->view->error = Zend_Registry::get('Zend_Translate')->_('Max file size limit exceeded (probably).');
	      return;
	    }

	    if( !$this->getRequest()->isPost() )
	    {
	      $this->view->status = false;
	      $this->view->error = Zend_Registry::get('Zend_Translate')->_('Invalid request method');
	      return;
	    }
	    if( !isset($_FILES['userfile']) || !is_uploaded_file($_FILES['userfile']['tmp_name']) )
	    {
	      $this->view->status = false;
	      $this->view->error = Zend_Registry::get('Zend_Translate')->_('Invalid Upload');
	      return;
	    }

	    $db = Engine_Api::_()->getDbtable('photos', 'album')->getAdapter();
	    $db->beginTransaction();

	    try
	    {
	      $viewer = Engine_Api::_()->user()->getViewer();

	      $photoTable = Engine_Api::_()->getDbtable('photos', 'album');
	      $photo = $photoTable->createRow();
	      $photo->setFromArray(array(
	        'owner_type' => 'user',
	        'owner_id' => $viewer->getIdentity()
	      ));
	      $photo->save();

	      $photo->setPhoto($_FILES['userfile']);

	      $this->view->status = true;
	      $this->view->name = $_FILES['userfile']['name'];
	      $this->view->photo_id = $photo->photo_id;
	      $this->view->photo_url = $photo->getPhotoUrl();

	      $table = Engine_Api::_()->getDbtable('albums', 'album');
	      $album = $table->getSpecialAlbum($viewer, 'product');

	      $photo->album_id = $album->album_id;
	      $photo->save();

	      if( !$album->photo_id )
	      {
	        $album->photo_id = $photo->getIdentity();
	        $album->save();
	      }

	      $auth      = Engine_Api::_()->authorization()->context;
	      $auth->setAllowed($photo, 'everyone', 'view',    true);
	      $auth->setAllowed($photo, 'everyone', 'comment', true);
	      $auth->setAllowed($album, 'everyone', 'view',    true);
	      $auth->setAllowed($album, 'everyone', 'comment', true);


	      $db->commit();

	    } catch( Album_Model_Exception $e ) {
	      $db->rollBack();
	      $this->view->status = false;
	      $this->view->error = $this->view->translate($e->getMessage());
	      throw $e;
	      return;

	    } catch( Exception $e ) {
	      $db->rollBack();
	      $this->view->status = false;
	      $this->view->error = Zend_Registry::get('Zend_Translate')->_('An error occurred.');
	      throw $e;
	      return;
	    }
  	}

}
