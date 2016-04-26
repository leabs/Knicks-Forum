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
?>

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
$updateSQL = sprintf("UPDATE commentTable SET commentText=%s WHERE commentID=%s",
GetSQLValueString($_POST['commentText'], "text"),
GetSQLValueString($_POST['commentID'], "int"));

mysql_select_db($database_knicksforum, $knicksforum);
$Result1 = mysql_query($updateSQL, $knicksforum) or die(mysql_error());

$updateGoTo = "comments.php";
if (isset($_SERVER['QUERY_STRING'])) {
$updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
$updateGoTo .= $_SERVER['QUERY_STRING'];
}
header(sprintf("Location: %s", $updateGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_SESSION['commentID'])) {
  $colname_Recordset1 = $_SESSION['commentID'];
}
mysql_select_db($database_knicksforum, $knicksforum);
$query_Recordset1 = sprintf("SELECT commentID, commentText, playerTable.firstName, playerTable.lastName, DAYNAME(datePosted) as day, MONTHNAME(datePosted) as month, DAY(datePosted) as date, YEAR(datePosted) as year FROM commentTable, playerTable WHERE commentID = %s AND playerTable.id = commentTable.id", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $knicksforum) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);$colname_Recordset1 = "-1";
if (isset($_SESSION['commentID'])) {
  $colname_Recordset1 = $_SESSION['commentID'];
}
mysql_select_db($database_knicksforum, $knicksforum);
$query_Recordset1 = sprintf("SELECT commentID, commentText, playerTable.firstName, playerTable.lastName, DAYNAME(datePosted) as day, MONTHNAME(datePosted) as month, DAY(datePosted) as date, YEAR(datePosted) as year, playerTable.firstName, playerTable.lastName, playerTable.pic FROM commentTable, playerTable WHERE commentID = %s AND playerTable.id = commentTable.id", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $knicksforum) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit My Comment</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="tiny_mce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({ 
selector: "textarea" 
	
	
	});
 ;
 
</script>
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
<h2>Welcome <?php echo $_SESSION['userID']; ?>! </h2>

<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">

   
      
  <table width="100%" border="1" cellspacing="1" cellpadding="1" id="commentTable">
  <tr>
    <td width="24%" height="25" id="tableHeader">&nbsp;</td>
    <td width="76%" height="25" id="tableHeader">Comment added <?php echo $row_Recordset1['day']; ?>, <?php echo $row_Recordset1['month']; ?> <?php echo $row_Recordset1['date']; ?>, <?php echo $row_Recordset1['year']; ?>
    </td>
  </tr>
  <tr>
    <td style="background-color:white;"> <p>Comment on:<br />
<?php echo $row_Recordset1['firstName']; ?><?php echo ' '.$row_Recordset1['lastName']; ?>
<br /><br />


<img src="images/<?php echo $row_Recordset1['pic']; ?>.jpg" width="100" height="100" /></p></td>
    <td valign="top" style="background-color:white;"><div align="left"><?php echo $row_Recordset1['commentText']; ?></div></td>
  </tr>
</table>
<br />

    </td>
</tr>

<tr valign="baseline">


</tr>
<tr valign="baseline">

<td><textarea name="commentText" cols="80" rows="5"><?php echo htmlentities($row_Recordset1['commentText'], ENT_COMPAT, 'UTF-8'); ?></textarea></td>
</tr>
<tr valign="baseline">
<td nowrap="nowrap" align="right"><center><input type="submit" class="leftr" value="Update record" /></center></td>

</tr>
</table>
<input type="hidden" name="MM_update" value="form1" />
<input type="hidden" name="commentID" value="<?php echo $row_Recordset1['commentID']; ?>" />
</form></main></div>
 
      
  </div>

</div>

</body>
</html>
<?php
mysql_free_result($Recordset1);
?>