<?php ob_start(); include('language.inc.php'); ?>
<? $pagetitle = 'Personal Page'; include('page_header.inc.php'); ?>
<script language="JavaScript">
<!--
function IsFormComplete(FormName)
{
var x	    = 0
var FormOk  = true

while ((x < document.forms[FormName].elements.length) && (FormOk))
   {
     if (document.forms[FormName].elements[x].value == '')
     {
	alert('Please enter the '+document.forms[FormName].elements[x].name +' and try again.')
	document.forms[FormName].elements[x].focus()
	FormOk = false
     }
     x ++
   }
return FormOk
}


function CheckForm(FormName)
{
if (IsFormComplete(FormName)) {
var EmailOk  = true
var Temp     = document.forms[FormName].elements["email"]
var AtSym    = Temp.value.indexOf('@')
var Period   = Temp.value.lastIndexOf('.')
var Space    = Temp.value.indexOf(' ')
var Length   = Temp.value.length - 1   // Array is from 0 to length-1

if ((AtSym < 1) ||		       // '@' cannot be in first position
    (Period <= AtSym+1) ||	       // Must be atleast one valid char btwn '@' and '.'
    (Period == Length ) ||	       // Must be atleast one valid char after '.'
    (Space  != -1))		       // No empty spaces permitted
   {
      EmailOk = false
      alert('Please enter a valid e-mail address!')
      Temp.focus()
   }
}
if (EmailOk) {
   document.form2.submit();
}
}
// -->
</script>

<?php
if ($step=='2') {

	 //check for empty fields
	 if (	!eregi('.', $username)
	     || !eregi('.', $password1)
	     || !eregi('.', $password2)
	     ) {
		print 'You did not fill in all fields.<br>Please <a href="javascript:history.back()">try again</a>';
		exit;
	 }

	 //check for length
	 if (strlen($username)<3) {
		print 'Your username must contain at least 3 characters.<br>Please <a href="javascript:history.back()">try again</a>';
		exit;
	 }

	 if (strlen($password1)<6 || strlen($password2)<6) {
		print 'Your password must contain at least 6 characters.<br>Please <a href="javascript:history.back()">try again</a>';
		exit;
	 }

	 //check for bad characters
	 if (	!eregi('(^)([a-zA-Z0-9_])|(_)($)', $username)
	     || !eregi('(^)([a-zA-Z0-9_])|(_)($)', $password1)
	     || !eregi('(^)([a-zA-Z0-9_])|(_)($)', $password2)
	     ) {
		print 'Sorry, no characters other than letters, numbers and underscores allowed.<br>Please <a href="javascript:history.back()">try again</a>';
		exit;
	 }

	 //check for whitespaces
	 if (	eregi(' ', $username)
	     || eregi(' ', $password1)
	     || eregi(' ', $password2)
	     ) {
		print 'Sorry, no spaces in any field allowed.<br>Please <a href="javascript:history.back()">try again</a>';
		exit;
	 }

	 //check passwords
	 if ($password1 != $password2) {
		print 'Your password fields do not match, check for typos.<br>Please <a href="javascript:history.back()">try again</a>';
		exit;
	 }

	 //check if email is correct
	 if (eregi("^[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-wyz][a-z](g|l|m|pa|t|u|v)?$", $email, $check)) {
	 if (checkdnsrr(substr(strstr($check['0'], '@'), 1), "ANY")) {
	       $validemail=TRUE;
	       }
	 } else {
	       $validemail=FALSE;
	 }

	 if (!$validemail) {
		print 'Sorry, the email address you specified is not valid.<br>Please <a href="javascript:history.back()">try again</a>';
		exit;
	 }

	 //create user
	 if ($recv_newsletter) { $recv_newsletter = '1'; } else { $recv_newsletter = '0'; }
	 $reg_date=date('Y-m-d');
	 $sql = "UPDATE catusers
		 SET name='$username',
		    pass='$password1',
		    email='$email',
		    recv_newsletter='$recv_newsletter'
		 WHERE id='$id'
		 ";

	 $result = mysql_query($sql);
	 if (!$result) {
	     print 'There was a database error.<br>Please <a href="javascript:history.back()">try again</a>';
	 }

	 //set the cookie
	 setcookie('user',$username,$cookie_expires,$cookiepath,$domainname,0);
	 setcookie('pass',$password1,$cookie_expires,$cookiepath,$domainname,0);

	 //finally start sending to browser, only for php
	 ob_end_flush();

	 //print confirmation
	 print 'Your user account has been modified and the cookie has been set.';

} else {
?>
<?php
if ($HTTP_COOKIE_VARS['user'] && $HTTP_COOKIE_VARS['pass']) {
		       $tempusername = $HTTP_COOKIE_VARS['user'];
		       $temppassword = $HTTP_COOKIE_VARS['pass'];

		       $result = mysql_query("SELECT id,name,pass,email FROM catusers
			     WHERE name='$tempusername'
			     AND pass='$temppassword'");

				   if ($result) {
					   if (mysql_num_rows($result)>0) {
						$row = mysql_fetch_array($result);
						$loginok='1';
					} else {
						print 'Not logged in, please login first.';
					       }
				   } else {
					print 'Not logged in, please login first.';
				}
} else {
		print 'Not logged in, please login first.';
}
if ($loginok=='1') {
?>
	      <table width="92%" border="0" cellspacing="0" cellpadding="0" align="center">
		<tr>
		  <td height="72" valign="middle">
		    <div align="center"><b><font face="Verdana, Arial, Helvetica, sans-serif">Welcome
		      to your personal page, <?=$row['name']?>!<br>
		      You can edit your preferences here.</font></b></div>
		  </td>
		</tr>
	      </table>
	      <font face="Verdana, Arial, Helvetica, sans-serif" color="#ffff66" size="2"><b><br>
	      </b></font>

	      <form name="form2" method="post" action="<?=$PHP_SELF?>">
		<table width="92%" border="0" cellspacing="3" cellpadding="4" align="center">
		  <tr bgcolor="#003366">
		    <td width="33%" nowrap>
		      <div align="right"><i>Your username</i></div>
		    </td>
		    <td width="67%"><b>
		      <?=$row['name']?>
		      <input type="hidden" name="username" value="<?=$row['name']?>">
		      <input type="hidden" name="id" value="<?=$row['id']?>">
		      </b></td>
		  </tr>
		  <tr bgcolor="#003366">
		    <td width="33%" nowrap>
		      <div align="right"><i>Your password</i></div>
		    </td>
		    <td width="67%">
		      <input type="password" name="password1" size="30" maxlength="20" value="<?=$row['pass']?>">
		    </td>
		  </tr>
		  <tr bgcolor="#003366">
		    <td width="33%" nowrap>
		      <div align="right"><i>Your password again:</i></div>
		    </td>
		    <td width="67%">
		      <input type="password" name="password2" size="30" maxlength="20" value="<?=$row['pass']?>">
		    </td>
		  </tr>
		  <tr bgcolor="#003366">
		    <td width="33%" nowrap>
		      <div align="right"><i>eMail</i></div>
		    </td>
		    <td width="67%">
		      <input type="text" name="email" size="40" maxlength="100" value="<?=$row['email']?>">
		    </td>
		  </tr>
		  <tr bgcolor="#003366">
		    <td width="33%" nowrap height="25">
		      <div align="right"><i>Do you want to receive our weekly
			newsletter?</i></div>
		    </td>
		    <td width="67%" height="25">
		      <input type="checkbox" name="recv_newsletter" value="yes" checked>
		    </td>
		  </tr>
		  <tr bgcolor="#003366">
		    <td width="33%" valign="middle" nowrap height="47">
		      <div align="right">
			<input type="hidden" name="step" value="2">
		      </div>
		    </td>
		    <td width="67%" height="47">
		      <input type="button" name="Submit2" value="Change" OnClick=CheckForm("form2")>
		      <i>(You must turn on cookies in your browser)</i> </td>
		  </tr>
		</table>
			  </form>
	      <font face="Verdana, Arial, Helvetica, sans-serif" color="#ffff66" size="2"><b>
	      </b></font>
<?php }}
include('page_footer.inc.php'); ?>
