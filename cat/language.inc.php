<?php
$languages_accepted = explode(',',getenv('HTTP_ACCEPT_LANGUAGE'));

for ($i=1;$i<sizeof($languages_accepted);$i++)
  $languages_accepted[$i] = strtolower(preg_replace("!-(.*)\$!","",$languages_accepted[$i]));

for ($i=0;$i<sizeof($languages_accepted);$i++) {
  $langcode = $languages_accepted[$i];
  if ($langcode=='en' || $langcode=='de') break;
}

if ($langcode!='en' && $langcode!='de') $langcode = 'en'; //default language

include("lang_$langcode.inc.php");
?>
