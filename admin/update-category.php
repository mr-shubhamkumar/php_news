<?php include "header.php";
if (isset($_POST['submit'])) { // if  input=name=save is click
    $cat_id = mysqli_real_escape_string($con, $_POST['cat_id']); //adding hide  input into var 
    $cat_name = mysqli_real_escape_string($con, $_POST['cat_name']); //adding name input into var 
    


    $update = "UPDATE category  set category_name='$cat_name' where category_id  = $cat_id"; //update new user 

    if (mysqli_query($con, $update)) {
        header("location: category.php"); //redirect into users page
    }
}

?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="adin-heading"> Update Category</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <?php
                $edit_id = $_GET['id'];
                $sql = "SELECT * FROM category where category_id  = $edit_id"; // show user data
                $result = mysqli_query($con, $sql) or die('query fail'); // if query fail
                if (mysqli_num_rows($result) > 0) {

                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <form action="" method="POST">
                            <div class="form-group">
                                <input type="hidden" name="cat_id" class="form-control" value="<?php echo $row['category_id'] ?>" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>Category Name</label>
                                <input type="text" name="cat_name" class="form-control" value="<?php echo $row['category_name'] ?>" placeholder="" required>
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                        </form>
                <?php }
                } ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>