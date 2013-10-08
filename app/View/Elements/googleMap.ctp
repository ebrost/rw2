<div id="mapviewer" class="qbox">
<h3 id="mapswitch"><i class="icon-resize-full"></i> Agrandir la carte</h3>
<div id="mapcontainer" >
<style>
#maprefresh{
display:none;z-index:102;text-align:center;width:100%;position:absolute;background:#fff;height:400px;line-height:400px;
}

</style>
<div id="maprefresh"><i class="icon-refresh icon-spin icon-4x"></i></div>
<?php 
$model=Inflector::classify( $this->params['controller']);
echo $this->Html->script($this->GoogleMapV3->apiUrl());
$height=isset($height)? $height:'400px';
echo $this->GoogleMapV3->map(array('div'=>array('height'=>$height, 'width'=>'100%')));
debug($items);
if (isset($items[0])){
	foreach ($items as $item){
	$thumbnail=(isset($item[$model]['thumbnail']))? '<div class="thumbnail pull-left inline" style="margin-right:5px">'.$this->element('thumbnail',array('imgThumb'=>$item[$model]['thumbnail'],'imgWidth'=>60,'imgHeight'=>60)).'</div>':'';

		$this->GoogleMapV3->addMarker(
			array(
				'lat' => $item[$model]['latitude'],
				'lng' => $item[$model]['longitude'],
				//'icon'=> 'url_to_icon', // optional
				'title' => $item[$model]['nom_complet'], 
				'content' =>'<div id="info" style="width:250px;height:100px">'.$thumbnail
				.'<div class="pull-left inline" style="width:170px;">'
				.'<h6 style="margin:0 0 5px">'.$item[$model]['nom_complet'].'</h6>'
				.'<p style="margin:0;font-size:85%;line-height:100%;font-weight:normal">'
				.$item[$model]['adresse']
				.'<br/>'.$item[$model]['code_postal'].' '.$item[$model]['ville']
				.'</p></div>'
				.$this->Html->link('voir', array(
							'plugin'=>'annuaire',
							'controller' => 'ficheactivites',
							'action' => 'view',
							'id'=>$item[$model]['id'],
							'slug'=>Inflector::slug($item[$model]['nom_complet']),
							'num' =>$item[$model]['num'],
							'page'=>$this->request->params['named']['page'],
							'q'=>$q,
							'r'=>$item[$model]['relevance'],
							
							),
							array('class'=>'btn btn-mini pull-right'))
				.'</div>'
				
				
			)
		);

	}
}
else{
	$thumbnail=(isset($items[$model]['thumbnail']))? '<div class="thumbnail pull-left inline" style="margin-right:5px">'.$this->element('thumbnail',array('imgThumb'=>$items[$model]['thumbnail'],'imgWidth'=>60,'imgHeight'=>60)).'</div>':'';
		$this->GoogleMapV3->addMarker(
			array(
				'lat' => $items[$model]['latitude'],
				'lng' => $items[$model]['longitude'],
				//'icon'=> 'url_to_icon', // optional
				'title' => $items[$model]['nom_complet'], 
				'content' =>'<div id="info" style="width:250px;height:100px">'.$thumbnail
				.'<div class="pull-left inline" style="width:170px;">'
				.'<h6 style="margin:0 0 5px">'.$items[$model]['nom_complet'].'</h6>'
				.'<p style="margin:0;font-size:85%;line-height:100%;font-weight:normal">'
				.$items[$model]['adresse']
				.'<br/>'.$items[$model]['code_postal'].' '.$items[$model]['ville']
				.'</p></div>'
				.'</div>'
				
				
			)
		);


}

 echo $this->Html->scriptBlock($this->GoogleMapV3->script(),array('block'=>'script'));
?>
</div>
</div>

<script>
$(function(){
	var deployed=false;
 var googleMapViewerWidth = $("#mapviewer").width();
 var googleMapViewerHeight = $("#mapviewer").height();
 var googleMapContainerHeight = $("#mapcontainer").height();
 console.log (googleMapViewerHeight);
 var googleMapViewerLeft = $("#mapviewer").position().left;

 MapResizeCallback=function(){
console.log(map0);
	google.maps.event.trigger(map0, 'resize');
	map0.panToBounds(bounds);
    map0.fitBounds(bounds);
	if(!deployed){
		
		$('#mapswitch').html('<i class="icon-resize-full"></i> Agrandir la carte').fadeIn();
		$('#mapviewer').css({position:'relative',left:0});
		$('#maprefresh').fadeOut();
	}
	else{
		
		$('#mapswitch').html('<i class="icon-resize-small"></i>  Réduire la carte').fadeIn();
		$('#maprefresh').fadeOut();
	}
	return false;
 }
 
deployMap=function(){
$('<div />').attr('id','overlay').appendTo('body').fadeIn();
//$('#mapcontainer').hide().before('<div id="maprefresh" style="z-index:102;text-align:center;width:100%;position:absolute;background:#fff;height:'+googleMapContainerHeight*1.5+'px;line-height:'+googleMapContainerHeight*1.5+'px;"><i class="icon-refresh icon-spin icon-4x"></i></div>');
	$('#mapcontainer').hide();
	$('#maprefresh').css({'height':googleMapContainerHeight*1.5+'px','line-height':googleMapContainerHeight*1.5+'px'}).fadeIn(100);
	//$('#mapviewer');
	$('#mapcontainer').animate({height:googleMapContainerHeight*1.5});
    $('#mapviewer').css({"position":'absolute'}).animate({top:'0',left:'0',width:"100%",height:googleMapViewerHeight*1.5},1000,MapResizeCallback);
	$('#mapcontainer').show();
	$('#map_canvas').height('100%');
};

unDeployMap= function(){
	$('#maprefresh').css({'line-height':googleMapContainerHeight+'px'}).fadeIn(100);
	$('#mapcontainer').animate({height:googleMapContainerHeight});
	
	$('#overlay').fadeOut(1000,function(){$(this).remove()});
	$('#mapviewer').css({"position":'absolute'});
	
    $('#mapviewer').animate({left:googleMapViewerLeft, width:googleMapViewerWidth,height:googleMapViewerHeight},1000,MapResizeCallback);
	$('#map_canvas').height(googleMapContainerHeight);
	
	
	

};
//jquery toogle deprecated...
$('#mapswitch').click(function(){
	if(!deployed){
	 
		$('#mapswitch').html('&nbsp;');
		deployMap();
		
	}
	else{
		$('#mapswitch').html('&nbsp;');
		unDeployMap();

	}

deployed=!deployed
});
})
</script>