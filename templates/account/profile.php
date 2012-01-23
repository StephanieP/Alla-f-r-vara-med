<?php
	// Dessa två rader ska vara högst upp i alla templates
	global $template; 
	if (!defined("_EXECUTE")) { echo "Not allowed"; exit;}
?>

<h1><?php echo $template->profile_username; ?></h1>
<article>

	<?php 
		// Existerar inte användarnamnet finns ej användaren
		if ($template->profile_username == null): ?>
        <p>
        	Användaren finns icke. =(
        </p>
    <?php 
		// Om profiltext finns, skriv ut den
		elseif ($template->profile_text != null): ?>
        <p>
        	<?php echo nl2br($template->profile_text); ?>
        </p>
    <?php
		// Om profiltext inte finns skriv ut detta
		else: ?>
        <p>
        	<?php echo $template->profile_username; ?> har inte skrivit något ännu...<br />
			Buhu ='(
        </p>
    <?php endif; ?>


    
	<?php
		// Om användaren är på sin egen profil
		if ($template->is_profile_admin): ?>
        <p>
            <a href="/account/edit/text/">Ändra innehåll</a>
        </p>
    <?php endif; ?>

</article>