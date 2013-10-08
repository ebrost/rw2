<?php $this->extend('/Common/admin');?>
<?php $this->Html->css('Annuaire.annuaire', null, array('inline' => false));?>





<?php $this->start('content-top');?>
	<div class="alert alert-block alert-info">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <h4>Information</h4>
  Ce module est en cours de développement. <br>
  Les informations affichées ainsi que l'apparence de cette page seront très probablement soumises à de nombreuses modifications !
</div>
<?php $this->end();?>


<!--content: pas besoin de fetch -->
<ul class="nav nav-tabs">
  <li class="active"><a href="#activites" data-toggle="tab">Mes activités</a></li>
  <li><a href="#evenements" data-toggle="tab">Mes événements</a></li>
  <li><a href="#stages" data-toggle="tab">Mes stages</a></li>
  <li><a href="#oeuvres" data-toggle="tab">Mes oeuvres</a></li>
</ul>

<div class="tab-content">
  <div class="tab-pane active" id="activites">
  
	<table class="table">
		<thead>
			<tr>
				<th>Intitulé</th>
				<th>Activité(s)</th>
				<th>Actions</th>
			</tr>
		</thead>
			<tr>
				<td>A4 Recyclage</td>
				<td>Compacteur - Organisme de formation au développement durable</td>
				<td><a class="btn" href="#"><i class="icon-pencil icon-small"></i> Editer</a>
					<a class="btn btn-danger" href="#"><i class="icon-trash icon-small"></i> Supprimer</a>
	</table>
		
		<a href="#"><i class="icon-plus-sign"></i> Ajouter une activité</a>
  
  
  </div>
  <div class="tab-pane" id="evenements">
  <h4> Vous n'avez pas d'évemement enregistré</h4>
  <a href="#"><i class="icon-plus-sign">
  
  </i> Ajouter un événement</a>
  </div>
  <div class="tab-pane" id="stages"> <h4> Vous n'avez pas de stage enregistré</h4>
  <a href="#"><i class="icon-plus-sign">
 
  </i> Ajouter un stage</a>
  </div>
  <div class="tab-pane" id="oeuvres">
  <h4> Vous n'avez pas d'oeuvre enregistré</h4>
  <a href="#"><i class="icon-plus-sign"></i> Ajouter une oeuvre</a>
  </div>
</div>