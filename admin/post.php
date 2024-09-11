<?php include "header.php"; 
  include "config.php"; // database configuration


?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Posts</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-post.php">add post</a>
              </div>
              <div class="col-md-12">
                <?php
                // session_start();
               $role =  $_SESSION["role"];
               

               $user_id = $_SESSION["user_id"];
                 if(!$user_id || $user_id = ""){
                  header("Location: http://localhost/news-site/admin/post.php");
                 }

              if(isset($_GET["page"])){
                $page_no = $_GET["page"];
              }else{
                 $page_no = 1;

              };
                if($role == 1){
                $sql2 = " SELECT post.post_id, post.title, category.category_name, post.post_date, user.username FROM post 
                LEFT JOIN category ON post.category = category.category_id
                LEFT JOIN user ON post.author = user.user_id
                ORDER BY post.post_id DESC";
               }else{
                  $sql2 = " SELECT post.post_id, post.title, category.category_name, post.post_date, user.username, post.author FROM post 
                LEFT JOIN category ON post.category = category.category_id
                LEFT JOIN user ON post.author = user.user_id
                WHERE post.author = $user_id
                ORDER BY post.post_id DESC";
               };
          
               $result2 = mysqli_query($conn, $sql2) or die("Query Failed :" . mysqli_error($conn));

               if (mysqli_num_rows($result2)>0){
                
              $limit  = 2;
              $offset = ($page_no - 1) * $limit;
              $user = mysqli_num_rows($result2);
              $page = ceil($user/$limit);
        
            //    $user = $_SESSION["username"];
               if($role == 1){
                $sql = " SELECT post.post_id, post.title, category.category_name, post.post_date, user.username, post.category, post.author FROM post 
                LEFT JOIN category ON post.category = category.category_id
                LEFT JOIN user ON post.author = user.user_id
                ORDER BY post.post_id DESC
                LIMIT $offset, $limit";
               }else{
                  $sql = " SELECT post.post_id, post.title, category.category_name, post.post_date, user.username, post.category, post.author FROM post 
                LEFT JOIN category ON post.category = category.category_id
                LEFT JOIN user ON post.author = user.user_id
                WHERE post.author = $user_id
                ORDER BY post.post_id DESC
                LIMIT $offset, $limit";
               };
               

               $result = mysqli_query($conn, $sql) or die("Query Failed :" . mysqli_error($conn));


             

               if (mysqli_num_rows($result)>0){

             
               ?>
               
                  <table class="content-table">
                      <thead>
                          <th>Sr. No.</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>Date</th>
                          <th>Author</th>
                          <th>Edit</th>
                          <th>Delete</th>
                          <th>Author</th>
                      </thead>
                      <tbody>
                      <?php
                      while($row = mysqli_fetch_assoc($result)){

                     

                    ?>
                          <tr>
                              <td class='id'><?php echo $row["post_id"]  ?></td>
                              <td><?php echo $row["title"]  ?></td>
                              <td><?php echo $row["category_name"]  ?></td>
                              <td><?php echo $row["post_date"]  ?></td>
                              <td><?php echo $row["username"]  ?></td>
                              <td class='edit'><a href='update-post.php?id=<?php echo $row["post_id"]?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-post.php?id=<?php echo $row["post_id"]?>&catid=<?php echo $row["category"]?>'><i class='fa fa-trash-o'></i></a></td>
                               <td><?php echo $row["author"]  ?></td>
                          </tr>
                
                     <?php
                        };

                       }else{
                        echo "<p style='font-size:25px; font-weight:600; color:red;'>Yo have no post.</p>";
                       };
                       
                     ?>
                      </tbody>
                  </table>
             <ul class="pagination admin-pagination">
              <?php    for($i = 1; $i <= $page; $i++){

                            if($i == $page_no){
                             echo "<li  class='active'><a href='http://localhost/news-site/admin/post.php?page={$i}'> {$i}</a></li>";

                            }else{
                             echo "<li><a href='http://localhost/news-site/admin/post.php?page={$i}'> {$i}</a></li>";
                            };
                            
                           };
                  };
               ?>
               </ul>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
