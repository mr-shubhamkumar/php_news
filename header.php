<?php
include "config.php";
$page_title = basename($_SERVER['PHP_SELF']);

switch ($page_title) {
    case "single.php";
        if (isset($_GET['id'])) {
            $sql_title = "SELECT * from post where post_id = {$_GET['id']} ";
            $result_title = mysqli_query($con, $sql_title) or die('title query fail');
            $row_title = mysqli_fetch_assoc($result_title);
            $page_title = $row_title['title'];
        } else {
            $page_title = "Not  Found";
        }

        break;
    case "category.php";
        if (isset($_GET['cid'])) {
            $sql_title = "SELECT * from category where category_id = {$_GET['cid']} ";
            $result_title = mysqli_query($con, $sql_title) or die('title query fail');
            $row_title = mysqli_fetch_assoc($result_title);
            $page_title = $row_title['category_name'];
        } else {
            $page_title = "Not  Found";
        }

        break;
    case "author.php";
        if (isset($_GET['aid'])) {
            $sql_title = "SELECT * from user where user_id = {$_GET['aid']} ";
            $result_title = mysqli_query($con, $sql_title) or die('title query fail');
            $row_title = mysqli_fetch_assoc($result_title);
            $page_title = $row_title['username'];
        } else {
            $page_title = "Not Found";
        }
        break;
    case "index.php";
        $page_title = "Home Page";
        break;
    case "search.php";
        if (isset($_GET['search'])) {


            $page_title =  $_GET['search'];
        } else {
            $page_title = "Not  Found";
        }
        break;
    default:
        echo "News Site";
        break;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo  $page_title;  ?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- HEADER -->
    <div id="header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <?php

            $setting_sql = "SELECT * from setting ";
            $setting_res = mysqli_query($con, $setting_sql);
            $set_row = mysqli_fetch_assoc($setting_res);

            ?>
            <div class="row">
                <!-- LOGO -->
                <div class=" col-md-offset-4 col-md-4">
                    <!-- <a href="index.php" id="logo"><img src="admin/images/<?php echo $set_row['logo']; ?>"></a> -->
                    <a href="index.php" id="logo">
                        <h1>NEWS SITE</h1>
                        <!-- <h1><?php echo $set_row['websitename']; ?></h1> -->
                    </a>
                </div>
                
                <!-- /LOGO -->
            </div>
        </div>
    </div>
    <!-- /HEADER -->
    <!-- Menu Bar -->
    <div id="menu-bar">
        <div class="container">
            <div class="row">
                <?php
                if (isset($_GET['cid'])) {

                    $cat_id = $_GET['cid'];
                } else {
                    $cat_id = '';
                }

                $sql = "SELECT * FROM category where post > 0";
                $result = mysqli_query($con, $sql);
                if (mysqli_num_rows($result) > 0) {
                    $active = "";

                ?>
                    <div class="col-md-12">
                        <ul class='menu'>
                            <li><a href="index.php">Home</a></li>
                            <?php while ($row = mysqli_fetch_assoc($result)) {
                                if (isset($_GET['cid'])) {
                                    if ($row['category_id'] == $cat_id) {
                                        $active = "active";
                                    } else {
                                        $active = "";
                                    }
                                }

                                echo "<li><a class='{$active}' href='category.php?cid={$row['category_id']}'>{$row['category_name']}</a></li>";
                            } ?>


                        </ul>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- /Menu Bar -->