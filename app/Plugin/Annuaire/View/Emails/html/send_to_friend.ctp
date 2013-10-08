Votre ami vous recommande les fiches suivantes:

<ul>
<?php foreach ($links as $link): ?>
<li>

<?php echo $this->Html->link($link['nom'],$link['url'])?>
				</li>
<?php endforeach; ?>
</ul>
<?php if (!empty($message)):?>
<?php echo nl2br($message); ?>
<?php endif; ?>