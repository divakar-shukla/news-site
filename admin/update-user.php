<?php 

include "header.php";


if($_SESSION["role"] == 0){
  header("Location: http://localhost/news-site/admin/post.php");
};

if(isset($_GET["id"])){
  $user_id =  $_GET["id"];
}else{
  header("location: http://localhost/news-site/admin/users.php");
};
if(isset($_POST["submit"])){
 include "config.php";
 $userid = mysqli_real_escape_string($conn, $_POST["user_id"]);
 $fname = mysqli_real_escape_string($conn, $_POST["f_name"]);
 $lname = mysqli_real_escape_string($conn, $_POST["l_name"]);
 $username = mysqli_real_escape_string($conn, $_POST["username"]);
 $role = mysqli_real_escape_string($conn, $_POST["role"]);

$sql = " UPDATE user SET first_name = '{$fname}', last_name = '{$lname}', username = '{$username}', role = '{$role}' WHERE user_id = '{$userid}'";

if($result2 = mysqli_query($conn, $sql)){
    header("location: http://localhost/news-site/admin/users.php");
};

}else{
 
  $sql2 = "SELECT user_id, first_name, last_name, username, role FROM user WHERE user_id = '{$user_id}'";
  $result = mysqli_query($conn, $sql2) or die("error in table creation " . mysqli_error($conn));

  if(mysqli_num_rows($result)>0){

    while($row = mysqli_fetch_assoc($result)){


// echo $user_id
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Modify User Details</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">
        
                  <!-- Form Start -->
                  <form  action="" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="user_id" class="form-control" value="<?php echo $row["user_id"]; ?>">
                      </div>
                          <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="f_name" class="form-control" value=" <?php echo $row["first_name"]; ?>" required>
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="l_name" class="form-control" value=" <?php echo $row["last_name"]; ?>" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="username" class="form-control" value=" <?php echo $row["username"]; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role">
                            <?php
                            if($row["role"] == 1){
                              echo "<option value='0'>Normal User</option>
                                <option value='1' selected>Admin</option>";
                            }else{
                                 echo "<option value='0' selected>Normal User</option>
                                    <option value='1' >Admin</option>";
                            };

                            ?>
                        <!-- <option value="1">admin</option> -->
                          </select>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                  </form>
                  <!-- /Form -->
              
              </div>
          </div>
      </div>
  </div>
 
<?php

      };

  };
};
include "footer.php"; 
?>
