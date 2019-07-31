<ul class="products_browse">
  <?php foreach( $this->paginator as $item ): ?>
    <li>
      <div class='products_browse_photo'>
        <?php echo $this->htmlLink($item->getHref(), $this->itemBackgroundPhoto($item, 'thumb.normal')) ?>
      </div>
      <div class='products_browse_info'>
        <p class='products_browse_info_title'>
          <?php echo $this->htmlLink($item->getHref(), $item->getTitle()) ?>
        </p>
        <p class='products_browse_info_date'>
          <?php echo $this->translate('Posted');?> <?php echo $this->timestamp($item->creation_date) ?>
        </p>
        <p class='products_browse_info_blurb'>
          <?php echo $this->string()->truncate($this->string()->stripTags($item->body),270) ?>
        </p>
      </div>
    </li>
  <?php endforeach; ?>
</ul>

<?php
  // show view all link even if all are listed
  if( $this->paginator->count() > 0 ):
?>
  <?php echo $this->htmlLink($this->url(array('user_id' => Engine_Api::_()->core()->getSubject()->getIdentity()), 'product_view'), $this->translate('View All Entries'), array('class' => 'buttonlink icon_product_viewall')) ?>
<?php endif;?>