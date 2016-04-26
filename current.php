<?php require_once('Connections/knicksforum.php'); ?>
<?php require_once('logincheck.php'); ?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Search For a Player</title>
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
   
<br />

<table border="0" margin="1px" align="center" width="610" style="text-align: center; color: #000;">
            <tr>
      
     
 
    </tr>
          <tr>
        
        <td width="100"><a href="player.php?id=1" ><img src="images/playerMelo.jpg" width="100" height="100" /></a></td>
        <td width="210" ><a href="player.php?id=1" >Carmelo Anthony</a></td>

      </tr>
            <tr>
        
        <td width="100"><a href="player.php?id=2" ><img src="images/playerIman.jpg" width="100" height="100" /></a></td>
        <td width="210"  ><a href="player.php?id=2" >Iman Shumpert</a></td>
       
      </tr>
            <tr>
        
        <td width="100"><a href="player.php?id=3" ><img src="images/playerStat.jpg" width="100" height="100" /></a></td>
        <td width="210"  ><a href="player.php?id=3" >Amar'e Stoudemire</a></td>
    
      </tr>
         
            <tr>
        
        <td width="100"><a href="player.php?id=4" ><img src="images/playerTHJ.jpg" width="100" height="100" /></a></td>
        <td width="210"  ><a href="player.php?id=4" >Tim Hardaway Jr.</a></td>
   
      </tr>
            <tr>
        
        <td width="100"><a href="player.php?id=5" ><img src="images/playerJR.jpg" width="100" height="100" /></a></td>
        <td width="210" ><a href="player.php?id=5" >J.R. Smith</a></td>
      
      </tr>
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
