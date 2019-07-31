<?php $this->user1();

?>
<h2>
  <?php echo $this->product->getTitle() ?>
</h2>
<ul class='products_entrylist'>
  <li>
    <div class="product_entrylist_entry_date">
      <?php echo $this->translate('Posted by');?> <?php echo $this->htmlLink($this->owner->getHref(), $this->owner->getTitle()) ?>
      <?php echo $this->timestamp($this->product->creation_date) ?>
      <?php if( $this->category ): ?>
        -
        <?php echo $this->translate('Filed in') ?>
        <a href='javascript:void(0);' onclick='javascript:categoryAction(<?php echo $this->category->category_id?>);'><?php echo $this->translate($this->category->category_name) ?></a>
      <?php endif; ?>
      <?php if (count($this->productTags )):?>
        -
        <?php foreach ($this->productTags as $tag): ?>
          <a href='javascript:void(0);' onclick='javascript:tagAction(<?php echo $tag->getTag()->tag_id; ?>);'>#<?php echo $tag->getTag()->text?></a>&nbsp;
        <?php endforeach; ?>
      <?php endif; ?>
      -
      <?php echo $this->translate(array('%s view', '%s views', $this->product->view_count), $this->locale()->toNumber($this->product->view_count)) ?>
    </div>
    <div class="product_entrylist_entry_body rich_content_body">
      <?php echo $this->product->body ?>
    </div>
  </li>
</ul>


<script type="text/javascript">
  $$('.core_main_product').getParent().addClass('active');
</script>
