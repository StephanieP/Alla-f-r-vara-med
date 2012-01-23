<?php
	// Dessa två rader ska vara högst upp i alla templates
	global $template; 
	if (!defined("_EXECUTE")) { echo "Not allowed"; exit;}
?>

<aside>
<?php 
	// Existerar användarnamnet finnsanvändaren
	if ($template->profile_username != null): ?>

	<div class="user_profile_menu">
		<div class="user_profile_image">
		
		</div>
		<div>
			<nav>
				<ul>
				 <?php
					// Om användaren är på sin egen profil
					if ($template->is_profile_admin): ?>
					<li>
						<a href="/account/edit/text/">Ändra text</a>
					</li>
				<?php endif; ?>
				</ul>
			</nav>
		</div>
	</div>
</aside>

<article> 	
    <div class="user_profile_content">
    
        <h1><?php echo $template->profile_username; ?></h1>
        
        <?php 
            // Om profiltext finns, skriv ut den
            if ($template->profile_text != null): ?>
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
    
    

    </div>
    <div style="clear: both;"></div>
        
	<?php
		//Användaren finns ej
		else: ?>
            <p>
            	Användaren finns icke. =(
            </p>
    <?php endif; ?>
</article>