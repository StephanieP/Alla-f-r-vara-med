<?php
	// Dessa två rader ska vara högst upp i alla templates
	global $template; 
	if (!defined("_EXECUTE")) { echo "Not allowed"; exit;}
?>

<h1>Bli medlem</h1>


<form action="" method="post">
    <input type="text" placeholder="Välj ett användarnamn..." name="username" /><br />
    <input type="password" placeholder="Välj ett lösenord..." name="password" /><br />
    <input type="password" placeholder="Lösenordet igen..." name="password_verify" /><br />
    <input type="submit" value="Bli medlem" />
</form>
<?php if (isset($template->error)): ?>
    <div class="ui_error">
    	<?php echo $template->error; ?>
    </div>
<?php endif; ?>