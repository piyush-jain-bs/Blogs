
<script type="text/javascript">
  var pageAction =function(page){
    $('page').value = page;
    $('filter_form').submit();
  }
</script>
  <?php if( $this->paginator->getTotalItemCount() > 0 ): ?>
    <ul class="products_browse">
      <?php foreach( $this->paginator as $item ): ?>
        <li>
          <div class='products_browse_photo'>
            <?php echo $this->htmlLink($item->getHref(), $this->itemBackgroundPhoto($item, 'thumb.normal')) ?>
          </div>
          <div class='products_browse_options'>
            <?php echo $this->htmlLink(array(
              'action' => 'edit',
              'product_id' => $item->getIdentity(),
              'route' => 'product_specific',
              'reset' => true,
            ), $this->translate('Edit Entry'), array(
              'class' => 'buttonlink icon_product_edit',
            )) ?>
            <?php
            echo $this->htmlLink(array('route' => 'default', 'module' => 'product', 'controller' => 'index', 'action' => 'delete', 'product_id' => $item->getIdentity(), 'format' => 'smoothbox'), $this->translate('Delete Entry'), array(
              'class' => 'buttonlink smoothbox icon_product_delete'
            ));
            ?>
          </div>
          <div class='products_browse_info'>
            <span class='products_browse_info_title'>
              <!-- <?php //echo $item;?> -->
                <h3><?php echo $this->htmlLink(array('route' => 'default', 'module' => 'product', 'controller' => 'index', 'action' => 'view', 'product_id' => $item->getIdentity()), $item->getTitle()) ?></h3>
            </span>
            <p class='products_browse_info_date'>
              <?php echo $this->translate('Posted by');?>
              <?php echo $this->htmlLink($item->getOwner()->getHref(), $item->getOwner()->getTitle()) ?>
              <?php echo $this->translate('about');?>
              <?php echo $this->timestamp(strtotime($item->creation_date)) ?>
            </p>
            <div class="stat_info">
            <?php if( $item->comment_count > 0 || $item->like_count > 0 ) :?>
              <i class="fa fa-bar-chart"></i>
            <?php endif; ?>
              <?php if( $item->comment_count > 0 ) :?>
                <span>
                  <?php echo $this->translate(array('%s Comment', '%s Comments', $item->comment_count), $this->locale()->toNumber($item->comment_count)) ?>
                </span>
              <?php endif; ?>
              <?php if( $item->like_count > 0 ) :?>
                <span>
                  <?php echo $this->translate(array('%s Like', '%s Likes', $item->like_count), $this->locale()->toNumber($item->like_count)) ?>
                </span>
              <?php endif; ?>
              <?php if( $item->view_count > 0 ) :?>
                <span class="views_product">
                  <?php echo $this->translate(array('%s View', '%s Views', $item->view_count), $this->locale()->toNumber($item->view_count)) ?>
                </span>
              <?php endif; ?>
            </div>
            <p class='products_browse_info_blurb'>
              <?php $readMore = ' ' . $this->translate('Read More') . '...';?>
              <?php echo $this->string()->truncate($this->string()->stripTags($item->body), 180, $this->htmlLink($item->getHref(), $readMore) ) ?>
            </p>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>

  <?php elseif($this->search): ?>
    <div class="tip">
      <span>
        <?php echo $this->translate('You do not have any product entries that match your search criteria.');?>
      </span>
    </div>
  <?php else: ?>
    <div class="tip">
      <span>
        <?php echo $this->translate('You do not have any product entries.');?>
        <?php if( $this->canCreate ): ?>
          <?php echo $this->translate('Get started by %1$swriting%2$s a new entry.', '<a href="'.$this->url(array('action' => 'create'), 'product_general').'">', '</a>'); ?>
        <?php endif; ?>
      </span>
    </div>
  <?php endif; ?>

  <?php echo $this->paginationControl($this->paginator, null, null, array(
    'pageAsQuery' => true,
    'query' => $this->formValues,
    //'params' => $this->formValues,
  )); ?>


<script type="text/javascript">
  $$('.core_main_product').getParent().addClass('active');
</script>
