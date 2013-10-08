<?php
class User extends AppModel
{
	public $name='User';
	public $displayField = 'username';
	
	public $validate = array(
		
		'username'=>array(
		 'Not empty'=>array(
		        'rule'=>'notEmpty',
		        'message'=>'Veuillez renseigner votre identifiant'
		    ),
			'The username must be between 5 and 15 characters.'=>array(
				'rule'=>array('between', 5, 15),
				'message'=>'Votre identifiant doit comporter de 5 à 15 caractères.'
			),
			'That username has already been taken'=>array(
				'rule'=>'isUnique',
				'message'=>'Cet idendentifiant est déjà utilisé.'
			)
		),
		'email'=>array(
			'Valid email'=>array(
				'rule'=>array('email'),
				'message'=>'Cette adresse n\'est pas valide'
			)
		),
		'password'=>array(
		    'Not empty'=>array(
		        'rule'=>'notEmpty',
		        'message'=>'Veuillez renseigner votre mot de passe'
		    ),
		    'Match passwords'=>array(
		        'rule'=>'matchPasswords',
		        'message'=>'vos mots de passe ne concordent pas '
		    )
		),
		'password_confirmation'=>array(
		    'Not empty'=>array(
		        'rule'=>'notEmpty',
		        'message'=>'Veuillez confirmer votre mote de passe'
		    )
		)
	);
	
}
?>