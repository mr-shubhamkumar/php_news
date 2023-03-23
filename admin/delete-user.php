<?php
include "config.php";
if ($_SESSION['user_role'] < 1) {
    header("location: post.php");
}
$delete_id = $_GET['id'];

$delete = "DELETE FROM user where user_id = $delete_id";
if(mysqli_query($con, $delete)){
    header("location: users.php");
}
?>