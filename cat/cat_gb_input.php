<?php
$check = $_REQUEST['check'];
if ($check == 1)
{
include_once('config.inc.php');

$username = $_REQUEST['username'];
$subject = $_REQUEST['subject'];
$comment = $_REQUEST['comment'];

if (trim($username) == "")
{
	$name_error = "Namen Eingeben!";
	exit;
}

if (trim($comment) == "")
{
	$comment_error = "Sie sollten schon etwas zu sagen haben, wenn sie sich im G&auml;stebuch eintragen wollen.";
	exit;
}

	$db->query("INSERT INTO songfiles SET
				user_name = '".addslashes($username)."',
				user_text = '".addslashes($comment)."'");

header('Location: cat_gb_output.php');
}
?>