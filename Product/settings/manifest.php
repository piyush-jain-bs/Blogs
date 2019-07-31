<?php return array (
  'package' => 
  array (
    'type' => 'module',
    'name' => 'product',
    'version' => '4.0.0',
    'path' => 'application/modules/Product',
    'title' => 'product',
    'description' => 'this is a product based plugin',
    'author' => 'piyush',
    'callback' => 
    array (
      'class' => 'Engine_Package_Installer_Module',
    ),
    'actions' => 
    array (
      0 => 'install',
      1 => 'upgrade',
      2 => 'refresh',
      3 => 'enable',
      4 => 'disable',
    ),
    'callback' => array(
      'path' => 'application/modules/Product/settings/install.php',
      'class' => 'Product_Installer',
    ),
    'directories' => 
    array (
      0 => 'application/modules/Product',
    ),
    'files' => 
    array (
      0 => 'application/languages/en/product.csv',
    ),
  ),
    'items' => array(
    'product',
    'product_category',
  ),

      // Routes --------------------------------------------------------------------
  'routes' => array(
    // Public
    'product_specific' => array(
      'route' => 'products/:action/:product_id/*',
      'defaults' => array(
        'module' => 'product',
        'controller' => 'index',
        'action' => 'index',
      ),
      'reqs' => array(
        'product_id' => '\d+',
        'action' => '(delete|edit)',
      ),
    ),
    'product_general' => array(
      'route' => 'products/:action/*',
      'defaults' => array(
        'module' => 'product',
        'controller' => 'index',
        'action' => 'index',
      ),
      'reqs' => array(
        'action' => '(index|create|manage|style|tag|upload-photo)',
      ),
    ),
    'product_view' => array(
      'route' => 'products/:user_id/*',
      'defaults' => array(
        'module' => 'product',
        'controller' => 'index',
        'action' => 'list',
      ),
      'reqs' => array(
        'user_id' => '\d+',
      ),
    ),
    'product_entry_view' => array(
      'route' => 'products/:user_id/:product_id/:slug',
      'defaults' => array(
        'module' => 'product',
        'controller' => 'index',
        'action' => 'view',
        'slug' => '',
      ),
      'reqs' => array(
        'user_id' => '\d+',
        'product_id' => '\d+'
      ),
    ),
  ),

  

); ?>