<?php
include "config.php";

$delete_id = $_GET['id'];

$delete = "DELETE FROM category where category_id = $delete_id";
if(mysqli_query($con, $delete)){
    header("location: category.php");
}
