<?php
//flexible config
$scriptext = '.php';

//if ($HTTP_HOST!='lyrics.nachtwind.net') echo '<meta http-equiv="refresh" content="0; URL=http://lyrics.nachtwind.net/">';

$cookiepath = '/';
$domainname = $HTTP_HOST;
$cookie_expires = time()+365*24*60*60;

//connect
require_once('db_mysql.inc.php');
require_once('dbconfig.inc.php');

//timezone and locale
require_once("language.inc.php");
$timezone = 'Europe/Berlin';
putenv('TZ=$timezone');
setlocale(LC_CTYPE,'de');

//color config
$rowcolordark  = '#003366';
$rowcolorlight = '#004070';
$rowcolor      = $rowcolorlight;
$headercolor   = $rowcolordark;
$cellpad       = '"1"';
$cellspc       = '"3"';

//template config
require_once("patTemplate.php");
$design = new patTemplate;
$design->setBasedir('./templates');

$design->readTemplatesFromFile('basic.xml');

$design->addVar("basic", "LANG_USERSONLINE", $lang['usersonline']);
$design->addVar("basic", "LANG_QUICKSEARCH", $lang['quicksearch']);
$design->addVar("basic", "LANG_EXTENDEDSEARCH", $lang['extendedsearch']);
$design->addVar("basic", "LANG_ARTISTBROWSE", $lang['artistbrowser']);
$design->addVar("basic", "LANG_ADDLYRICS", $lang['addlyrics']);
$design->addVar("basic", "LANG_PREFERENCES", $lang['preferences']);
$design->addVar("basic", "LANG_STAFF", $lang['staff']);
$design->addVar("basic", "LANG_STATISTICS", $lang['statistics']);

$db = new db_local;

$db_user = new db_local;

$db_user->query("SELECT id FROM catusers WHERE name = '{$_COOKIE['user']}' AND pass = '{$_COOKIE['pass']}'");
if ($db_user->num_rows() == 0)
{
	$user_id = 0;
}
else
{
	$db_user->next_record();
	$user_id = $db_user->record['id'];
}
$db_user->close();

$username = (isset($_COOKIE['user']) ? $_COOKIE['user'] : '<a href="login.php">Login</a>');

$design->addVar("basic", "USERNAME", $username);

unset($output);

?>
