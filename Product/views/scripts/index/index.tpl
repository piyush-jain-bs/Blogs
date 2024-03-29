<?php 

if( $this->paginator->getTotalItemCount() > 0 ): ?>
  <ul class="products_browse">
    <?php foreach( $this->paginator as $item ): ?>
      <li>
        <div class='products_browse_photo'>
          <?php echo $this->htmlLink($item->getHref(), $this->itemBackgroundPhoto($item, 'thumb.normal')) ?>
        </div>
        <div class='products_browse_info'>
          <span class='products_browse_info_title'>
            <h3><?php echo $this->htmlLink(array('route' => 'default', 'module' => 'product', 'controller' => 'index', 'action' => 'view', 'product_id' => $item->getIdentity()), $item->getTitle()) ?></h3>
          </span>
          <p class='products_browse_info_date'>
            <?php echo $this->translate('Posted');?>
            <?php echo $this->timestamp(strtotime($item->creation_date)) ?>
            <?php echo $this->translate('by');?>
            <?php echo $this->htmlLink($item->getOwner()->getHref(), $item->getOwner()->getTitle()) ?>
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
            <?php echo $this->string()->truncate($this->string()->stripTags($item->body), 220, $this->htmlLink($item->getHref(), $readMore) ) ?>
          </p>
        </div>
      </li>
    <?php endforeach; ?>
  </ul>

<?php elseif( $this->category || $this->show == 2 || $this->search ): ?>
  <div class="tip">
    <span>
      <?php echo $this->translate('Nobody has written a product entry with that criteria.');?>
      <?php if (TRUE): // @todo check if user is allowed to create a poll ?>
        <?php echo $this->translate('Be the first to %1$swrite%2$s one!', '<a href="'.$this->url(array('action' => 'create'), 'product_general').'">', '</a>'); ?>
      <?php endif; ?>
    </span>
  </div>

<?php else:?>
  <div class="tip">
    <span>
      <?php echo $this->translate('Nobody has written a product entry yet.'); ?>
      <?php if( $this->canCreate ): ?>
        <?php echo $this->translate('Be the first to %1$swrite%2$s one!', '<a href="'.$this->url(array('action' => 'create'), 'product_general').'">', '</a>'); ?>
      <?php endif; ?>
    </span>
  </div>
<?php endif; ?>

<?php echo $this->paginationControl($this->paginator, null, null, array(
  'pageAsQuery' => true,
  'query' => $this->formValues,
  //'params' => $this->formValues,
)); ?>
