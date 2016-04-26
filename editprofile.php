<?php require_once('Connections/knicksforum.php'); ?>
<?php require_once('logincheck.php'); ?>
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE userTable SET avatar=%s WHERE userID=%s",
                       GetSQLValueString($_POST['avatar'], "int"),
                       GetSQLValueString($_POST['userID'], "text"));

  mysql_select_db($database_knicksforum, $knicksforum);
  $Result1 = mysql_query($updateSQL, $knicksforum) or die(mysql_error());

  $updateGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_SESSION['userID'])) {
  $colname_Recordset1 = $_SESSION['userID'];
}
mysql_select_db($database_knicksforum, $knicksforum);
$query_Recordset1 = sprintf("SELECT userID, avatar FROM userTable WHERE userID = %s", GetSQLValueString($colname_Recordset1, "text"));
$Recordset1 = mysql_query($query_Recordset1, $knicksforum) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit Your Profile</title>
<link href="style.css" rel="stylesheet" type="text/css" />

</head>

<body>

<div id="wrapper">
<header role="banner"><img src="images/header.jpg" width="960" height="100" /></header>
  <div id="navi">
  <table width="960" border=".5" id="tableHeader" height="23px">
        <tr>
          <td width="85" align="center"><a href="main.php">Home</a></td>
          <td width="146" align="center"><a href="playerbycat.php?catID=1">Current Players</a></td>
          <td width="98" align="center"><a href="playerbycat.php?catID=2">Legends</a></td>
          <td width="81" align="center"><a href="playerbycat.php?catID=3">All-Stars</a></td>
          
          <td width="165" align="center" class="fantasy"><a href="playerbycat.php?catID=4" class="fantasy">FANTASY ROSTER</a></td>
          <td width="115" align="center"><a href="playersearch.php">Player Search</a></td>
          <td width="115" align="center"><a href="editprofile.php">User Profile</a></td>
          <td width="121" align="center"><a href="comments.php">My Comments</a></td>
       
        </tr>
      </table>
</div>
 
  <div id="col2">

	  <div id="col3">
			
        <main role="main" id="main2" name="main2">
                <table width="940px" height="100" style="border-bottom: 1px solid black; background-image:url(images/tablebk.gif)" >
          <tr>
            
    <td width="10%"><img src="images/avatars/<?php echo $_SESSION['avatar']; ?>.gif" width="87" height="87" align="top"  /></td>
    <td width="36%" valign="bottom"><h3 align="left" class="lefte" style="text-align:left"><b><?php echo "Username: ".$_SESSION['userID']; "logged in" ?></b></h3>
      <p align="left" class="lefte" style="text-align:left">Knicks Forum Member</p></td>
    <td width="26%"><h3 align="center">&nbsp;</h3></td>
    <td width="28%" valign="bottom">
<p style="text-align:center"><?php
// set the default timezone to use. Available since PHP 5.1
date_default_timezone_set('EST');


// Prints something like: Monday 8th of August 2005 03:12:46 PM
echo date('l jS \ h:i A');


?></p>
</td>
  </tr>
</table>
   <br /><br />


   <h1 style="text-align:center">Edit your avatar! (<span class="b"><u>This will require you to log in again</u></span>)
     </style></h1>
   <br />

   <table width="800" border="0" align="center">
<tr>
      <td><img src="images/avatars/1.gif" width="150" height="150" /></td>
      <td><img src="images/avatars/2.gif" width="150" height="150" /></td>
      <td><img src="images/avatars/3.gif" width="150" height="150" /></td>
      <td><img src="images/avatars/4.gif" width="150" height="150" /></td>
      <td><img src="images/avatars/6.gif" width="150" height="150" />
      
      </td>
    </tr>
    
    
  </table>
     <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table height="152" align="center" style="width:950px" >
   
    <tr valign="baseline">
      <td width="68" align="right" nowrap="nowrap">&nbsp;</td>
      <td width="870" valign="baseline"><table width="802">
        <tr>
          <td width="150" height="37" class="center"><input type="radio" name="avatar" value="1" <?php if (!(strcmp(htmlentities($row_Recordset1['avatar'], ENT_COMPAT, 'utf-8'),1))) {echo "checked=\"checked\"";} ?> />Melo</td>
       
          <td width="155" class="center"><input type="radio" name="avatar" value="2" <?php if (!(strcmp(htmlentities($row_Recordset1['avatar'], ENT_COMPAT, 'utf-8'),2))) {echo "checked=\"checked\"";} ?> />
            Knicks Classic</td>
        
          <td width="154" class="center"><input type="radio" name="avatar" value="3" <?php if (!(strcmp(htmlentities($row_Recordset1['avatar'], ENT_COMPAT, 'utf-8'),3))) {echo "checked=\"checked\"";} ?> />
            Court</td>
       
          <td width="155" class="center"><input type="radio" name="avatar" value="4" <?php if (!(strcmp(htmlentities($row_Recordset1['avatar'], ENT_COMPAT, 'utf-8'),4))) {echo "checked=\"checked\"";} ?> />
            NYC</td>
       
          <td width="164" class="center"><input type="radio" name="avatar" value="6" <?php if (!(strcmp(htmlentities($row_Recordset1['avatar'], ENT_COMPAT, 'utf-8'),5))) {echo "checked=\"checked\"";} ?> />
            Jim B</td>
        </tr>
      </table></td>
    </tr>
    <tr valign="baseline">
      <td height="50" align="right" nowrap="nowrap">&nbsp;</td>
      <td><center><input type="submit" class="center" value="Update" /></center></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="userID" value="<?php echo $row_Recordset1['userID']; ?>" />
</form>
</main>
</div>
</div>



</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
