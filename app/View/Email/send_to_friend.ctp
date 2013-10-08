				
					<!-- Button to trigger modal -->
<a href="#modal-sendToFriend" role="button" class="btn" data-toggle="modal">Envoyer à un ami</a>
 <style >
 .required:after{
 content:" *";
 color:red;
 }
 </style>
 
<!-- Modal -->
<div id="modal-sendToFriend" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="Envoyer à un ami" aria-hidden="true">
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
		<?php echo $this->Form->input('Email.message', array('label'=>array('class'=>'control-label required','text'=>'Votre message'),'placeholder'=>'Message','type'=>'textarea'));?>	
		<?php echo $this->Form->hidden('Email.url', array('value'=>Router::url(null, true)));?>	
		<?php echo $this->Form->hidden('Email.subject', array('value'=>'Ric web : un ami vous envoie un lien'));?>	
	  </div>
	  <div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Annuler</button>
		<?php echo $this->Form->button('envoyer' ,array('type'=>'submit','class'=>'btn btn-primary')); ?> 		
	  </div>
	<?php echo $this->Form->end() ;?>
	</div>
</div>