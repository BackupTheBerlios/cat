<?php

require_once('config.inc.php');

$pagetitle = $lang['add']['pagetitle'];

include_once('usersonline.inc.php');


$design->readTemplatesFromFile("add.xml");
$design->addVar("basic", "PAGETITLE", $pagetitle);

$design->addVar("addform", "LANG_ADD_CDDB1", $lang['add']['cddb1']);
$design->addVar("addform", "LANG_ADD_CDDBWINDOWTITLE", $lang['add']['cddbwindowtitle']);
$design->addVar("addform", "LANG_ADD_SHORTINFO", $lang['add']['shortinfo']);
$design->addVar("addform", "LANG_ARTIST", $lang['artist']);
$design->addVar("addform", "LANG_TITLE", $lang['title']);
$design->addVar("addform", "LANG_ALBUM", $lang['album']);
$design->addVar("addform", "LANG_ADDED_BY", $lang['added_by']);
#$design->addVar("addform", "LANG_ADD_CONTENT", $lang['add']['content']);
#$design->addVar("addform", "LANG_ADD_SUBMIT", $lang['add']['submit']);

$design->addVar("addform", "USERNAME", $username);

$design->addVar("basic", "PAGECONTENT", $design->getParsedTemplate("addform"));
$design->displayParsedTemplate("basic");

?>