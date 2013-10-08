<!-- Button to trigger modal -->
<script>
$(function(){
Ric.sendToFriendManager('#modal-sendToFriend-<?php echo $modalID;?>')
})
</script>
<?php $icon_large=(!empty($icon_large))? 'icon-large':'';?>
<?php $linkID=(!empty($linkID))? $linkID:'';?>
<?php echo $this->Html->link('<i class="icon-envelope '.$icon_large.'"></i>  Envoyer à un ami', '#modal-sendToFriend-'.$modalID,
						array(
							'id'=>$linkID,
							'escape'=>false,
							'data-toggle'=>"modal"
							)
						)
					?>
<!-- Modal -->
<div id="modal-sendToFriend-<?php echo $modalID?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="Envoyer à un ami" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Envoyer à un ami</h3>
  </div>
  <div class="modal-bodyandfooter">
	<?php echo $this->Form->create('Email',array('plugin'=>false,'url'=>'/Email/sendToFriend','class'=>'form-horizontal','inputDefaults' => array(
    'div' => 'control-group',
    'label' => array('class' => 'control-label'),
    'between' => '<div class="controls">',
    'after' => '</div>',
    'error' => array('attributes' => array('wrap' => 'div', 'class' => 'alert alert-error'))
) )); ?>
	  <div class="modal-body">
	
		<?php echo $this->Form->input('Email.emailFrom', array('label'=>array('class'=>'control-label required','text'=>'Votre Email'),'placeholder'=>'Votre email'));?>						
		<?php echo $this->Form->input('Email.emailTo', array('label'=>array('class'=>'control-label required','text'=>'Email de votre ami'),'placeholder'=>'Email de votre ami'));?>						
		<?php echo $this->Form->input('Email.message', array('label'=>array('class'=>'control-label','text'=>'Votre message'),'placeholder'=>'Message','type'=>'textarea'));?>	
		<?php //echo $this->Form->hidden('Email.url', array('value'=>Router::url(null, true)));?>	
		<?php echo $this->Form->hidden('Email.idList', array('value'=>$idList));?>	
		<?php echo $this->Form->hidden('Email.plugin', array('value'=>$this->request->params['plugin']));?>
		<?php echo $this->Form->hidden('Email.controller', array('value'=>$this->request->params['controller']));?>			
	  </div>
	  <div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Annuler</button>
		<?php echo $this->Form->button('envoyer' ,array('type'=>'submit','class'=>'btn btn-primary')); ?> 		
	  </div>
	<?php echo $this->Form->end() ;?>
	</div>
</div>
<!-- fin modal-->