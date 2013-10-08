<?php echo $this->Html->css('carousel', null, array('inline' => false));?>
<?php echo $this->Html->script('jquery.carouFredSel-6.2.1-packed',array('block'=>'script'));?>
<?php //echo $this->Html->script('carousel',array('block'=>'script'));?>
<style>
#carousel {                

overflow: hidden;
width:200px;
height:200px
}
#carousel-wrapper .caroufredsel_wrapper{
border:1px solid transparent;
box-shadow:none
}
.carousel-caption{
position: absolute;
right: 0;
bottom: 0;
left: 0;
padding: 5px;
background: #333333;
background: rgba(0, 0, 0, 0.5);
color:#cccccc;
font-size:1em;
}

</style>
<script>
$(function() {
	Ric.carousel({carouselID:'#carousel',thumbsID:'#thumbs'})
})

</script>
<!--debut carousel -->

					<?php 
				$imagesList=array();
				$imagesThumbs=array();
				$imagesLarges=array();
				foreach ($item['Media'] as $media){
					if ( $media['filemimetype']=='image'){
						if($media['file'] == $item['Ficheactivite']['thumbnail']){
							array_unshift($imagesList,array($media['id'],$media['affichage_liste'],$media['file'],$media['name'],$media['copyright']));
						}
						else{
						$imagesList[]=array($media['id'],$media['affichage_liste'],$media['file'],$media['name'],$media['copyright']);
						}
					}
				}
				
				
				// on reordonne le tableau pour mettre affichageListe en premier
				debug($imagesList);
				if (!empty($imagesList)){
				$selected=' class="selected"';
					foreach ($imagesList as $image){
					
						$imagesLarges.='<span id="image'.$image[0].'">'.$this->element('thumbnail',array('imgThumb'=>$image[2],'imgWidth'=>200,'imgHeight'=>200));
						$imagesLarges.=(!empty($image[3]) || !empty($image[4]) ) ? '<div class="carousel-caption">'.$image[3]:'';
						$imagesLarges.=(!empty($image[4]) ) ? ' <small>&copy; '.$image[4].'</small>':'';
						
						$imagesLarges.=(!empty($image[3]) || !empty($image[4]) ) ? '</div>':'';
						$imagesLarges.='</span>';
						$imagesThumbs.='<a href="#image'.$image[0].'"'.$selected.'>'.$this->element('thumbnail',array('imgThumb'=>$image[2],'imgWidth'=>35,'imgHeight'=>35)).'</a>';
						$selected='';
					}
					if(count($imagesList)==1)$imagesThumbs='';
					$imagesLarges='<div id="carousel-wrapper"><div id="carousel">'.$imagesLarges.'</div></div>';
					$imagesThumbs='<div id="thumbs-wrapper"><div id="thumbs">'.$imagesThumbs.'</div><a id="prev" href="#"><i class="icon-circle-arrow-left"></i></a><a id="next" href="#"><i class="icon-circle-arrow-right"></i></a></div>';
					echo $imagesLarges.$imagesThumbs;
				}
					
				?>
				
					
				<!--fin carousel -->
				