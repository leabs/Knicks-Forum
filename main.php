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
	$uid = $_SESSION['userID'];
  $insertSQL = sprintf("INSERT INTO playerTable (catID) VALUES (%s)",    GetSQLValueString($_POST['catID'], "int"));

  mysql_select_db($database_knicksforum, $knicksforum);
  $Result1 = mysql_query($insertSQL, $knicksforum) or die(mysql_error());
}

mysql_select_db($database_knicksforum, $knicksforum);
$query_Recordset1 = "SELECT * FROM categoryTable";
$Recordset1 = mysql_query($query_Recordset1, $knicksforum) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome to the Knicks Forum!</title>


<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>

<style>

html{
font-family: 'Source Sans Pro', sans-serif;
	background-image:url('images/bk.jpg');
}
.lower{
	background-color:#0953A0;}
thead{
	background-color:#C0C0C0;
	color:#fff;
}

tr{
	height:25px;
	padding-bottom:opx;
	margin-bottom:1px;
}
.table-striped{
border-style: solid;

}

.table-striped > tbody > tr:nth-child(2n+1) > td, .table-striped > tbody > tr:nth-child(2n+1) > th {
   background-color: #FF7518;
}





</style>
</head>

<body>
<div id="container">

<nav class="navbar navbar-inverse">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-center">
        <li><a href="main.php" >Home</a></li>
        <li><a href="playerbycat.php?catID=1">Players</a></li>


<li><a href="playersearch.php">Search</a></li>

<li><a href="editprofile.php">User Profile</a></li>

<li><a href="comments.php">My Comments</a></li>

              </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
    	<div class="container">
    	
          <div class="row">
                    
          
           <div class="col-sm-5">
          <div class="panel panel-primary">
          
           <table class="table table-striped lower"  >
          <tr>
            
    <td width="10%"><img src="images/avatars/<?php echo $_SESSION['avatar']; ?>.gif" width="87" height="87" align="top"  /></td>
    <td width="36%" valign="bottom"><h3 align="left" class="lefte" style="text-align:left"><b><?php echo " ".$_SESSION['userID']; "logged in" ?></b></h3>
      <p style="text-align:left">Forum Member</p></td>
    <td width="26%"><h3 align="center">&nbsp;</h3></td>
    <td width="28%" valign="bottom">
<p style="margin-top:80px;"><?php
// set the default timezone to use. Available since PHP 5.1
date_default_timezone_set('EST');


// Prints something like: Monday 8th of August 2005 03:12:46 PM
echo date('h:i A');


?></p>
</td>
  </tr>
</table>

</div>

<br>
</div>



<div class="row">
<div class="col-md-12">
<table class="table table-striped">
  <thead>
    <tr>
      <th style="width:40px;"> </th>
      <th>Forum</th>
      <th>Last Name</th>
      <th>Username</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th style="width:40px;" scope="row"><img class="img-responsive" src="images/forum.png" /></th>
      <td>Knicks Chat</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th  style="width:40px;" scope="row"><img class="img-responsive" src="images/forum.png" /></th>
      <td>General Discussion</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th  style="width:40px;" scope="row"><img class="img-responsive" src="images/forum.png" /></th>
      <td>Off Topic</td>
      <td colspan="2">Larry the Bird</td>
         </tr>
    <tr>
      <th  style="width:40px;" scope="row"><img class="img-responsive" src="images/forum.png" /></th>
      <td>Show And Tell</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th  style="width:40px;" scope="row"><img class="img-responsive" src="images/forum.png" /></th>
      <td>College Hoops</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th  style="width:40px;" scope="row"><img class="img-responsive" src="images/forum.png" /></th>
      <td>Other Sports</td>
      <td colspan="2">Larry the Bird</td>
        </tr>


  </tbody>
</table>
</div>


</div>

 
</div>
</div>
</div>



</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
