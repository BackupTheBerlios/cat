<?php
require_once('config.inc.php');
$design->readTemplatesFromFile('userinfo.xml');
$db = new db_local;

if($_REQUEST['input']=="Submit")
{
	$comment = $_REQUEST['comment'];

	$db->query("INSERT INTO catusers SET
			comment = '".$comment."'");


	$design->addVar("edit", "LANG_PREFS_COMMENT", "Comment:");
	header("Location: showuser.php?id=$user_id");
}
$design->displayParsedTemplate('edit');


?>