<?PHP

include("../config.inc.php");

$r = mysql_query("SELECT id FROM catusers WHERE name='{$_COOKIE['user']}'");

$d = mysql_fetch_array($r);

$user_id = $d['id'];

mysql_query("INSERT INTO catbookmarks SET user_id=$user_id, file_id={$_REQUEST['id']}");

$ref = getenv("HTTP_REFERER");

header("Location: $ref");

?>