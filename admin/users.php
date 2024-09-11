<?php include "header.php";
if($_SESSION["role"] == 0){
  header("Location: http://localhost/news-site/admin/post.php");
};

include "config.php";


if(isset($_GET["page"])){
$page_number = $_GET["page"];
}else{
 $page_number = 1;
};


$sql = "SELECT user_id, first_name, last_name, username, role, CASE WHEN role = 1 THEN 'Admin'ELSE 'User' END AS user_role FROM user
ORDER BY user_id DESC";

$result = mysqli_query($conn, $sql) or die('Connection Failed : ' . mysqli_error($conn));

if(mysqli_num_rows($result) > 0){
   
$users = mysqli_num_rows($result);
$limit = 5;
$total_page = ceil($users/$limit);
$offset = ($page_number - 1)* $limit ;

$sql1 = "SELECT user_id, first_name, last_name, username, role, CASE WHEN role = 1 THEN 'Admin'ELSE 'User' END AS user_role FROM user
ORDER BY user_id DESC
LIMIT $offset, $limit";

$result2 = mysqli_query($conn, $sql1) or die('Connection Failed : ' . mysqli_error($conn));

if(mysqli_num_rows($result2) > 0){




?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Users</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-user.php">add user</a>
              </div>
              <div class="col-md-12">
  
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Full Name</th>
                          <th>Username</th>
                          <th>Role</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                        <?php
                        while($row = mysqli_fetch_assoc($result2)) {
                        ?>

                          <tr>
                              <td class='id'><?php echo $row["user_id"]; ?></td>
                              <td><?php echo $row["first_name"] . " " . $row["last_name"]; ?></td>
                              <td><?php echo $row["username"]; ?></td>
                              <td><?php echo $row["user_role"]; ?></td>
                              <td class='edit'><?php echo "<a href='update-user.php?id=". $row['user_id']."'>" ;  ?><i class='fa fa-edit'></i></td>
                              <td class='delete'><?php echo "<a href='delete-user.php?id=". $row['user_id']."'>" ;  ?><i class='fa fa-trash-o'></i></td>
                          </tr>
                        <?php
                        };
                        };
                      };
                        ?>
                      
                    
                
                      </tbody>
                  </table>
                 
              </div>
          </div>
      </div>
          <ul class="pagination admin-pagination">
                           <?php
                           $users = mysqli_num_rows($result);
                           $total_page = ceil($users/$limit);
                           $offset = ($page_number - 1)* $limit ;
                           for($i = 1; $i <= $total_page; $i++){

                            if($i == $page_number){
                             echo "<li class='active'><a href='http://localhost/news-site/admin/users.php?page={$i}'> {$i}</a></li>";

                            }else{
                             echo "<li><a href='http://localhost/news-site/admin/users.php?page={$i}'> {$i}</a></li>";
                            };
                            
                           };
                             

                            ?>

                        </ul>
  </div>
<?php 
include "footer.php"; ?>
<script>
document.addEventListener('contextmenu', function(e) {
e.preventDefault();
});
</script>



