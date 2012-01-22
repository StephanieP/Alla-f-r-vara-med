<?php 
	// Hämta variabler från den globala domänen
	global $template, $USER; 

	// Se till att javascript och css är en array
	$css 	= is_array($template->css) ? $template->css : array();
	$js		= is_array($template->javascript) ? $template->javascript : array();
																			 
	// Lägg till standard css
	array_unshift ($css, "ui_standard.css");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    
	<?php foreach ($css as $css_file): ?>
    	<link type="text/css" rel="stylesheet" href="<?php echo H_CSS_PATH . $css_file ?>" />
	<?php endforeach; ?>
    
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo $template->title; ?></title>
</head>

<body>

	<header>
    	<nav id="ui_user_navigation">
        	<?php if (!$USER->is_logon()): ?>
                <ul>
                    <li>
                        <a href="/login/">Logga in</a>
                    </li>
                    <li>
                        <a href="/register/">Bli medlem</a>
                    </li>
                </ul>
            <?php else: ?>
            	<ul class="is_logon">
                    <li>
                        <a href="/logout/"><img src="/graphics/header/logout_button.png" title="Logga ut" /></a>
                    </li>
                </ul>
            <?php endif; ?>
        </nav>
        
        <div id="ui_top_image">
        </div>
        
    	<nav id="ui_main_navigation">
        </nav>
    </header>
    
    <div id="ui_wrapper">
    	<aside id="ui_sidebar">
        	Har ej någon funktion ännu =(
        </aside>
        
        <article id="ui_page">
