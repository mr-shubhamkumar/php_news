<?php include "header.php";
if ($_SESSION['user_role'] < 1) {
    header("location: post.php");
}
if(isset($_POST['save'])){ // if  input=name=save is click
    $fname = mysqli_real_escape_string($con,$_POST['fname']); //adding name input into var 
    $lname = mysqli_real_escape_string($con,$_POST['lname']);//adding lname input into var
    $user = mysqli_real_escape_string($con,$_POST['user']);//adding user input into var
    $password = mysqli_real_escape_string($con,$_POST['password']);//adding password input into var
    $role = mysqli_real_escape_string($con,$_POST['role']);//adding role input into var

    $sql = "SELECT username FROM user where username = '$user'";// if user already exists send msg
    $result = mysqli_query($con,$sql) or die('add-user query fail'); // if query faild

    if(mysqli_num_rows($result) > 0){//checking user exists
        echo "<p style='color:red; text-align:center;'> Username already exists</p>";// if user already exists send msg
    }else{//if new user insert data in database 
        $sql1 = "INSERT INTO user 
        (first_name,last_name,username,password,role) 
        value
        ('{$fname}','{$lname}','{$user}','{$password}','{$role}')"; //insert new user 

        if(mysqli_query($con,$sql1)){
            header("location: users.php"); //redirect into users page
        }
    }

}
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add User</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form  action="<?php $_SERVER['PHP_SELF'];?>" method ="POST" autocomplete="off">
                      <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                      </div>
                          <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="user" class="form-control" placeholder="Username" required>
                      </div>

                      <div class="form-group">
                          <label>Password</label>
                          <input type="password" name="password" class="form-control" placeholder="Password" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" >
                              <option value="0">Normal User</option>
                              <option value="1">Admin</option>
                          </select>
                      </div>
                      <input type="submit"  name="save" class="btn btn-primary" value="Save" required />
                  </form>
                   <!-- Form End-->
               </div>
           </div>
       </div>
   </div>
<?php include "footer.php"; ?>
