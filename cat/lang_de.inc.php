<?php

#global
$lang['artist']     = 'Interpret';
$lang['title']      = 'Songname';
$lang['album']      = 'Album';
$lang['added_by']   = 'Geaddet von';
$lang['backbutton'] = '<input onclick="history.back()" type="button"  value="Zur&uuml;ck">';
$lang['guest']      = 'Gast';
$lang['username']   = 'Benutzername';
$lang['password']   = 'Passwort';
$lang['approved']   = 'Gepr&uuml;ft';
$lang['not_approved']   = 'Noch nicht gepr&uuml;ft';

#page template
$lang['usersonline']      = 'Benutzer online: ';
$lang['quicksearch']      = 'Schnellsuche';
$lang['extendedsearch']   = 'Erweiterte Suche';
$lang['artistbrowser']    = $lang['artist'].' Browser';
$lang['addlyrics']        = 'Lyrics adden';
$lang['preferences']      = 'Einstellungen';
$lang['staff']            = 'CAT Team';
$lang['statistics']       = 'Neue Files';

#add.php
$lang['add']['pagetitle']        = 'Lyrics adden';
$lang['add']['cddb1']            = 'Zumindest das Songname-Feld muss ausgef&uuml;llt werden, um CDDB zu konsultieren.';
$lang['add']['cddbwindowtitle']  = 'CAT - Albumtitel nachsehen';
$lang['add']['shortinfo']        = 'Addet eure Lyrics, Chords, Tabs oder Bass Tabs hier.<br>';

#add2.php
$lang['add2']['pagetitle']       = 'Dein Song wurde eingetragen.';
$lang['add2']['nocontent']       = 'Du hast keinen Inhalt angegeben.';
$lang['add2']['spellcheckerinfo'] = "Ist der Albumtitel korrekt?<br>\nEs gibt bereits ein Album von <b>%s</b> mit einem &auml;hnlichen Namen:";
$lang['add2']['usethisalbum']    = 'Dieses Album benutzen';
$lang['add2']['confirmnewalbum'] = 'Neues Album best&auml;tigen';
$lang['add2']['success']         = 'Deine Datei wurde eingetragen.';
$lang['add2']['num_submit']     = 'Du hast nun %s Songs hinzugef&uuml;gt';
$lang['add2']['submitanother']   = 'Einen weiteren Song adden';
$lang['add2']['viewaddedfile']   = 'Song ansehen';

#artistbrowse.php
$lang['artistbrowse']['pagetitle'] = $lang['artist'].' Browser';

#display.php
$lang['display']['viewlyrics']    = 'Lyrics ansehen';
$lang['display']['viewchords']    = 'Chords ansehen';
$lang['display']['viewtab']       = 'Tab ansehen';
$lang['display']['viewbtab']      = 'Bass Tab ansehen';
$lang['display']['viewcounter']   = 'This page has been viewed %s times so far';
$lang['display']['printversion']  = '[Druckversion]';
$lang['display']['notfound']      = "Sorry, dieser Song existiert nicht.";
$lang['display']['addbookmark']	 = '[Bookmark setzen]';

#displaypf.php
$lang['displaypf']['pagetitle']    = 'Druckversion';

#info.php
$lang['info']['pagetitle']    = '%s Info ansehen: %s - %s';
$lang['info']['na']           = 'Albuminformation zur Zeit leider nicht verf&uuml;gbar.';
$lang['info']['tracklistna']  = 'Tracklist zur Zeit leider nicht verf&uuml;gbar';

#login.php
$lang['login']['pagetitle']  = 'Login';
$lang['login']['shortinfo']  = 'Du kannst dich hier einloggen.<br>
                            Noch nicht registriert? Zur <a href="register.php">Registrierung</a>';
$lang['login']['buttontext'] = 'Einloggen';
$lang['login']['success']    = 'Login als %s erfolgreich, ein Cookie wurde für ein Jahr gesetzt';

#search.php
$lang['search']['pagetitle']['quick']        = "Suchergebnisse f&uuml;r: '%s'";
$lang['search']['pagetitle']['ext_normal']   = 'Suchergebnisse f&uuml;r erweiterte Suche (Normal)';
$lang['search']['pagetitle']['ext_exact']    = 'Suchergebnisse f&uuml;r erweiterte Suche (Exakt)';
$lang['search']['pagetitle']['artistbrowse'] = $lang['artistbrowse']['pagetitle'].': %s';
$lang['search']['noresults']               = "Deine Suche ergab leider keine Ergebnisse";
$lang['search']['option_tryagain']         = 'Nach anderen Stichworten suchen';
$lang['search']['option_request']          = 'Einen Song requesten';
$lang['search']['error']['quick']            = 'Deine Schnellsuche muss mindestens drei Zeichen enthalten.';
$lang['search']['error']['normal']           = 'Du musst mindestens ein Feld ausf&uuml;llen.';
$lang['search']['error']['exact']            = "Deine exakte Suche ergab keine Ergebnisse, weil Du kein Feld ausgef&uuml;llt hast.";

#stats.php
$lang['stats']['viewfile']                 = 'Ansehen';
$lang['stats']['viewalbum']                = 'Albuminformation ansehen';

#stdsearch.php
$lang['stdsearch']['shortinfo']    = 'Bitte gib ein oder mehrere Wort(e) an.<br>
                                  In den meisten F&auml;llen solltest Du den normalen Suchmodus benutzen.<br>
                                  <br>
                                  Vorsicht vor Tippfehlern :)';
$lang['stdsearch']['searchfor']    = 'Suchen nach: ';
$lang['stdsearch']['mode']         = 'Modus: ';
$lang['stdsearch']['mode_normal']  = 'Normal';
$lang['stdsearch']['mode_exact']   = 'Exakt';
$lang['stdsearch']['buttontext']   = 'Suchen';
?>
