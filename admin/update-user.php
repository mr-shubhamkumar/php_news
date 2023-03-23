<?php include "header.php";

if (isset($_POST['submit'])) { // if  input=name=save is click
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']); //adding hide  input into var 
    $fname = mysqli_real_escape_string($con, $_POST['f_name']); //adding name input into var 
    $lname = mysqli_real_escape_string($con, $_POST['l_name']); //adding lname input into var
    $user = mysqli_real_escape_string($con, $_POST['username']); //adding user input into var
    $role = mysqli_real_escape_string($con, $_POST['role']); //adding role input into var

   
        $update = "UPDATE user set first_name='$fname',last_name='$lname',username='$user',role='$role' where user_id = $user_id"; //update new user 

        if (mysqli_query($con, $update)) {
            header("location: users.php"); //redirect into users page
        }
    
}
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Modify User Details</h1>
            </div>
            <div class="col-md-offset-4 col-md-4">
                <?php
                $edit_id = $_GET['id'];
                $sql = "SELECT * FROM user where user_id = $edit_id"; // show user data
                $result = mysqli_query($con, $sql) or die('query fail'); // if query fail
                if (mysqli_num_rows($result) > 0) {

                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <!-- Form Start -->
                        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                            <div class="form-group">
                                <input type="hidden" name="user_id" class="form-control" value="<?php echo $row['user_id'] ?>" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="f_name" class="form-control" value="<?php echo $row['first_name'] ?>" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" name="l_name" class="form-control" value="<?php echo $row['last_name'] ?>" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>User Name</label>
                                <input type="text" name="username" class="form-control" value="<?php echo $row['username'] ?>" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>User Role</label>
                                <select class="form-control" name="role" value="<?php echo $row['role']; ?>">
                                    <?php
                                    if ($row['role'] == 1) {
                                        echo '<option selected value="1">Admin</option>';
                                        echo '<option value="0">normal User</option>';
                                    }else{
                                        echo '<option  value="1">Admin</option>';
                                        echo '<option selected value="0">normal User</option>';
                                    }
                                    ?>
                                   
                                </select>
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                        </form>
                        <!-- /Form -->
                <?php }
                } ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>