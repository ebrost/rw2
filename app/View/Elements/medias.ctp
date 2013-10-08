 <?php echo $this->Html->script('mediaelement-and-player.min',array('block'=>'script'));?>
<?php echo $this->Html->css('mediaelementplayer', null, array('inline' => false));?>
<?php 
			  
	$audioVideoList=array_filter($mediaList,function($item){return $item['filemimetype']=="audio" || $item['filemimetype']=="video" ;});
//	$videos=array_filter($mediaList,function($item){return $item['filemimetype']=="video";});
	$otherMediaList=array_filter($mediaList,function($item){return $item['filemimetype']!="audio" && $item['filemimetype']!="video" && $item['filemimetype']!="image";});
debug($otherMediaList);
	?>	
<?php foreach($audioVideoList as $audiovideo):	?>
	<div class="well">
		<div class="media">
			<div class="pull-left">
				<?php echo $this->Html->media($audiovideo['file'],array('text'=>$audiovideo['name'].' '.$audiovideo['copyright'],'fullBase'=>true,'pathPrefix'=>'medias/','controls'));?>
			</div>
			<div class="media-body">
				<?php if(!empty($audiovideo['name'])): ?>
					<h5 class="media-heading">
						<?php echo $audiovideo['name']; ?><?php if(!empty($audiovideo['copyright'])): ?>
					<small>
						<?php echo $audiovideo['copyright']; ?>
					</small>	
				<?php endif; ?>
					</h5>
				<?php endif; ?>
	
				
			</div>	
		</div>
	</div>
<?php endforeach; ?>

<?php foreach($otherMediaList as $otherMedia):	?>
	<div class="well">
		<div class="media">
			<div class="media-body">
				<?php if(!empty($otherMedia['name'])): ?>
					<h5 class="media-heading">
						<?php echo $this->Html->link('<i class="icon-download"></i> '.$otherMedia['name'],'/medias/'.$otherMedia['file'],array('escape'=>false)); ?>
						
						<?php if(!empty($otherMedia['filetype'])): ?>
														<small>(<?php echo $otherMedia['filetype']; ?>)</small>
						<?php endif; ?>
						
						<?php if(!empty($otherMedia['copyright'])): ?>
						<p><small>
								<?php echo $otherMedia['copyright']; ?>
							</small></p>
						<?php endif; ?>
						
					</h5>
				<?php endif; ?>
	
				
			</div>	
		</div>
	</div>
<?php endforeach; ?>