<?php $this->extend('/Common/detailViewWithMenu');?>

<?php $this->Html->css('Annuaire.annuaire', null, array('inline' => false));?>
<script>

$(function() {
  Ric.viewTabs("#tabs");
  $.ajax({
		type:'GET',
		url:jsBase+'/Ficheactivites/viewNav/<?php echo $ficheactivite['Ficheactivite']['id'];?>/<?php echo $ficheactivite['Ficheactivite']['nom_complet'];?><?php echo (isset( $this->params['named']['num']))?'/num:'.$this->params['named']['num']:'';?><?php echo (isset( $this->params['named']['page']))?'/page:'.$this->params['named']['page']:'';?><?php echo (isset( $this->params['named']['q']))?'/q:'.$this->params['named']['q']:'';?><?php echo (isset( $this->params['named']['r']))?'/r:'.$this->params['named']['r']:'';?>',
		dataType:'html',
		success:function(Response){
			$('#prevNextdetailBrowser').html(Response).fadeIn();
		}
	});
});
</script>
<?php 
if (!empty($ficheactivite)){
$this->start('map');
?>


<?php echo $this->element('googleMap',array('items'=>$ficheactivite,'height'=>200)) ;?>

<?php
$this->end();
}
?>
<?php $this->start('content-top');?>
	<div id="prevNextdetailBrowser"></div>
<?php $this->end();?>


<div class="row-fluid">
	<div class="span12">
		<div class="main_content">
			<div id="item-header">
				<h3 class="pull-left title"><?php echo $ficheactivite['Ficheactivite']['nom_complet']; ?></h3>
				<div class="tools">
					
					<?php echo $this->Html->link(' <i class="icon-adobe-pdf icon-large"></i> Version Pdf', array(
										'action' => 'view',
										'ext' => 'pdf',
										'id'=>$ficheactivite['Ficheactivite']['id'],
										'slug'=>Inflector::slug($ficheactivite['Ficheactivite']['nom_complet']),
										),
										array('escape'=>false))
					?>
					<?php echo $this->Html->link('<i class="icon-plus-sign icon-large"></i>  Ajouter à ma selection', 'javascript:void(0);',
						array(
							'escape'=>false,
							'data-content-shortlist'=>htmlspecialchars($this->element('thumbnail',array('imgThumb'=>$ficheactivite['Ficheactivite']['thumbnail'],'imgWidth'=>140,'imgHeight'=>140))).
							'<div><a href='.Router::url(null, true).'>'.$ficheactivite['Ficheactivite']['nom_complet'].'</a></div>',
							'data-id-shortlist'=>$ficheactivite['Ficheactivite']['id'],
							'class'=>'add-to-list-js')
						)
					?>
	

<?php echo $this->element('sendToFriend',array('modalID'=>'single','idList'=>$ficheactivite['Ficheactivite']['id'],'icon_large'=>true)) ;?>				
					
				</div>
			</div>
			<div class="row-fluid">
					<?php if(!empty($ficheactivite['Ficheactivite']['thumbnail'])) :?>
						<div class="span3">
							<?php echo $this->element('carousel',array('item'=>$ficheactivite)) ;?>
						</div>	
						<div class="span9">
					<?php else: ?>
						<div class="span12">
					<?php endif; ?>
					
					<adress>
		<?php if (!empty($ficheactivite['Ficheactivite']['adresse'])): ?>
			<?php echo $ficheactivite['Ficheactivite']['adresse']; ?><br />
			<?php echo $ficheactivite['Ficheactivite']['code_postal']; ?> <?php echo $ficheactivite['Ficheactivite']['ville']; ?>
		<?php endif; ?>	
	</adress>
	<ul class="unstyled">
		<?php if (!empty($ficheactivite['Ficheactivite']['telephone'])): ?>
			<li><i class="icon-phone"></i><?php echo $ficheactivite['Ficheactivite']['telephone']; ?>
				<?php if (!empty($ficheactivite['Ficheactivite']['telephone2'])): ?>
					 - <?php echo $ficheactivite['Ficheactivite']['telephone2']; ?>
				<?php endif; ?>
			
			</li>
		<?php endif; ?>
		<?php if (!empty($ficheactivite['Ficheactivite']['mobile'])): ?>
			<li><i class="icon-mobile-phone"></i><?php echo $ficheactivite['Ficheactivite']['mobile']; ?></li>
		<?php endif; ?>
		<?php if (!empty($ficheactivite['Ficheactivite']['telecopie'])): ?>
			<li><?php echo $ficheactivite['Ficheactivite']['telecopie']; ?></li>
		<?php endif; ?>
		<?php if (!empty($ficheactivite['Ficheactivite']['url_site_web'])): ?>
			<li><a href="http://<?php echo $ficheactivite['Ficheactivite']['url_site_web']; ?>" target="_blank"><i class="icon-link"></i> <?php echo $ficheactivite['Ficheactivite']['url_site_web']; ?></a></li>
		<?php endif; ?>
		<?php if (!empty($ficheactivite['Ficheactivite']['email'])): ?>
			<li><a href="mailto:<?php echo $ficheactivite['Ficheactivite']['email']; ?>" target="_blank"><i class="icon-envelope"></i>  <?php echo $ficheactivite['Ficheactivite']['email']; ?></a></li>
		<?php endif; ?>
	</ul>
	<div class="well well-small">
		<?php if (!empty($ficheactivite['Ficheactivite']['activites'])): ?>
							<p class="activites">
								<span class="label">Activité(s)</span><br><?php echo $ficheactivite['Ficheactivite']['activites']; ?>
								<?php if (!empty($ficheactivite['Ficheactivite']['precision_activites'])): ?>
								 - <?php echo $ficheactivite['Ficheactivite']['precision_activites']; ?>
								<?php endif; ?>
							</p>
		<?php endif; ?>

		<?php if (!empty($ficheactivite['Ficheactivite']['genres'])): ?>
								<p class="genre">
									<span class="label">Domaine(s)</span><br><?php echo $ficheactivite['Ficheactivite']['genres']; ?>
								</p>
		<?php endif; ?>

		<?php if (!empty($ficheactivite['Ficheactivite']['disciplines'])): ?>
								<p class="discipline">
									<span class="label">Discipline(s)</span><br><?php echo $ficheactivite['Ficheactivite']['disciplines']; ?>
								</p>
		<?php endif; ?>		
	</div>
	
 

  <ul class="nav nav-tabs" id="tabs">
    <li id="informations_generales_tab"><a href="#informations_generales">Informations générales</a></li>
    <li id="informations_complementaires_tab"><a href="#informations_complementaires">Informations complémentaires</a></li>
    <li id="medias_tab"><a href="#medias">Médias</a></li>
  </ul>
  <div class="tab-content">
  <div id="informations_generales" class="tab-pane fade">
  <?php if (!empty($ficheactivite['Ficheactivite']['commentaires'])): ?>
				<p class="commentaires">
					<?php echo nl2br($ficheactivite['Ficheactivite']['commentaires']); ?>
				</p>
			<?php endif; ?> 
			<?php if (!empty($ficheactivite['Ficheactivite']['commentaires_arts_visuels'])): ?>
				<p class="commentaires_arts_visuels">
					<span>Commentaires arts visuels : </span><?php echo nl2br($ficheactivite['Ficheactivite']['commentaires_arts_visuels']); ?>
				</p>
			<?php endif; ?>
			<?php if (!empty($ficheactivite['Ficheactivite']['commentaires_arts_visuels'])): ?>
				<p class="commentaires_audio_visuels">
					<span>Commentaires audiovisuels : </span><?php echo nl2br($ficheactivite['Ficheactivite']['commentaires_audio_visuel']); ?>
				</p>
			<?php endif; ?> 
			<?php if (!empty($ficheactivite['Ficheactivite']['commentaires_livre'])): ?>
				<p class="commentaires_livre">
					<span>Commentaires livre : </span><?php echo nl2br($ficheactivite['Ficheactivite']['commentaires_livre']); ?>
				</p>
			<?php endif; ?>
			<?php if (!empty($ficheactivite['Ficheactivite']['commentaires_patrimoine'])): ?>
				<p class="commentaires_patrimoine">
					<span>Commentaires patrimoine : </span><?php echo nl2br($ficheactivite['Ficheactivite']['commentaires_patrimoine']); ?>
				</p>
			<?php endif; ?> 
			<?php if (!empty($ficheactivite['Ficheactivite']['commentaires_spectacle'])): ?>
				<p class="commentaires_spectacle">
					<span>Commentaires spectacle : </span><?php echo nl2br($ficheactivite['Ficheactivite']['commentaires_spectacle']); ?>
				</p>
			<?php endif; ?>
  </div>
  <div id="informations_complementaires" class="tab-pane fade">
  
	<?php if (!empty($ficheactivite['Ficheactivite']['siret'])): ?>
				<p class="siret">
					<span>Siret : </span><?php echo $ficheactivite['Ficheactivite']['siret']; ?>
				</p>
			<?php endif; ?>
			
			<?php if (!empty($ficheactivite['Ficheactivite']['apenaf'])): ?>
				<p class="apenaf">
					<span>APE / NAF : </span><?php echo $ficheactivite['Ficheactivite']['apenaf']; ?>
				</p>
			<?php endif; ?>
	
			<?php if (!empty($ficheactivite['Ficheactivite']['annee_creation'])): ?>
				<p class="annee_creation">
					<span>Année de création : </span><?php echo $ficheactivite['Ficheactivite']['annee_creation']; ?>
				</p>
			<?php endif; ?>

			<?php if (!empty($ficheactivite['Ficheactivite']['annee_construction'])): ?>
					<p class="annee_construction">
						<span>Année de construction : </span><?php echo $ficheactivite['Ficheactivite']['annee_construction']; ?>
					</p>
			<?php endif; ?>
		 
			<?php if (!empty($ficheactivite['Ficheactivite']['forme_juridique'])): ?>
				<p class="forme_juridique">
					<span>Forme juridique : </span><?php echo $ficheactivite['Ficheactivite']['forme_juridique']; ?>
				</p>
			<?php endif; ?>
			
			<?php if (!empty($ficheactivite['Ficheactivite']['jauge'])): ?>
				<p class="jauge">
					<span>Jauge : </span><?php echo $ficheactivite['Ficheactivite']['jauge']; ?>
				</p>
			<?php endif; ?>
			
			<?php if (!empty($ficheactivite['Ficheactivite']['capacite'])): ?>
				<p class="capacite">
					<span>Capacité : </span><?php echo $ficheactivite['Ficheactivite']['capacite']; ?>
				</p>
			<?php endif; ?>
			
			<?php if (!empty($ficheactivite['Ficheactivite']['scene'])): ?>
				<p class="scene">
					<span>Scène : </span><?php echo $ficheactivite['Ficheactivite']['scene']; ?>
				</p>
			<?php endif; ?>
			
			
			<?php if (!empty($ficheactivite['Ficheactivite']['revetement'])): ?><
				<p class="revetement">
					<span>Revetement : </span><?php echo $ficheactivite['Ficheactivite']['revetement']; ?>
				</p>	
			<?php endif; ?>
			
			<?php if (!empty($ficheactivite['Ficheactivite']['fosse_orchestre'])): ?>
				<p class="fosse_orchestre">
					<span>Fosse d'orchestre : </span><?php echo $ficheactivite['Ficheactivite']['fosse_orchestre']; ?>
				</p>
			<?php endif; ?>
			
			
			<?php if (!empty($ficheactivite['Ficheactivite']['capacite_assise'])): ?>
				<p class="capacite_assise">
					<span>Capacité assise : </span><?php echo $ficheactivite['Ficheactivite']['capacite_assise']; ?>
				</p>
			<?php endif; ?>
			
			
			<?php if (!empty($ficheactivite['Ficheactivite']['capacite_debout'])): ?>
				<p class="capacite_debout">
					<span>Capacité debout : </span><?php echo $ficheactivite['Ficheactivite']['capacite_debout']; ?>
				</p>
			<?php endif; ?>
			
			
			<?php if (!empty($ficheactivite['Ficheactivite']['scene_superficie'])): ?>
				<p class="scene_superficie">
					<span>Superficie de la scène : </span><?php echo $ficheactivite['Ficheactivite']['scene_superficie']; ?>
				</p>
			<?php endif; ?>
			
			<?php if (!empty($ficheactivite['Ficheactivite']['salle_superficie'])): ?>
				<p class="salle_superficie">
					<span>Superficie de la salle : </span><?php echo $ficheactivite['Ficheactivite']['salle_superficie']; ?>
				</p>
			<?php endif; ?>
			
			<?php if (!empty($ficheactivite['Ficheactivite']['effectif_artistique'])): ?>
				<p class="effectif_artistique">
					<span>Effectif artistique : </span><?php echo $ficheactivite['Ficheactivite']['effectif_artistique']; ?>
				</p>
			<?php endif; ?>
			
			<?php if (!empty($ficheactivite['Ficheactivite']['composition'])): ?>
				<p class="composition">
					<span>Composition : </span><?php echo $ficheactivite['Ficheactivite']['composition']; ?>
				</p>
			<?php endif; ?>
			
			<?php if (!empty($ficheactivite['Ficheactivite']['periodicite'])): ?>
				<p class="periodicite">
					<span>Périodicité : </span><?php echo $ficheactivite['Ficheactivite']['periodicite']; ?>
				</p>
			<?php endif; ?>
			
			<?php if (!empty($ficheactivite['Ficheactivite']['periode_realisation'])): ?>
				<p class="periode_realisation">
					<span>Période de réalisation : </span><?php echo $ficheactivite['Ficheactivite']['periode_realisation']; ?>
				</p>
			<?php endif; ?>
			
			<?php if (!empty($ficheactivite['Ficheactivite']['periode_preparation'])): ?>
				<p class="periode_preparation">
					<span>Période de préparation : </span><?php echo $ficheactivite['Ficheactivite']['periode_preparation']; ?>
				</p>
			<?php endif; ?>
			
			<?php if (!empty($ficheactivite['Ficheactivite']['numero_agrement'])): ?>
				<p class="numero_agrement">
					<span>Numéro d'agrément : </span><?php echo $ficheactivite['Ficheactivite']['numero_agrement']; ?>
				</p>
			<?php endif; ?>
			
			<?php if (!empty($ficheactivite['Ficheactivite']['effectif_audience'])): ?>
				<p class="effectif_audience">
					<span>Effectif audience : </span><?php echo $ficheactivite['Ficheactivite']['effectif_audience']; ?>
				</p>
			<?php endif; ?>
			
			<?php if (!empty($ficheactivite['Ficheactivite']['capacite_accueil'])): ?>
				<p class="capacite_accueil">
					<span>Capacité d'accueil : </span><?php echo $ficheactivite['Ficheactivite']['capacite_accueil']; ?>
				</p>
			<?php endif; ?>
			
			<?php if (!empty($ficheactivite['Ficheactivite']['rcr'])): ?>
				<p class="rcr">
					<span>RCR : </span><?php echo $ficheactivite['Ficheactivite']['rcr']; ?>
				</p>
			<?php endif; ?>
			
			<?php if (!empty($ficheactivite['Ficheactivite']['mode_gestion'])): ?>
				<p class="mode_gestion">
					<span>Mode de gestion : </span><?php echo $ficheactivite['Ficheactivite']['mode_gestion']; ?>
				</p>
			<?php endif; ?>
			
			<?php if (!empty($ficheactivite['Ficheactivite']['surface_m2'])): ?>
				<p class="surface_m2">
					<span>Surface en m2 : </span><?php echo $ficheactivite['Ficheactivite']['surface_m2']; ?>
				</p>
			<?php endif; ?>
			
			<?php if (!empty($ficheactivite['Ficheactivite']['acces_internet']) && $ficheactivite['Ficheactivite']['acces_internet']!="Non"): ?>
				<p class="acces_internet">
					<span>Accès internet : </span><?php echo $ficheactivite['Ficheactivite']['acces_internet']; ?>
				</p>
			<?php endif; ?>
			
			<?php if (!empty($ficheactivite['Ficheactivite']['bibliobus']) && $ficheactivite['Ficheactivite']['bibliobus']!="Non"): ?>
				<p class="bibliobus">
					<span>Bibliobus : </span><?php echo $ficheactivite['Ficheactivite']['bibliobus']; ?>
				</p>	
			<?php endif; ?>
			
			<?php if (!empty($ficheactivite['Ficheactivite']['liseuse']) && $ficheactivite['Ficheactivite']['liseuse']!="Non"): ?>
				<p class="liseuse">
					<span>Liseuse : </span><?php echo $ficheactivite['Ficheactivite']['liseuse']; ?>
				</p>	
			<?php endif; ?>
			
			<?php if (!empty($ficheactivite['Ficheactivite']['equipement_public_hand']) && $ficheactivite['Ficheactivite']['equipement_public_hand']!="Non"): ?>
				<p class="equipement_public_hand">
					<span>Equipement public handicapé : </span><?php echo $ficheactivite['Ficheactivite']['equipement_public_hand']; ?>
				</p>	
			<?php endif; ?>
			
			<?php if (!empty($ficheactivite['Ficheactivite']['intervention_aupres_pub']) && $ficheactivite['Ficheactivite']['intervention_aupres_pub']!="Non"): ?>
				<p class="intervention_aupres_pub">
					<span>Intervention auprès du public : </span><?php echo $ficheactivite['Ficheactivite']['intervention_aupres_pub']; ?>
				</p>
			<?php endif; ?>
			
			<?php if (!empty($ficheactivite['Ficheactivite']['surface_totale'])): ?>
				<p class="surface_totale">
					<span>Surface totale : </span><?php echo $ficheactivite['Ficheactivite']['surface_totale']; ?>
				</p>	
			<?php endif; ?>
			
			<?php if (!empty($ficheactivite['Ficheactivite']['surface_livre'])): ?>
				<p class="surface_livre">
					<span>Surface livre : </span><?php echo $ficheactivite['Ficheactivite']['surface_livre']; ?>
				</p>	
			<?php endif; ?>
			
			<?php if (!empty($ficheactivite['Ficheactivite']['nbr_reference'])): ?>
				<p class="nbr_reference">
					<span>Nombre de références : </span><?php echo $ficheactivite['Ficheactivite']['nbr_reference']; ?>
				</p>	
			<?php endif; ?>
			
			<?php if (!empty($ficheactivite['Ficheactivite']['informatisation']) && $ficheactivite['Ficheactivite']['informatisation']!="Non"): ?>
				<p class="informatisation">
					<span>informatisation : </span><?php echo $ficheactivite['Ficheactivite']['informatisation']; ?>
				</p>	
			<?php endif; ?>
			
			<?php if (!empty($ficheactivite['Ficheactivite']['vente_en_ligne']) && $ficheactivite['Ficheactivite']['vente_en_ligne']!="Non"): ?>
				<p class="vente_en_ligne">
					<span>Vente en ligne : </span><?php echo $ficheactivite['Ficheactivite']['vente_en_ligne']; ?>
				</p>	
			<?php endif; ?>
			
			<?php if (!empty($ficheactivite['Ficheactivite']['gencod'])): ?>
				<p class="GENCOD">
					<span>GENCOD : </span><?php echo $ficheactivite['Ficheactivite']['gencod']; ?>
				</p>	
			<?php endif; ?>
			
			<?php if (!empty($ficheactivite['Ficheactivite']['nbr_titre_catalogue'])): ?>
				<p class="nbr_titre_catalogue">
					<span>Nombre de titres au catalogue : </span><?php echo $ficheactivite['Ficheactivite']['nbr_titre_catalogue']; ?>
				</p>	
			<?php endif; ?>
			
			<?php if (!empty($ficheactivite['Ficheactivite']['nbr_publication'])): ?>
				<p class="nbr_publication">
					<span>Nombre de publications : </span><?php echo $ficheactivite['Ficheactivite']['nbr_publication']; ?>
				</p>	
			<?php endif; ?>
			
			<?php if (!empty($ficheactivite['Ficheactivite']['auto_diffusion']) && $ficheactivite['Ficheactivite']['auto_diffusion']!="Non"): ?>
				<p class="auto_diffusion">
					<span>Auto-diffusion : </span><?php echo $ficheactivite['Ficheactivite']['auto_diffusion']; ?>
				</p>	
			<?php endif; ?> 
			
			<?php if (!empty($ficheactivite['Ficheactivite']['auto_distribution']) && $ficheactivite['Ficheactivite']['auto_distribution']!="Non"): ?>
				<p class="auto_distribution">
					<span>Auto-distribution : </span><?php echo $ficheactivite['Ficheactivite']['auto_distribution']; ?>
				</p>	
			<?php endif; ?> 

			<?php if (!empty($ficheactivite['Ficheactivite']['date_actualisation']) && $ficheactivite['Ficheactivite']['date_actualisation']!="0000-00-00"): ?>
				<p class="date_actualisation">
					<span>Date d'actualisation : </span><?php echo $ficheactivite['Ficheactivite']['date_actualisation']; ?>
				</p>	
			<?php endif; ?>
			
			<?php if (!empty($ficheactivite['Ficheactivite']['nom_prenom_destinataire'])): ?>
				<p class="nom_prenom_destinataire">
					<span>Destinataire : </span><?php echo $ficheactivite['Ficheactivite']['nom_prenom_destinataire']; ?>
				</p>	
			<?php endif; ?>
			
			<?php if (!empty($ficheactivite['Ficheactivite']['fonction_titre'])): ?>
				<p class="fonction_titre">
					<span>Fonction titre : </span><?php echo $ficheactivite['Ficheactivite']['fonction_titre']; ?>
				</p>	
			<?php endif; ?>
			
			<?php if (!empty($ficheactivite['Ficheactivite']['e_mail_destinataire'])): ?>
				<p class="e_mail_destinataire">
					<span>Email du destinataire : </span><a href="mailto:<?php echo $ficheactivite['Ficheactivite']['e_mail_destinataire']; ?>" target="_blank"><?php echo $ficheactivite['Ficheactivite']['e_mail_destinataire']; ?></a>
			<?php endif; ?>
				
			
			<?php if (!empty($ficheactivite['Ficheactivite']['liste_des_contacts'])): ?>
				<p class="liste_des_contacts">
					<span>Liste des contacts : </span><?php echo $ficheactivite['Ficheactivite']['liste_des_contacts']; ?>
				</p>	
			<?php endif; ?> 
			
			<?php if (!empty($ficheactivite['Ficheactivite']['type_public'])): ?>
				<p class="type_public">
					<span>Type de public : </span><?php echo $ficheactivite['Ficheactivite']['type_public']; ?>
				</p>	
			<?php endif; ?>
			
			<?php if (!empty($ficheactivite['Ficheactivite']['support'])): ?>
				<p class="support">
					<span>Support : </span><?php echo $ficheactivite['Ficheactivite']['support']; ?>
				</p>	
			<?php endif; ?> 
			
			<?php if (!empty($ficheactivite['Ficheactivite']['rayonnement'])): ?>
				<p class="rayonnement">
					<span>Rayonnement : </span><?php echo $ficheactivite['Ficheactivite']['rayonnement']; ?>
				</p>	
			<?php endif; ?>
			
			<?php if (!empty($ficheactivite['Ficheactivite']['distinction'])): ?>
				<p class="distinction">
					<span>Distinction : </span><?php echo $ficheactivite['Ficheactivite']['distinction']; ?>
				</p>	
			<?php endif; ?>
			
			<?php if (!empty($ficheactivite['Ficheactivite']['index_complementaire'])): ?>
				<p class="index_complementaire">
					<span>Index complémentaire : </span><?php echo $ficheactivite['Ficheactivite']['index_complementaire']; ?>
				</p>	
			<?php endif; ?>
  
  </div>
  <div id="medias" class="tab-pane fade">
  <?php echo $this->element('Medias',array('mediaList'=>$ficheactivite['Media'])) ;?>

		 
	</div>
</div>
				</div>
			</div>
		</div>
	</div>
	
</div>
