<?php
//Router::connect ('/', array('plugin' => 'annuaire','controller'=>'ficheactivites', 'action'=>'index'));
Router::connect(
    '/annuaire/ficheactivites/:id-:slug/*',
    array(
	'plugin' => 'annuaire',
	'controller'=>'ficheactivites',
	'action' => 'view'
	),
    array(
		'pass'=>array('id','slug'),
        'id' => '[0-9]+',

    )
);

Router::connect(
    '/Annuaire/ficheactivites/:id-:slug/*',
    array(
	'plugin' => 'annuaire',
	'controller'=>'ficheactivites',
	'action' => 'view'
	),
    array(
		'pass'=>array('id','slug'),
        'id' => '[0-9]+',

    )
);
Router::connect('/annuaire', array('plugin' => 'annuaire', 'controller' => 'ficheactivites', 'action' => 'index'));
Router::connect('/Annuaire/:controller/:action/*', array('plugin' => 'annuaire'));
/*
'pass'=>array('id','num','q','slug'),
        'id' => '[0-9]+',
        'num' => '[0-9]+',
		

*/