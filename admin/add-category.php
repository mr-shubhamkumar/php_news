<?php include "header.php";
if ($_SESSION['user_role'] < 1) {
    header("location: post.php");
}
if (isset($_POST['save'])) { // if  input=name=save is click
    $cat = mysqli_real_escape_string($con, $_POST['cat']); //adding name input into var 
    

    $sql = "SELECT category_name FROM category where category_name = '$cat'"; // if user already exists send msg
    $result = mysqli_query($con, $sql) or die('add-user query fail'); // if query faild

    if (mysqli_num_rows($result) > 0) { //checking user exists
        echo "<p style='color:red; text-align:center;'> Username already exists</p>"; // if user already exists send msg
    } else { //if new user insert data in database 
        $sql1 = "INSERT INTO category 
        (category_name) 
        value
        ('{$cat}')"; //insert new user 

        if (mysqli_query($con, $sql1)) {
            header("location: category.php"); //redirect into users page
        }
    }
}

?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Add New Category</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form Start -->
                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" name="cat" class="form-control" placeholder="Category Name" required>
                    </div>
                    <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                </form>
                <!-- /Form End -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>