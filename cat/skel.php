<?php

require_once('config.inc.php');

$pagetitle = '';

include('usersonline.inc.php');
$design->addVar("basic", "USERSONLINE", substr($uo,0,strlen($uo)-2));

$design->readTemplatesFromFile("");
$design->addVar("basic", "PAGETITLE", $pagetitle);

//here goes...

$design->addVar("basic", "PAGECONTENT", $design->getParsedTemplate(""));
$design->displayParsedTemplate("basic");

?>