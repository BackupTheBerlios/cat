<?php
include('language.inc.php');
$pagetitle = $lang['artistbrowse']['pagetitle'];
include('page_header.inc.php'); ?>

	      <div align="center">
	      <?php
	      for ($i=65;$i<=90;$i++) {
		  echo '<a href="../search/artist='.chr($i).'&title=&album=&addedby=&s_lyrics=yes&s_tabs=yes&s_chords=yes&s_btabs=yes&mode=browsebyartist">'.chr($i).'</a> ';
	      }
	      ?>
	      </div>
<?php include('page_footer.inc.php'); ?>
