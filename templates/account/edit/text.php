<?php
	// Dessa två rader ska vara högst upp i alla templates
	global $template; 
	if (!defined("_EXECUTE")) { echo "Not allowed"; exit;}
?>

<h1><?php echo $template->profile_username; ?></h1>
<article>
	<p>
    	<form action="" method="post">
            <textarea name="profile_text"><?php 
                if ($template->profile_text != null):
                    echo $template->profile_text;
                endif;
            ?></textarea><br>
            <input type="submit" value="Spara" />
        </form>
	</p>
</article>