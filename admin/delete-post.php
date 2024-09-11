<?php
  include "config.php";
  session_start();

  $post_id = $_GET['id'];
  $cat_id = $_GET['catid'];
  $post_author = $_SESSION["user_id"];
   if(!$post_id || !$cat_id){
    header("Location: http://localhost/news-site/admin/post.php");
  };

   if($_SESSION["role"] == 0){
        $sql1 = "SELECT * FROM post WHERE post_id = $post_id AND author = $post_author";
       $sql = "DELETE FROM post WHERE post_id = $post_id AND author = $post_author;";
       $sql .= "UPDATE category SET post = post - 1 WHERE category_id = $cat_id";
   }else{
     $sql1 = "SELECT * FROM post WHERE post_id = $post_id";
      $sql = "DELETE FROM post WHERE post_id = $post_id;";
     $sql .= "UPDATE category SET post = post - 1 WHERE category_id = $cat_id";
   }

  // $sql1 = "SELECT * FROM post WHERE post_id = $post_id";
   
  $result = mysqli_query($conn, $sql1) or die("Query Failed : Select");
  $row = mysqli_fetch_assoc($result);
  if($row == 0){
    header("Location: http://localhost/news-site/admin/post.php");
  }

  unlink("upload/".$row['post_img']);

  // $sql = "DELETE FROM post WHERE post_id = $post_id;";
  // $sql .= "UPDATE category SET post = post - 1 WHERE category_id = $cat_id";
// echo $post_id;
// echo $cat_id;
// die();
  if(mysqli_multi_query($conn, $sql)){
 header("location: http://localhost/news-site/admin/post.php");
echo $post_id;
echo $cat_id;
  }else{
    echo "Query Failed ". mysqli_error($conn);
  }
?>
