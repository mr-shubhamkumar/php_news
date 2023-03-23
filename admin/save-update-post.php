<?php 

include "config.php";
if(empty($_FILES['new-image']['name'])){

    $file_name = $_POST['old-image'];


}else{

    $errors = array();

    $file_name = $_FILES['new-image']['name'];
    $file_size = $_FILES['new-image']['size'];
    $file_tmp = $_FILES['new-image']['tmp_name'];
    $file_type = $_FILES['new-image']['type'];
    $file_ext = end(explode('.', $file_name));
    $extensions = array('jpg', 'png', 'jpeg', 'mp4', 'gif');

    if (in_array($file_ext, $extensions) === false) {
        $errors[''] = 'this extension file not allow , Please choose PNJ JPG file.';
    }

    if ($file_size > 52428800) {

        $errors[''] = 'File size must be 50 mb or lower.';
    }

    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, "upload/" . $file_name);
    } else {
        print_r($errors);
        die('file errors');
    }  
}

  $sql = "UPDATE post SET title='{$_POST['post_title']}' ,description ='{$_POST['postdesc']}' ,category={$_POST['category']} ,post_img='{$file_name}'
where post_id ={$_POST['post_id']} ;";
if($_POST['old_category'] != $_POST['category'] ){

    $sql .= "UPDATE category SET post = post - 1 where category_id = {$_POST['old_category']}";
    $sql .= "UPDATE category SET post = post + 1 where category_id = {$_POST['category']}";
}

$result = mysqli_multi_query($con ,$sql);
if($result){

    header("location: post.php");
}else{
    echo "Query fail";
}

?>