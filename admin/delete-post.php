<?php
include "config.php";
$delete_id = $_GET['id'];

$cat_id = $_GET['catid'];

$sql1 = "SELECT * FROM post where post_id = {$delete_id}";
$result = mysqli_query($con,$sql1) or die("select query fail");
$row = mysqli_fetch_assoc($result);

unlink("upload/".$row['post_img']);

$sql = "DELETE FROM post where post_id = {$delete_id};";
$sql.= "UPDATE category SET post = post - 1 where category_id = {$cat_id}";

if (mysqli_multi_query($con, $sql)) {
    header("location: post.php");
}else{
    echo "Query fail";
}
?>