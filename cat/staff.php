<?php

include('config.inc.php');

$design->readTemplatesFromFile("staff.xml");
$design->addVar("basic", "PAGETITLE", $lang['staff']);

$db->query("SELECT name, image, x, y, functions FROM catstaff ORDER BY id ASC");

while ($db->next_record())
{
	$design->addVar("staffentry", "NAME", nl2br(htmlentities($db->record['name'])));
	$design->addVar("staffentry", "PROFILE", nl2br(htmlentities(strtolower('profile_'.$db->record['name'].'.php'))));
	$design->addVar("staffentry", "IMAGE", 'images/'.$db->record['image']);
	$design->addVar("staffentry", "FUNCTIONS", str_replace("\\n", "<br>", htmlentities($db->record['functions'])));
	$design->addVar("staffentry", "X", $db->record['x']);
	$design->addVar("staffentry", "Y", $db->record['y']);
	$design->parseTemplate("staffentry", "w");
	$output .= $design->getParsedTemplate("staffentry");
}

$design->addVar("staff", "STAFFENTRIES", $output);
$design->addVar("staff", "LANG_STAFF", $lang['staff']);

$design->addVar("basic", "PAGECONTENT", $design->getParsedTemplate("staff"));
$design->displayParsedTemplate("basic");

?>