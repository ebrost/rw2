
<h2><?php echo $ficheactivite['Ficheactivite']['nom_complet']; ?></h2>
	<adress>
		<?php if (!empty($ficheactivite['Ficheactivite']['adresse'])): ?>
			<?php echo $ficheactivite['Ficheactivite']['adresse']; ?><br />
			<?php echo $ficheactivite['Ficheactivite']['code_postal']; ?> <?php echo $ficheactivite['Ficheactivite']['ville']; ?>
		<?php endif; ?>	
	</adress>

		<?php if (!empty($ficheactivite['Ficheactivite']['telephone'])): ?>
			<?php echo $ficheactivite['Ficheactivite']['telephone']; ?>
			<br />
		<?php endif; ?>
		<?php if (!empty($ficheactivite['Ficheactivite']['url_site_web'])): ?>
			<a href="http://<?php echo $ficheactivite['Ficheactivite']['url_site_web']; ?>" target="_blank"><?php echo $ficheactivite['Ficheactivite']['url_site_web']; ?></a>
			<br />
		<?php endif; ?>
		<?php if (!empty($ficheactivite['Ficheactivite']['email'])): ?>
			<a href="mailto:<?php echo $ficheactivite['Ficheactivite']['email']; ?>" target="_blank"><?php echo $ficheactivite['Ficheactivite']['email']; ?></a>
			<br />
		<?php endif; ?>	
		<?php if (!empty($ficheactivite['Ficheactivite']['activites'])): ?>
			Activité(s) :<?php echo $ficheactivite['Ficheactivite']['activites']; ?>
		
		<?php endif; ?>	


