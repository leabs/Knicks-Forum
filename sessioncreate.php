<?PHP 
session_start();
mysql_connect("localhost", "smleabo", "cis231");
mysql_select_db("leabo");

$uid = $_SESSION['userID'];
$result = mysql_query("SELECT avatar FROM userTable where userID = '$uid'");
$row = mysql_fetch_array($result);
$_SESSION['avatar'] = $row[0];

header("Location: main.php");
?>







