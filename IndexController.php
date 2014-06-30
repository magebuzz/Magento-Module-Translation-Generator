<?php
include_once('TranslationGenerator.php');

if (isset($_GET['path'])) {
	$generator = new TranslationGenerator($_GET['path']);
	echo $generator->getTranslationHTMLcode();
}