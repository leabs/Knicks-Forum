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
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['userID'])) {
  $loginUsername=$_POST['userID'];
  
  $_SESSION['userID']=$_POST['userID'];
  
  $password=$_POST['userPasswd'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "sessioncreate.php";
  $MM_redirectLoginFailed = "index2.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_knicksforum, $knicksforum);
  
  $LoginRS__query=sprintf("SELECT userID, userPasswd FROM userTable WHERE userID=%s AND userPasswd=SHA1(%s)",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $knicksforum) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Login to the Knicks Forum!</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="wrapper">
	<header role="banner"><img src="images/header.jpg" width="960" height="100" /></header><div id="col2">
    <div id="header2"> </div>
	  <div id="main2">
			
        <main role="main">
        <h1>Whoops! Error logging in, please try again!</h1>
           <form id="form1" name="form1" method="POST" action="<?php echo $loginFormAction; ?>" >
          <p align="center">
            <label for="userID">Enter Your Username:</label>
            <input name="userID" type="text" id="userID" size="15" maxlength="15" />
          </p>
          <p align="center">
            <label for="userPasswd">Enter Your Password</label>
            :
            <input name="userPasswd" type="password" id="userPasswd" size="15" maxlength="15" />
          </p>
          <p align="center">
            <input type="submit" name="button" id="button" value="Login" />
          </p>
          <p>&nbsp;</p>
        </form>
            <p class="ital">Not a memeber yet? <a href="regverify.php">Register here!</a></p>
        </main>
        
      </div>
      
            </div>

</div>

</body>
</html>