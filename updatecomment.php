<?php
session_start();
$_SESSION['commentID'] = $_POST['commentID'];
if($_POST['action'] == "delete")
{
header("Location: deletecomment.php");
}
if($_POST['action'] == "edit")
{
header("Location: editcomment.php");
}
?>