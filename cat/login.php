<?php ob_start(); include('language.inc.php'); ?>
<? $pagetitle = $lang['login']['pagetitle']; include('page_header.inc.php'); ?>

<?php
if (isset($_POST['step'])) { 
 if ($_POST['step']==2) {

	 //check for empty fields
	 if (	!eregi('.', $username)
	     || !eregi('.', $password)
	     ) {
		print 'You did not fill in all fields.<br>'.$lang['backbutton'];
		exit;
	 }


	 //check if login is correct and proceed
	 $sql = "SELECT id,name,pass FROM catusers WHERE name='$username' AND pass='$password'";

	 $result = mysql_query($sql);

	 if ($result) {
		      $row = mysql_fetch_array($result);
		      if ($password == $row['pass']) {

			 printf($lang['login']['success'],$row['name']);

			 //delete cookie to get sure
			 //setcookie('user',$row['name'],strftime("%A, %d-%b-%Y %H:%M:%S MST", time()-3600),'/cat/');
			 //setcookie('pass',$row['pass'],strftime("%A, %d-%b-%Y %H:%M:%S MST", time()-3600),'/cat/');

			 //set cookie
			 setcookie('user',$row['name'],$cookie_expires,$cookiepath,$domainname,0);
			 setcookie('pass',$row['pass'],$cookie_expires,$cookiepath,$domainname,0);

		      } else {
			     print 'Login incorrect.';
		      }//end_else mysql_num_rows...
	 } else {
		include('dberror.php');
	 }
	 //end_else result...
}
} else {
?>
	      <table width="92%" border="0" cellspacing="0" cellpadding="0" align="center">
		<tr>
		  <td height="75" valign="middle">
		    <div align="center"><b><font face="Verdana, Arial, Helvetica, sans-serif">
		    <?php echo $lang['login']['shortinfo']; ?></font></b></div>
		  </td>
		</tr>
	      </table>
	      <font face="Verdana, Arial, Helvetica, sans-serif" color="#ffff66" size="2"><b><br>
	      </b></font>

	      <form name="form2" method="POST" action="<?php echo $PHP_SELF; ?>">
		<table width="92%" border="0" cellspacing="3" cellpadding="4" align="center">
		  <tr bgcolor="#003366">
		    <td width="33%" nowrap>
		      <div align="right"><i><?php echo $lang['username']; ?></i></div>
		    </td>
		    <td width="67%">
		      <input type="text" name="username" size="30" maxlength="20">
		    </td>
		  </tr>
		  <tr bgcolor="#003366">
		    <td width="33%" nowrap>
		      <div align="right"><i><?php echo $lang['password']; ?></i></div>
		    </td>
		    <td width="67%">
		      <input type="password" name="password" size="30" maxlength="20">
		    </td>
		  </tr>
		  <tr bgcolor="#003366">
		    <td width="33%" valign="middle" nowrap height="47">
		      <div align="right">
			<input type="hidden" name="step" value="2">
		      </div>
		    </td>
		    <td width="67%" height="47">
		      <input type="submit" name="Submit2" value="<?php echo $lang['login']['buttontext']; ?>">
		      <i>(Cookies müssen aktiviert sein)</i> </td>
		  </tr>
		</table>
			  </form>
	      <font face="Verdana, Arial, Helvetica, sans-serif" color="#ffff66" size="2"><b>
	      </b></font>
<?php
}

//finally start sending to browser, only for php4
ob_end_flush();
include('page_footer.inc.php'); ?>
