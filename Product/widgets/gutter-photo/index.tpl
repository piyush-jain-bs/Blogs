
<?php
  $photoClass = 'products_gutter_photo';

  if( $this->product && $this->product->photo_id ):
    // product photo
    echo $this->htmlLink($this->product->getHref(),
    $this->itemPhoto($this->product),
    array('class' => $photoClass));

    $ownerPhoto = $this->itemPhoto($this->owner, 'thumb.icon');
    $photoClass = 'products_owner_icon';
  endif;

  if( !isset($ownerPhoto) ):
    $ownerPhoto = $this->itemPhoto($this->owner);
  endif;

  // owner photo
  echo $this->htmlLink($this->owner->getHref(),
  $ownerPhoto,
  array('class' => $photoClass));

  echo $this->htmlLink($this->owner->getHref(),
  $this->owner->getTitle(),
  array('class' => 'products_gutter_name'));
