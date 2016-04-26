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

mysql_select_db($database_knicksforum, $knicksforum);
$query_Recordset1 = "SELECT userID, avatar, dateJoined FROM userTable";
$Recordset1 = mysql_query($query_Recordset1, $knicksforum) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$maxRows_Recordset2 = 10;
$pageNum_Recordset2 = 0;
if (isset($_GET['pageNum_Recordset2'])) {
  $pageNum_Recordset2 = $_GET['pageNum_Recordset2'];
}
$startRow_Recordset2 = $pageNum_Recordset2 * $maxRows_Recordset2;

mysql_select_db($database_knicksforum, $knicksforum);
$query_Recordset2 = "SELECT pic, season, playerName, gamesPlayed, minutesPlayed, pointsPerGame, offr, defr, rpg, apg, spg FROM statsTable";
$query_limit_Recordset2 = sprintf("%s LIMIT %d, %d", $query_Recordset2, $startRow_Recordset2, $maxRows_Recordset2);
$Recordset2 = mysql_query($query_limit_Recordset2, $knicksforum) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);

if (isset($_GET['totalRows_Recordset2'])) {
  $totalRows_Recordset2 = $_GET['totalRows_Recordset2'];
} else {
  $all_Recordset2 = mysql_query($query_Recordset2);
  $totalRows_Recordset2 = mysql_num_rows($all_Recordset2);
}
$totalPages_Recordset2 = ceil($totalRows_Recordset2/$maxRows_Recordset2)-1;
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Current Roster</title>
<link href="style.css" rel="stylesheet" type="text/css" />

</head>

<body>
<div id="wrapper">
  <header role="banner"><img src="images/header.jpg" width="960" height="100" /></header>
  <div id="navi">
    <table width="960" border=".5" id="tableHeader" height="23px">
        <tr>
          <td width="160px" align="center"><a href="main.php">Home</a></td>
          <td width="160px" align="center"><a href="currentseason.php">Current Players</a></td>
          <td width="160px" align="center"><a href="playersearch.php">Player Search</a></td>
          <td width="160px" align="center"><a href="editprofile.php">User Profile</a></td>
          <td width="160px" align="center"><a href="comments.php">My Comments</a></td>
          <td width="160px" align="center"><a href="threads.php">Message Board</a></td>
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
<br />

<center><iframe width="560" height="315" src="//www.youtube.com/embed/zqFxrv7NPBs" frameborder="0" allowfullscreen></iframe></center>
<br />

        <h1 style="text-align:center">2014-2015 Season as of 11/7/14</h1>
      
        
        <p style="text-align: center; font-style: italic; font-size: 14px;">offr = Offense Rebound, defr = Defensive Rebound, rpg = Rebound Per Game, apg = Assit Per Game, spg = Steal Per Game</p>
          <table border="0" margin="3px" align="center" style="text-align:center">
            <tr>
      
      <td id="tableHeader" width="100px"> - </td>
      <td id="tableHeader" width="200px">Player</td>
      <td id="tableHeader" width="60px">Games </td>
      <td id="tableHeader" width="100px">Minutes PG</td>
      <td id="tableHeader" width="100px">Points PG</td>
      <td id="tableHeader" width="60px">offr</td>
      <td id="tableHeader" width="60px">defr</td>
      <td id="tableHeader" width="60px">rpg</td>
      <td id="tableHeader" width="60px">apg</td>
      <td id="tableHeader" width="60px">spg</td>
    </tr>
    <?php do { ?>
      <tr>
        
        <td width="100px"><img src="images/<?php echo $row_Recordset2['pic']; ?>.jpg" width="100" height="100" /></td>
        <td width="200px" id="tableVar" ><?php echo $row_Recordset2['playerName']; ?></td>
        <td width="60px"><?php echo $row_Recordset2['gamesPlayed']; ?></td>
        <td width="100px" id="tableVar"><?php echo $row_Recordset2['minutesPlayed']; ?></td>
        <td width="100px"><?php echo $row_Recordset2['pointsPerGame']; ?></td>
        <td width="60px" id="tableVar"><?php echo $row_Recordset2['offr']; ?></td>
        <td width="60px"><?php echo $row_Recordset2['defr']; ?></td>
        <td width="60px" id="tableVar"><?php echo $row_Recordset2['rpg']; ?></td>
        <td width="60px"><?php echo $row_Recordset2['apg']; ?></td>
        <td width="60px" id="tableVar"><?php echo $row_Recordset2['spg']; ?></td>
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
