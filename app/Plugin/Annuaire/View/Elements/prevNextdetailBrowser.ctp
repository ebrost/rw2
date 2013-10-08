<ul class="pager">
<li class="previous">
<?php if (isset($prev['Ficheactivite']['id'])) :?> 
<?php echo $this->Html->link('« '.$prev['Ficheactivite']['nom_complet'], array(
'plugin'=>'annuaire',
'controller' => 'ficheactivites',
 'action' => 'view',
 'id'=>$prev['Ficheactivite']['id'],
 'slug'=>Inflector::slug($prev['Ficheactivite']['nom_complet']),
 'num'=>$prev['Ficheactivite']['num'],
 'page' => $page,
 'q' => $this->request->params['named']['q'],
 'r' => $prev['Ficheactivite']['relevance'])); ?>
<?php else: ?>
&nbsp;
<?php endif; ?>
</div> 



<li class="back">

<?php  echo $this->Html->link('retour à la liste',array(
'controller' => 'Ficheactivites',
 'action' => 'search',
 //$next['Ficheactivite']['id'],
 'page'=>$page,
 'q' => $this->request->params['named']['q'])); ?>

</li> 


<li class="next">
<?php if (isset($next['Ficheactivite']['id'])) :?> 
<?php echo $this->Html->link($next['Ficheactivite']['nom_complet'].' »', array(
'plugin'=>'annuaire',
'controller' => 'ficheactivites',
'action' => 'view',
'id'=>$next['Ficheactivite']['id'],
'slug'=>Inflector::slug($next['Ficheactivite']['nom_complet']),
'num'=>$next['Ficheactivite']['num'],
'page' => $page,
'q' => $this->request->params['named']['q'],
 'r' => $next['Ficheactivite']['relevance'])); ?>
<?php endif; ?>
</div> 
</ul>
