<?php

require_once('config.inc.php');

$db = new db_local;

if ($_REQUEST['id']=="")
{
	$design->addVar("error", "ERROR", "id ist leer!"); //HELP ME!
	$design->addVar("basic", "PAGECONTENT", $design->getParsedTemplate('error'));
	$design->displayParsedTemplate('basic');
	exit;
}

$db->query("SELECT comment FROM catusers WHERE id = {$_REQUEST['id']}");
$db->next_record();

$design->addVar("basic", "PAGECONTENT", $db->record['comment']);

$design->displayParsedTemplate('basic');
?>