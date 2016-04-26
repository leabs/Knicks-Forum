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
	$id=$_SESSION['id'];
	$avatar=$_SESSION['avatar'];
  $insertSQL = sprintf("INSERT INTO commentTable (commentText, id, userID, avatar) VALUES (%s, $id, '$uid', '$avatar')",
                       GetSQLValueString($_POST['commentText'], "text"));

  mysql_select_db($database_knicksforum, $knicksforum);
  $Result1 = mysql_query($insertSQL, $knicksforum) or die(mysql_error());

  $insertGoTo = "player.php?id=".$_SESSION['id'];
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_GET['id'])) {
	$_SESSION['id']=$_GET['id'];
  $colname_Recordset1 = $_GET['id'];
}
$colname_Recordset1 = "-1";
if (isset($_GET['id'])) {
  $colname_Recordset1 = $_GET['id'];
}
mysql_select_db($database_knicksforum, $knicksforum);
$query_Recordset1 = sprintf("SELECT firstName, lastName, playerNumber, `position`, highlight, pic FROM playerTable WHERE id = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $knicksforum) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);$colname_Recordset1 = "-1";
if (isset($_GET['id'])) {
  $colname_Recordset1 = $_GET['id'];
}
mysql_select_db($database_knicksforum, $knicksforum);
$query_Recordset1 = sprintf("SELECT firstName, lastName, playerNumber, `position`, highlight, pic FROM playerTable WHERE id = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $knicksforum) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$colname_Recordset2 = "-1";
if (isset($_GET['id'])) {
  $colname_Recordset2 = $_GET['id'];
}
mysql_select_db($database_knicksforum, $knicksforum);
$query_Recordset2 = sprintf("SELECT userID, MONTH(datePosted) as month, avatar, commentText, DAY(datePosted) as day, YEAR(datePosted) as year FROM commentTable WHERE id = %s ORDER BY commentTable.datePosted DESC", GetSQLValueString($colname_Recordset2, "int"));
$Recordset2 = mysql_query($query_Recordset2, $knicksforum) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="tiny_mce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({ 
selector: "textarea" 
	
	
	});
 ;
 
</script>







<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ' '.$row_Recordset1['firstName'];' ' ?> <?php echo $row_Recordset1['lastName']; ?>'s info</title>
<link href="style.css" rel="stylesheet" type="text/css" />

</head>

<body>
<div id="wrapper">
 <header role="banner"><div id="header">
  
  
  </div></header>
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
   
			
        <main role="main" id="main2" name="main2"><table width="940px" height="100" style="border-bottom: 1px solid black; background-image:url(images/tablebk.gif)" >
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
</table><br />

          <table border="1" align="center">
            <tr>
              <td width="354" id="tableHeader"></td>
              <td width="570" id="tableHeader">Highlights</td>
              
            </tr>
            <?php do { ?>
              <tr>
                <td height="50" style="padding-left: 15px; background-color:white;" ><h2><?php echo ' '.$row_Recordset1['firstName'];' ' ?> <?php echo $row_Recordset1['lastName']; ?></h2>
                  <p>Jersey Number:<?php echo ' '.$row_Recordset1['playerNumber']; ?></p>
                  <p>Position:<?php echo ' '.$row_Recordset1['position']; ?></p>
                  <img src="images/<?php echo $row_Recordset1['pic']; ?>.jpg" width="100" height="100" />
                  </td>
                <td><iframe width="560" height="315" src="//www.youtube.com/embed/<?php echo $row_Recordset1['highlight']; ?>" frameborder="0" allowfullscreen></iframe></td>
                
              </tr>
              <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
          </table><br />

<?php
if($totalRows_Recordset2 == 0)
{
echo "<h2>There are no comments for this player yet</h2>";
}
else
{
?>

          <table border="1" cellpadding="1" cellspacing="1" height="150">
            <tr>
              <td width="150" height="25" id="tableHeader"></td>
              <td width="800"id="tableHeader"height="25" >Comment</td>
              
            </tr>
            <?php do { ?>
              <tr>
                <td height="85" style="background-color:white"><?php echo $row_Recordset2['userID']; ?><br /><img src="images/avatars/<?php echo $row_Recordset2['avatar']; ?>.gif" width="87" height="87" align="top"  />
<br />

                
                  <table width="100%" border="1" cellspacing="2" cellpadding="3">
                  <tr>
                      
                    </tr>
                    <tr>
                      
                    </tr>
                  </table></td>
                
                <td valign="top" id="commentTable" style="background-color:white"><div align="left"><span class="ital"><?php echo $row_Recordset2['month']; ?>/<?php echo $row_Recordset2['day']; ?>/<?php echo $row_Recordset2['year']; ?></span><br />
                  <?php echo $row_Recordset2['commentText']; ?></div></td>
                
              </tr>
              <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
          </table>
          
          <?php
}
?><br />
          <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
            <table align="center">
              <tr valign="baseline">
                
                <td><textarea name="commentText" cols="50" rows="5"></textarea></td>
              </tr>
              <tr valign="baseline">
                
                <td><input type="submit" value="Submit Comment" /></td>
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
