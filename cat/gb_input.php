<?php ob_start(); ?>

<html>
<head>
<title>hansen</title>
</head>
	<body>

<?php
$check = $_REQUEST['check'];
if ($check == 1)
{
include_once('db_mysql.inc.php');
include_once('dbconfig.inc.php');
$db = new db_local;

$username = $_REQUEST['username'];
$subject = $_REQUEST['subject'];
$comment = $_REQUEST['comment'];

if (trim($username) == "")
{
	echo "Namen Eingeben!";
	ob_end_flush();
	exit;
}

if (trim($comment) == "")
{
	echo "Sie sollten schon etwas zu sagen haben, wenn sie sich im G&auml;stebuch eintragen wollen.";
	ob_end_flush();
	exit;
}

	$db->query("INSERT INTO guestbook SET
				author = '".addslashes($username)."',
				subject = '".addslashes($subject)."',
				text = '".addslashes($comment)."',
				date = NOW()");

header('Location: gb_output.php');
}
?>
		<form action="<?php echo $PHP_SELF ?>" method="GET">
			<input type="hidden" name="check" value=1>
			<p>Name:<input type="text" name="username"></p><br>
			<p>Subject:<input type ="text" name="subject"></p><br>
			<p>Eintrag:<textarea name="comment" rows="20" cols="80" wrap="HARD"></textarea></p><br>
			<input type="submit" value="Submit">
		</form>
	</body>
</html>
<?php ob_end_flush ?>