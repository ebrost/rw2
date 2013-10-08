<?php $this->set('title_for_layout', 'Administration');?>

<div class="row-fluid show-grid">
	<div class="span9">
		<?php echo $this->fetch('content-top'); ?>
		<div class="row-fluid" id="content">
			<?php echo $this->fetch('content'); ?>
		</div>
	</div>
	<div class="span3">
		<?php $this->start('menu');?>	
		<?php echo $this->element('login'); ?>
		<?php //echo $this->element('admin_menu'); ?>
		<?php $this->end();?>
		
		<?php echo $this->fetch('menu');?>	
		
		
	</div>
</div>
