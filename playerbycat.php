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

$colname_Recordset1 = "-1";
if (isset($_GET['id'])) {
  $colname_Recordset1 = $_GET['id'];
}
mysql_select_db($database_knicksforum, $knicksforum);
$query_Recordset1 = sprintf("SELECT title FROM categoryTable WHERE id = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $knicksforum) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$colname_Recordset2 = "-1";
if (isset($_GET['catID'])) {
  $colname_Recordset2 = $_GET['catID'];
}
mysql_select_db($database_knicksforum, $knicksforum);
$query_Recordset2 = sprintf("SELECT id, firstName, lastName, playerNumber, `position`, highlight, pic, userID FROM playerTable WHERE catID = %s", GetSQLValueString($colname_Recordset2, "int"));
$Recordset2 = mysql_query($query_Recordset2, $knicksforum) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Player by Category Result</title>
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
   <h2 class="centered">Welcome <?php echo $_SESSION['userID']; ?>! <br />
Here are the players that match the category <?php echo $row_Recordset1['title']; ?></h2>
<br />
<table border="1" cellpadding="1" cellspacing="1" width="940">
  <tr>
    <td width="248" id="tableHeader">Name</td>
    
    <td width="265" id="tableHeader">Number</td>
    <td width="229" id="tableHeader">Position</td>
    
    <td width="185" id="tableHeader">Picture</td>
  </tr>
  <?php do { ?>
    <tr>
      <td valign="middle" style="background-color:white"><a href = "player.php?id=<?php echo $row_Recordset2['id']; ?>" ><?php echo $row_Recordset2['firstName']; ?><?php echo ' '.$row_Recordset2['lastName']; ?></a><br />
<p>Added by: </p><?php echo $row_Recordset2['userID']; ?></td>
      <td style="background-color:white"><?php echo $row_Recordset2['playerNumber']; ?></td>
      <td style="background-color:white"><?php echo $row_Recordset2['position']; ?></td>
      
      
      
      
      <td style="background-color:white"><img src="images/<?php echo $row_Recordset2['pic']; ?>.jpg" width="100" height="100" /></td>
    </tr>
    <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
</table>
        </main>
      </div>
  </div>

</div>

</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>
