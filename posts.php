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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	$uid=$_SESSION['userID'];
$threadID = $_SESSION['threadID'];

  $insertSQL = sprintf("INSERT INTO commentTable (commentText, threadID, userID) VALUES (%s,$threadID, '$uid')",
                       GetSQLValueString($_POST['commentText'], "text"));

  mysql_select_db($database_knicksforum, $knicksforum);
  $Result1 = mysql_query($insertSQL, $knicksforum) or die(mysql_error());

  $insertGoTo = "posts.php?threadID=".$SESSION['threadID'];
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_GET['threadID'])) {
	$_SESSION['threadID'] = $_GET['threadID'];

  $colname_Recordset1 = $_GET['threadID'];
}
mysql_select_db($database_knicksforum, $knicksforum);
$query_Recordset1 = sprintf("SELECT threadTitle FROM threadTable WHERE threadID = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $knicksforum) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$colname_Recordset2 = "-1";
if (isset($_GET['threadID'])) {
  $colname_Recordset2 = $_GET['threadID'];
}
mysql_select_db($database_knicksforum, $knicksforum);
$query_Recordset2 = sprintf("SELECT userID, MONTHNAME(datePosted) as month, commentText, DAY(datePosted) as day, YEAR(datePosted) as year FROM commentTable WHERE threadID = %s", GetSQLValueString($colname_Recordset2, "int"));
$Recordset2 = mysql_query($query_Recordset2, $knicksforum) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Search For a Player</title>
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
    <table width="960" border=".5" id="tableHeader" height="20">
        <tr>
          <td width="160px" height="16" align="center"><a href="main.php">Home</a></td>
          <td width="160px" align="center"><a href="currentseason.php">Current Players</a></td>
          <td width="160px" align="center"><a href="forum.php">Message Board</a></td>
          <td width="160px" align="center"><a href="editprofile.php">User Profile</a></td>
          <td width="160px" align="center"><a href="comments.php">My Comments</a></td>
          <td width="160px" align="center"><a href="commentsearch.php">Search Comments</a></td>
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
         <p><br />
           <?php echo $row_Recordset1['threadTitle']; ?><br />
           
           <br />
           
         </p>
         <table height="195" border="0" cellpadding="1" cellspacing="1">
           <tr>
             <table width="100%" border="1" cellspacing="2" cellpadding="3">
  <tr>
    <td><?php echo $row_Recordset2['userID']; ?></td>
  </tr>
  <tr>
    <td><?php echo $row_Recordset2['userID']; ?><?php echo $row_Recordset2['month']; ?><?php echo $row_Recordset2['day']; ?><?php echo $row_Recordset2['year']; ?></td>
  </tr>
</table>
<td width="437">userID</td>
             
             <td width="496">commentText</td>
             
           </tr>
           <?php do { ?>
             <tr><table width="100%" border="1" cellspacing="2" cellpadding="3">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>

               <td height="170"><?php echo $row_Recordset2['userID']; ?><?php echo $row_Recordset2['month']; ?><?php echo $row_Recordset2['day']; ?><?php echo $row_Recordset2['year']; ?></td>
               <td><?php echo $row_Recordset2['commentText']; ?></td>
               
             </tr>
             <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
         </table>

<br />
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right" valign="top"></td>
      <td><textarea name="area" cols="50" rows="5"></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Insert record" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
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
