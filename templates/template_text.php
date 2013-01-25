<?php
/**
 * template_text.php
 * 
 * (c)2013 mrdragonraaar.com
 */
$html = $mobipocket->html(); 
$html = preg_replace('/^.+<body>/s', '', $html);
$html = preg_replace('/<\/body>.+?$/s', '', $html);
echo $html;
?>
