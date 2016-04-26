<?php session_start(); ?>
<?php require_once('Connections/knicksforum.php'); ?>



<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
	$_SESSION['userID'] = $_POST['userID'];
	$_SESSION['avatar'] = $_POST['avatar'];
  $insertSQL = sprintf("INSERT INTO userTable (userID, userPasswd, avatar) VALUES (%s, SHA1(%s), %s)",
                       GetSQLValueString($_POST['userID'], "text"),
                       GetSQLValueString($_POST['userPasswd'], "text"),
                       GetSQLValueString($_POST['avatar'], "int"));

  mysql_select_db($database_knicksforum, $knicksforum);
  $Result1 = mysql_query($insertSQL, $knicksforum) or die(mysql_error());

  $insertGoTo = "sessioncreate.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Knicks Fan Forum! Register Here!</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body background="images/background.gif">

<p>&nbsp;</p>
<div id="wrapper">
	<header role="banner"><img src="images/header.jpg" width="960" height="100" /></header><div id="col2">
    <div id="header2"> </div>
		<div id="main2">
			<nav role="navigation"></nav>
            <main role="main2">
  <h1 class="h1">Please register to use the site!</h1>
  <p class="ital">Note: passwords must contain both an uppercase and lowercase letter and be between 6 and 12 characters long.</p>
  <form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">User ID:</td>
      <td><input type="text" name="userID" value="" size="15" pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{4,15}$" title="userID must be between 4 and 15 characters, start with a letter, and contain only letters and numbers" maxlength="15" required/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Password:</td>
      <td><input type="password" name="userPasswd" id="userPasswd" value="" size="15" pattern="^(?=.*[A-Z])(?=.*[a-z]).{6,12}$" title="The password must be between 6 and 12 characters, and include at least 1 upper case letter, 1 lowercase letter" maxlength="15" required /></td>
    </tr>
    <tr valign="baseline">
    <td nowrap="nowrap" align="right">Re-enter User Password:</td>
    <td><input type="password" name="userPasswd2" id="userPasswd2" size="15" maxlength="15" required/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Avatar:</td>
      <td><input type="hidden" name="avatar" value="" s /></td>
    </tr>
    <tr valign="baseline">
      
      
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form2" />



  <table width="800" border="0" align="center">
    <tr>
      <td><img src="images/avatars/1.gif" width="150" height="150" /></td>
      <td><img src="images/avatars/2.gif" width="150" height="150" /></td>
      <td><img src="images/avatars/3.gif" width="150" height="150" /></td>
      <td><img src="images/avatars/4.gif" width="150" height="150" /></td>
      <td><img src="images/avatars/5.gif" width="150" height="150" /></td>
    </tr>
    <tr>
      <td height="75"><center><input name="avatar" type="radio" id="avatar6" value="1" checked="checked" /></center>
        <label for="avatar6"></label>
<label for="avatar1"></label></td>
      <td><center><input type="radio" name="avatar" id="avatar2" value="2" />
        <label for="avatar2"></label></center></td>
      <td><center><input type="radio" name="avatar" id="avatar3" value="3" />
        <label for="avatar3"></label></center></td>
      <td><center><input type="radio" name="avatar" id="avatar4" value="4" />
        <label for="avatar4"></label></center></td>
      <td><center><input type="radio" name="avatar" id="avatar5" value="5" />
        <label for="avatar5"></label></center></td>
    </tr>
  </table>
  <p align="center">
    <input type="submit" value="Sign Up!" />
</p>
    <p>&nbsp;</p>
            </form>
            
            <script>
			var userPasswd2 = document.getElementById('userPasswd2');
			var userPasswd = document.getElementById('userPasswd');
			
			var checkPasswordValidity = function() {
			if (userPasswd.value != userPasswd2.value) {
			userPasswd.setCustomValidity('Passwords must match.');
			} else {
			userPasswd.setCustomValidity('');
			} 
			};
			userPasswd.addEventListener('change', checkPasswordValidity, false);
			userPasswd2.addEventListener('change', checkPasswordValidity, false);
			</script>
            
            

</main>
<h2 >Already a member? <a href="index.php">Log in here!</a></h2>
</div>
            </div>

</div>
</body>
</html>