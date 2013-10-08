<?php echo $this->Html->script('addToFavorite',array('block'=>'script'));?>
<div class="qbox" id="favorite">
	<h3>Ma sélection <label class="badge badge-important pull-right" id="favorite-itemsListCount"></label></h3>
	<div>
		<ol id="favorite-itemsList" class="shortlist ui-sortable">
		</ol>
		<p class="empty">Votre selection est vide.</p>
		<div class="not-empty">
			<!--<a href="javascript:void(0);" class="link" id="favorite-clear-all"><i class="icon-trash"></i> Supprimer la sélection</a>-->
			<?php echo $this->element('sendToFriend',array('linkID'=>'favorite-email','modalID'=>'list','icon_large'=>false)) ;?>				

			<?php echo $this->Html->link(' <i class="icon-adobe-pdf"></i> Version Pdf', array('action' => 'viewPdfList',),array('escape'=>false,'class'=>'link','id'=>'favorite-pdf'))?>
		</div>
	</div>
</div>