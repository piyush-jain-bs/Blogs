<?php

return array(
  array(
    'title' => 'Profile Products',
    'description' => 'Displays a member\'s product entries on their profile.',
    'category' => 'Products',
    'type' => 'widget',
    'name' => 'product.profile-products',
    'isPaginated' => true,
    'defaultParams' => array(
      'title' => 'Products',
      'titleCount' => true,
    ),
    'requirements' => array(
      'subject' => 'user',
    ),
  ),
  array(
    'title' => 'Popular Product Entries',
    'description' => 'Displays a list of most viewed product entries.',
    'category' => 'Products',
    'type' => 'widget',
    'name' => 'product.list-popular-products',
    'isPaginated' => true,
    'defaultParams' => array(
      'title' => 'Popular Product Entries',
    ),
    'requirements' => array(
      'no-subject',
    ),
    'adminForm' => array(
      'elements' => array(
        array(
          'Radio',
          'popularType',
          array(
            'label' => 'Popular Type',
            'multiOptions' => array(
              'view' => 'Views',
              'comment' => 'Comments',
            ),
            'value' => 'comment',
          )
        ),
      )
    ),
  ),
  array(
    'title' => 'Recent Product Entries',
    'description' => 'Displays a list of recently posted product entries.',
    'category' => 'Products',
    'type' => 'widget',
    'name' => 'product.list-recent-products',
    'isPaginated' => true,
    'defaultParams' => array(
      'title' => 'Recent Product Entries',
    ),
    'requirements' => array(
      'no-subject',
    ),
    'adminForm' => array(
      'elements' => array(
        array(
          'Radio',
          'recentType',
          array(
            'label' => 'Recent Type',
            'multiOptions' => array(
              'creation' => 'Creation Date',
              'modified' => 'Modified Date',
            ),
            'value' => 'creation',
          )
        ),
      )
    ),
  ),
  
  array(
    'title' => 'Product Gutter Search',
    'description' => 'Displays a search form in the product gutter.',
    'category' => 'Products',
    'type' => 'widget',
    'name' => 'product.gutter-search',
  ),
  array(
    'title' => 'Product Gutter Menu',
    'description' => 'Displays a menu in the product gutter.',
    'category' => 'Products',
    'type' => 'widget',
    'name' => 'product.gutter-menu',
  ),
  array(
    'title' => 'Product Gutter Photo',
    'description' => 'Displays owner\'s or/and product\'s photo in the product gutter.',
    'category' => 'Products',
    'type' => 'widget',
    'name' => 'product.gutter-photo',
  ),

  array(
    'title' => 'Product Browse Search',
    'description' => 'Displays a search form in the product browse page.',
    'category' => 'Products',
    'type' => 'widget',
    'name' => 'product.browse-search',
    'requirements' => array(
      'no-subject',
    ),
  ),
  array(
    'title' => 'Product Browse Menu',
    'description' => 'Displays a menu in the product browse page.',
    'category' => 'Products',
    'type' => 'widget',
    'name' => 'product.browse-menu',
    'requirements' => array(
      'no-subject',
    ),
  ),
  array(
    'title' => 'Product Browse Quick Menu',
    'description' => 'Displays a small menu in the product browse page.',
    'category' => 'Products',
    'type' => 'widget',
    'name' => 'product.browse-menu-quick',
    'requirements' => array(
      'no-subject',
    ),
  ),
  array(
    'title' => 'Product Categories',
    'description' => 'Display a list of categories for products.',
    'category' => 'Products',
    'type' => 'widget',
    'name' => 'product.list-categories',
  ),
) ?>