<?php
	$thumbnail = $this->PhpThumb->generate(
		array(
			'save_path' => WWW_ROOT . 'thumbs',
			'display_path' => '/thumbs',
			'error_image_path' => '/img/noimage.gif', 
			'src' => WWW_ROOT . 'medias/'.$imgThumb ,
													
			'w' => $imgWidth, 
			'h' => $imgHeight,
			'q' => 90,
			'zc' => 1
		)
	);
?>
<?php // echo $this->Html->image($thumbnail['src'], array('class'=>'rounded', 'width' => $thumbnail['w'], 'height' => $thumbnail['h'])); ?>
<?php  echo $this->Html->image($thumbnail['src'], array('class'=>'rounded')); ?>