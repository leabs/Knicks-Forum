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

$colname_Recordset1 = "-1";
if (isset($_SESSION['userID'])) {
  $colname_Recordset1 = $_SESSION['userID'];
}
mysql_select_db($database_knicksforum, $knicksforum);
$query_Recordset1 = sprintf("SELECT commentID, DAYNAME(datePosted) as day, MONTHNAME(datePosted) as month, DAY(datePosted) as date, YEAR(datePosted) as year, commentTable.commentText FROM commentTable WHERE commentTable.userID = %s  ORDER BY commentTable.datePosted DESC", GetSQLValueString($colname_Recordset1, "text"));
$Recordset1 = mysql_query($query_Recordset1, $knicksforum) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My Comments</title>
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
<h2>Comments for: <span class="red"><?php echo $_SESSION['userID']; ?></span></h2>
<div>
<br />
</span>
</div>
<form id="form1" name="form1" method="post" action="updatecomment.php">
<table width="944" border="1" align="center">
<tr>
<td width="111" align="center" id="tableHeader"></td>
<td width="35" id="tableHeader"></td>
<td width="776" id="tableHeader">Comment</td>

</tr>
<?php do { ?>
<tr>
<td align="left" valign="middle" style="background-color:white">
<label><span class="datinfo"><?php echo $row_Recordset1['month']; ?>, <?php echo $row_Recordset1['date']; ?>, </span></label>

<span class="datinfo"><?php echo $row_Recordset1['year']; ?></span>

<td style="background-color:white"><input type="radio" name="commentID" value="<?php echo $row_Recordset1['commentID']; ?>" id="commentID" required = "required" /></td><td width="776" style="background-color:white"><div align="left"><?php echo $row_Recordset1['commentText']; ?></div></td>

</tr>
<?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?></span>
</table>
<br />

<span class="centered"><table width="745" border="1" align="center" class="centered">
<tr>
<td width="367" style="background-color:white"><label>
<input type="radio" name="action" value="edit" id="action_0" required = "required" />
Edit the Comment</label></td>

<td width="366" style="background-color:white"><label>
<input type="radio" name="action" value="delete" id="action_1" />
Delete the Comment</label></td>
</tr>
</table>
<p>
<input name="button" type="submit" id="button" value="Submit"/>&nbsp;&nbsp;&nbsp;&nbsp;
<input type="reset" name="button2" id="button2" value="Reset" />
</p>

</form></main></div>
 
      </div>
  </div>

</div>

</body>
</html>
<?php
mysql_free_result($Recordset1);
?>