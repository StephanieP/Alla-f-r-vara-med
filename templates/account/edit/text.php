<?php
	// Dessa två rader ska vara högst upp i alla templates
	global $template; 
	if (!defined("_EXECUTE")) { echo "Not allowed"; exit;}
?>

<aside>
    <div class="user_profile_menu">
        <div class="user_profile_image">
        
        </div>
        <div>
            <nav>
                <ul>
                    <li>
                        <a href="/account/">Tillbaka till profilen</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</aside>
<article>        
    <div class="user_profile_content">
        <h1><?php echo $template->profile_username; ?></h1>
        <form action="" method="post">
            <textarea name="profile_text" style="width: 405px"><?php 
                if ($template->profile_text != null):
                    echo $template->profile_text;
                endif;
            ?></textarea><br>
            <input type="submit" value="Spara" />
        </form>
    </div>
    <div style="clear: both;"></div>
</article>