<?php include "header.php";
include "config.php";

// if($_SESSION["user_role"] == 0){
//   include "config.php";
//   $post_id = $_GET['id'];
//   $sql2 = "SELECT author FROM post WHERE post_id = {$post_id}";
//   $result2 = mysqli_query($conn, $sql2) or die("Query Failed.");

//   $row2 = mysqli_fetch_assoc($result2);

//   if($row2['author'] != $_SESSION["user_id"]){
//     header("location: {$hostname}/admin/post.php");
//   }

// }
 $post_id = $_GET["id"];
if($_SESSION["role"] == 0){
  $sql = "SELECT author FROM post where post_id = $post_id";
  $result = mysqli_query($conn, $sql) or die("Query1 Failed : " . mysqli_error($conn));
   $row =  mysqli_fetch_assoc($result);
  if($row["author"] != $_SESSION["user_id"]){
 header("location: http://localhost/news-site/admin/post.php");
 };
};

$sql2 = "SELECT post_id, title, description, category, post_img FROM post WHERE post_id = $post_id";
$result2  = mysqli_query($conn, $sql2);
if(mysqli_num_rows($result2)>0){
   
  $row2 = mysqli_fetch_assoc($result2);

};
$category_id  = $row2["category"];
  

 ?>
<div id="admin-content">
  
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="admin-heading">Update Post</h1>
    </div>
    <div class="">
 
        <!-- Form for show edit-->
        <form action="save-update-post.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
                <input type="hidden" name="post_id"  class="form-control" value="<?php echo $row2["post_id"]; ?>" placeholder="">
            </div>
            <div class="form-group">
                <label for="exampleInputTile">Title</label>
                <input type="text" name="post_title"  class="form-control" id="exampleInputUsername" value="<?php echo $row2["title"]; ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"> Description</label>
                <script src="https://cdn.tiny.cloud/1/9pqry6dqtt0dhm3kb5ui4c8wwd5g1umgbzaq5sjgj8ooxrk9/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

<!-- Place the following <script> and <textarea> tags your HTML's <body> -->
<script>
  tinymce.init({
    selector: 'textarea',   
    menubar: 'nones',
    plugins: 'anchor autolink  codesample  image link lists media  table  wordcount checklist mediaembed  linkchecker permanentpen powerpaste advtable advcode editimage advtemplate ai tableofcontents typography',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline  | link image media table  | align lineheight | checklist numlist bullist indent outdent ',
    ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
  });
</script>

                <textarea name="postdesc" class="form-control"  required rows="5"><?php  echo $row2["description"] ?></textarea>

              
                  <script>
                     let tox = document.querySelector(".tox-statusbar__branding")
                    console.log(tox)
 
                  </script>
            </div>
            <div class="form-group">
                <label for="exampleInputCategory">Category</label>
                <select class="form-control" name="category">
                  <option disabled> Select Category</option>
                  <?php
                  
               
                

                             $sql3 = "SELECT * FROM category";

                             $result3 =  mysqli_query($conn, $sql3) or die("Query Failes :" . mysqli_error($conn));

                             if(mysqli_num_rows($result3)>0){

                                while($row3 = mysqli_fetch_assoc($result3)){
                                
                             if($category_id == $row3["category_id"]){
                            echo "<option selected value='{$row3["category_id"]}'>{$row3['category_name']}</option>";

                             }else{
                            echo "<option  value='{$row3["category_id"]}'>{$row3['category_name']}</option>";

                             }
                           
                       
                                };
                            };

                            
                               ?>
                   
               
                </select>
                <!-- <input type="hidden" name="old_category" value=" -->
                <?php
                //  echo $row2['category'];
                //  ?>
                <!-- "> -->
            </div>
            <div class="form-group"> 
                <label for="">Post image</label>
                <input type="file" name="new-image" >
                <img  src="upload/<?php echo $row2['post_img']; ?>" height="150px">
                <input type="hidden" name="old_image" value="<?php echo $row2['post_img']; ?>">
            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
        </form>
        <!-- Form End -->
   
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
