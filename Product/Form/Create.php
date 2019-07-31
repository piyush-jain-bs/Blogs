<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Product
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.com/license/
 * @version    $Id: Create.php 10168 2014-04-17 16:29:36Z andres $
 * @author     Jung
 */

/**
 * @category   Application_Extensions
 * @package    Product
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.com/license/
 */
class Product_Form_Create extends Engine_Form
{
  public $_error = array();

  public function init()
  {   
    $this->setTitle('Write New Entry')
      ->setDescription('Compose your new product entry below, then click "Post Entry" to publish the entry to your product.')
      ->setAttrib('name', 'products_create');
    $user = Engine_Api::_()->user()->getViewer();
    $userLevel = Engine_Api::_()->user()->getViewer()->level_id;

    $this->addElement('Text', 'title', array(
      'label' => 'Title',
      'allowEmpty' => false,
      'required' => true,
      'filters' => array(
        new Engine_Filter_Censor(),
        'StripTags',
        new Engine_Filter_StringLength(array('max' => '63'))
      ),
      'autofocus' => 'autofocus',
    ));
    
    // init to
    $this->addElement('Text', 'tags', array(
      'label'=>'Tags (Keywords)',
      'autocomplete' => 'off',
      'description' => 'Separate tags with commas.',
      'filters' => array(
        'StripTags',
        new Engine_Filter_Censor(),
      ),
    ));
    $this->tags->getDecorator("Description")->setOption("placement", "append");
    
    // prepare categories
    $categories = Engine_Api::_()->getDbtable('categories', 'product')->getCategoriesAssoc();
    if( count($categories) > 0 ) {
      $this->addElement('Select', 'category_id', array(
        'label' => 'Category',
        'multiOptions' => $categories,
      ));
    }
    
    $this->addElement('Select', 'draft', array(
      'label' => 'Status',
      'multiOptions' => array("0"=>"Published", "1"=>"Saved As Draft"),
      'description' => 'If this entry is published, it cannot be switched back to draft mode.'
    ));
    $this->draft->getDecorator('Description')->setOption('placement', 'append');

    $allowedHtml = Engine_Api::_()->authorization()->getPermission($userLevel, 'product', 'auth_html');
    $uploadUrl = "";
    
    if( Engine_Api::_()->authorization()->isAllowed('album', $user, 'create') ) {
      $uploadUrl = Zend_Controller_Front::getInstance()->getRouter()->assemble(array('action' => 'upload-photo'), 'product_general', true);
    }

    $editorOptions = array(
      'uploadUrl' => $uploadUrl,
      'html' => (bool) $allowedHtml,
    );

    $this->addElement('TinyMce', 'body', array(
      'disableLoadDefaultDecorators' => true,
      'required' => true,
      'allowEmpty' => false,
      'decorators' => array(
        'ViewHelper'
      ),
      'editorOptions' => $editorOptions,
      'filters' => array(
        new Engine_Filter_Censor(),
        new Engine_Filter_Html(array('AllowedTags' => $allowedHtml))),
    ));

    $this->addElement('File', 'photo', array(
      'label' => 'Choose Profile Photo',
    ));
    $this->photo->addValidator('Extension', false, 'jpg,png,gif,jpeg');

    $this->addElement('Checkbox', 'search', array(
      'label' => 'Show this product entry in search results',
      'value' => 1,
    ));

    $availableLabels = array(
      'everyone'            => 'Everyone',
      'registered'          => 'All Registered Members',
      'owner_network'       => 'Friends and Networks',
      'owner_member_member' => 'Friends of Friends',
      'owner_member'        => 'Friends Only',
      'owner'               => 'Just Me'
    );

    // Element: auth_view
    $viewOptions = (array) Engine_Api::_()->authorization()->getAdapter('levels')->getAllowed('product', $user, 'auth_view');
    $viewOptions = array_intersect_key($availableLabels, array_flip($viewOptions));

    if( !empty($viewOptions) && count($viewOptions) >= 1 ) {
      // Make a hidden field
      if( count($viewOptions) == 1 ) {
        $this->addElement('hidden', 'auth_view', array( 'order' => 101, 'value' => key($viewOptions)));
      // Make select box
      } else {
        $this->addElement('Select', 'auth_view', array(
            'label' => 'Privacy',
            'description' => 'Who may see this product entry?',
            'multiOptions' => $viewOptions,
            'value' => key($viewOptions),
        ));
        $this->auth_view->getDecorator('Description')->setOption('placement', 'append');
      }
    }

    // Element: auth_comment
    $commentOptions = (array) Engine_Api::_()->authorization()->getAdapter('levels')->getAllowed('product', $user, 'auth_comment');
    $commentOptions = array_intersect_key($availableLabels, array_flip($commentOptions));

    if( !empty($commentOptions) && count($commentOptions) >= 1 ) {
      // Make a hidden field
      if( count($commentOptions) == 1 ) {
        $this->addElement('hidden', 'auth_comment', array('order' => 102, 'value' => key($commentOptions)));
      // Make select box
      } else {
        $this->addElement('Select', 'auth_comment', array(
            'label' => 'Comment Privacy',
            'description' => 'Who may post comments on this product entry?',
            'multiOptions' => $commentOptions,
            'value' => key($commentOptions),
        ));
        $this->auth_comment->getDecorator('Description')->setOption('placement', 'append');
      }
    }
    
    $this->addElement('Hash', 'token', array(
      'timeout' => 3600,
    ));

    // Element: submit
    $this->addElement('Button', 'submit', array(
      'label' => 'Post Entry',
      'type' => 'submit',
    ));
  }
  
  public function postEntry()
  {
    $values = $this->getValues();
    
    $user = Engine_Api::_()->user()->getViewer();
    $title = $values['title'];
    $body = $values['body'];
    $category_id = $values['category_id'];
    $tags = preg_split('/[,]+/', $values['tags']);

    $db = Engine_Db_Table::getDefaultAdapter();
    $db->beginTransaction();
    try {
      // Transaction
      $table = Engine_Api::_()->getDbtable('products', 'product');

      // insert the product entry into the database
      $row = $table->createRow();
      $row->owner_id   =  $user->getIdentity();
      $row->owner_type = $user->getType();
      $row->category_id = $category_id;
      $row->creation_date = date('Y-m-d H:i:s');
      $row->modified_date   = date('Y-m-d H:i:s');
      $row->title   = $title;
      $row->body   = $body;
      //$row->category_id = $category_id;
      $row->save();

      $productId = $row->product_id;

      if( $tags ) {
        $this->handleTags($productId, $tags);
      }

      $attachment = Engine_Api::_()->getItem($row->getType(), $productId);
      $action = Engine_Api::_()->getDbtable('actions', 'activity')->addActivity($user, $row, 'product_new');
      Engine_Api::_()->getDbtable('actions', 'activity')->attachActivity($action, $attachment);
      $db->commit();
    } catch( Exception $e ) {
      $db->rollBack();
      throw $e;
    }
  }

  public function handleTags($productId, $tags)
  {
    $tagTable = Engine_Api::_()->getDbtable('tags', 'product');
    $tabMapTable = Engine_Api::_()->getDbtable('tagmaps', 'product');
    $tagDup = array();
    foreach( $tags as $tag ) {

      $tag = htmlspecialchars((trim($tag)));
      if( !in_array($tag, $tagDup) && $tag !="" && strlen($tag) <  20 ) {
        $tagId = $this->checkTag($tag);
        // check if it is new. if new, createnew tag. else, get the tag_id and insert
        if( !$tagId ) {
          $tagId = $this->createNewTag($tag, $productId, $tagTable);
        }

        $tabMapTable->insert(array(
          'product_id' => $productId,
          'tag_id' => $tagId
        ));
        $tagDup[] = $tag;
      }
      if( strlen($tag) >= 20 ) {
        $this->_error[] = $tag;
      }
    }
  }

  public function checkTag($text)
  {
    $table = Engine_Api::_()->getDbtable('tags', 'product');
    $select = $table->select()->order('text ASC')->where('text = ?', $text);
    $results = $table->fetchRow($select);
    $tagId = "";
    if( $results ) $tagId = $results->tag_id;
    return $tagId;
  }

  public function createNewTag($text, $productId, $tagTable)
  {
    $row = $tagTable->createRow();
    $row->text =  $text;
    $row->save();
    $tagId = $row->tag_id;

    return $tagId;
  }
}
