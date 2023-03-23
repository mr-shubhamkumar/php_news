<?php 
require_once "config.php";
session_start();
if(isset($_FILES['fileToUpload'])){
    $errors = array();

    $file_name = $_FILES['fileToUpload']['name'];
    $file_size = $_FILES['fileToUpload']['size'];
    $file_tmp = $_FILES['fileToUpload']['tmp_name'];
    $file_type = $_FILES['fileToUpload']['type'];
    $file_ext = end(explode('.', $file_name));
    $extensions = array('jpg','png','jpeg','mp4','gif');

    if(in_array($file_ext, $extensions) === false){
        $errors[''] = 'this extension file not allow , Please choose PNJ JPG file.';
    }

    if($file_size > 52428800){

        $errors[''] = 'File size must be 50 mb or lower.';
    }

    if(empty($errors) == true){
        move_uploaded_file($file_tmp, "upload/".$file_name);
    }else{
        print_r($errors);
        die('file errors');
    }
}

$title = mysqli_real_escape_string($con, $_POST['post_title']);
$description = mysqli_real_escape_string($con, $_POST['postdesc']);
$category = mysqli_real_escape_string($con, $_POST['category']);
$date = date("d, M,Y");
$author = $_SESSION['user_id'];

$sql = "INSERT INTO post (title ,description,category,post_date,author,post_img) 
       value ('$title','$description','$category','$date',$author,'$file_name');";
$sql .= "UPDATE category SET post = post + 1 WHERE category_id = {$category} ";

if(mysqli_multi_query($con,$sql)){
    header("location: post.php");
}else{
    echo "<div class='alert alert-danger'> Data not Post</div>";
}


?>