<?php $this->extend('/Common/viewWithMenu');?>
<?php $this->Html->css('Annuaire.annuaire', null, array('inline' => false));?>

<?php $this->start('content-top');?>
	<?php echo $this->element('searchForm') ;?>
<?php $this->end();?>

<?php 
if (!empty($fichesactivites)){
	$this->start('map');
?>
<?php echo $this->element('googleMap',array('items'=>$fichesactivites)) ;?>
<?php
$this->end();
}
?>
<!--content: pas besoin de fetch -->
<?php echo $this->element('paginatedResults') ;?>


