<div class="row-fluid show-grid">
	<div class="span9">
		<?php echo $this->fetch('content-top'); ?>
	</div>
	<div class="span3">
		<?php $this->start('menu');?>
		<?php echo $this->element('login'); ?>
		<?php $this->end();?>
		<?php echo $this->fetch('menu'); ?>
	</div>
</div>
<div class="row-fluid" id="content">
	<div class="span9">
		<?php echo $this->fetch('content'); ?>
	</div>
	<div class="span3">
		
		<?php echo $this->fetch('map'); ?>
		<?php echo $this->element('addToFavorite'); ?>
	</div>
</div>