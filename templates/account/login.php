<?php
	// Dessa två rader ska vara högst upp i alla templates
	global $template; 
	if (!defined("_EXECUTE")) { echo "Not allowed"; exit;}
?>

<h1>Logga in</h1>

<form action="" method="post">
    <input type="text" placeholder="Användarnamn..." name="username" /><br />
    <input type="password" placeholder="Lösenord..." name="password" /><br />
    <input type="submit" value="Logga in" />
</form>

<?php if (isset($template->error)): ?>
    <div class="ui_error">
    	<?php echo $template->error; ?>
    </div>
<?php endif; ?>