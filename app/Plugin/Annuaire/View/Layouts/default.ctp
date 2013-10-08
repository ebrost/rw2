<?php $this->extend('/Common/layout');?>

<?php $this->append('script');?>
<?php echo $this->Html->script('Annuaire.global'); ?>
<script>
jsBase= "<?php echo $this->Html->url('/annuaire',true); ?>";
</script>

<?php $this->end();?>

<?php echo $this->fetch('content');?>
