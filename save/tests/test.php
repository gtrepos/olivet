<?php
/*
 * Please see the full php-ajax tutorial at http://www.php-learn-it.com/tutorials/starting_with_php_and_ajax.html
 * If you found this tutorial useful, i would apprciate a link back to this tutorial. 
 * Visit http://www.php-learn-it.com for more php and ajax tutrials
 */

if($_POST["name"] == "")
	echo "name is empty";
else
	echo "you typed ".$_POST["name"];
?>