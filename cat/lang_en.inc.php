<?php

#global
$lang['artist']     = 'Artist';
$lang['title']      = 'Title';
$lang['album']      = 'Album';
$lang['added_by']   = 'Added by';
$lang['backbutton'] = '<input onclick="history.back()" type="button"  value="Try again">';
$lang['guest']      = 'Guest';
$lang['username']   = 'Username';
$lang['password']   = 'Password';
$lang['approved']   = 'Approved';
$lang['not_approved']   = 'Not yet reviewed';

#page template
$lang['usersonline']      = 'Users online: ';
$lang['quicksearch']      = 'Quicksearch';
$lang['extendedsearch']   = 'Extended Search';
$lang['artistbrowser']    = $lang['artist'].' Browser';
$lang['addlyrics']        = 'Add lyrics';
$lang['preferences']      = 'Preferences';
$lang['staff']            = 'CAT Team';
$lang['statistics']       = 'New files';

#add.php
$lang['add']['pagetitle']        = 'Add lyrics';
$lang['add']['cddb1']            = 'You must fill in at least the title field to consult CDDB.';
$lang['add']['cddbwindowtitle']  = 'CAT - Look up album title';
$lang['add']['shortinfo']        = 'Submit your lyrics, tabs or chords here.<br>';

#add2.php
$lang['add2']['pagetitle']       = 'Your file was added';
$lang['add2']['nocontent']       = 'You forgot to fill in the contents.';
$lang['add2']['spellcheckerinfo'] = "Is the album title correct?<br>\nThere already exists an album from <b>%s</b> with a similar name:";
$lang['add2']['usethisalbum']    = 'Use this album';
$lang['add2']['confirmnewalbum'] = 'Confirm new album';
$lang['add2']['success']         = 'Your file has been added.';
$lang['add2']['num_submit']      = 'You have submitted %s files so far.';
$lang['add2']['submitanother']   = 'Add another file';
$lang['add2']['viewaddedfile']   = 'View your file';

#artistbrowse.php
$lang['artistbrowse']['pagetitle'] = $lang['artist'].' Browser';

#display.php
$lang['display']['viewlyrics']    = 'View Lyrics';
$lang['display']['viewchords']    = 'View Chords';
$lang['display']['viewtab']       = 'View Tab';
$lang['display']['viewbtab']      = 'View Bass Tab';
$lang['display']['viewcounter']   = 'This page has been viewed %s times so far';
$lang['display']['printversion']  = '[Printer-friendly]';
$lang['display']['notfound']      = "Sorry, this file doesn't exist.";
$lang['display']['addbookmark']	 = '[Add bookmark]';

#displaypf.php
$lang['displaypf']['pagetitle']    = 'View Print Version';

#info.php
$lang['info']['pagetitle']    = 'View %s Info: %s - %s';
$lang['info']['na']           = 'Album information currently not available.';
$lang['info']['tracklistna']  = 'Tracklist currently not available.';

#login.php
$lang['login']['pagetitle']  = 'Login';
$lang['login']['shortinfo']  = 'You can login below.<br>
                            Not yet registered? <a href="register.php">Do it now!</a>';
$lang['login']['buttontext'] = 'Login';
$lang['login']['success']    = 'Login as %s successful, your cookie has been set for one year.';

#search.php
$lang['search']['pagetitle']['quick']        = "Search Results for: '%s'";
$lang['search']['pagetitle']['ext_normal']   = 'Search results for normal extended search';
$lang['search']['pagetitle']['ext_exact']    = 'Search Results for exact extended search';
$lang['search']['pagetitle']['artistbrowse'] = $lang['artistbrowse']['pagetitle'].': %s';
$lang['search']['noresults']               = "Your search didn't return any results.";
$lang['search']['option_tryagain']         = 'Refine your search';
$lang['search']['option_request']          = 'Request a file';
$lang['search']['error']['quick']            = 'Your quicksearch must contain at least 3 characters.';
$lang['search']['error']['normal']           = 'You must fill in at least one field.';
$lang['search']['error']['exact']            = "Your exact search didn\'t return anything because you didn\'t fill in any fields.";

#stats.php
$lang['stats']['viewfile']                 = 'View File';
$lang['stats']['viewalbum']                = 'View Album Information';

#stdsearch.php
$lang['stdsearch']['shortinfo']    = 'Please enter one or more words to search for.<br>
                                  You should use normal search in most cases.<br>
                                  <br>
                                  Also: Be sure to check your spelling!';
$lang['stdsearch']['searchfor']    = 'Search for: ';
$lang['stdsearch']['mode']         = 'Mode: ';
$lang['stdsearch']['mode_normal']  = 'Normal';
$lang['stdsearch']['mode_exact']   = 'Exact';
$lang['stdsearch']['buttontext']   = 'Search';
?>
