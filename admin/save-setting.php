<?php 

include "config.php";
if(empty($_FILES['logo']['name'])){

    $file_name = $_POST['logo'];


}else{

    $errors = array();

    $file_name = $_FILES['logo']['name'];
    $file_size = $_FILES['logo']['size'];
    $file_tmp = $_FILES['logo']['tmp_name'];
    $file_type = $_FILES['logo']['type'];
    $file_ext = end(explode('.', $file_name));
    $extensions = array('jpg', 'png', 'jpeg', 'mp4', 'gif');

    if (in_array($file_ext, $extensions) === false) {
        $errors[''] = 'this extension file not allow , Please choose PNJ JPG file.';
    }

    if ($file_size > 52428800) {

        $errors[''] = 'File size must be 50 mb or lower.';
    }

    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, "images/" . $file_name);
    } else {
        print_r($errors);
        die('file errors');
    }  
}

  $sql = "UPDATE setting SET websitename='{$_POST['website_name']}' ,logo ='{$file_name}'  ,footerdesc='{$_POST['footer_desc']}'

 ";

$result = mysqli_query($con ,$sql);
if($result){

    header("location: post.php");
}else{
    echo "Query fail";
}
