<?php
include "config.php";
 
if(empty($_FILES['new-image']['name'])){
  $new_name  = $_POST['old_image'];

}else{
   
  $errors = array();
   $file_name = $_FILES['new-image']['name'];
   $file_size = $_FILES['new-image']['size'];
   $tmp_name = $_FILES['new-image']['tmp_name'];
   $file_type = $_FILES['new-image']['type'];
   $end = explode('.' , $file_name);
   $file_ext = end($end);
   $old_image = $_POST["old_image"];

  $new_time = time();
  $new_name = time(). "-" . $file_name;
  
   $extensions = array("jpeg", "jpg", "png");

   if(in_array($file_ext, $extensions) === false){
    $errors[] = "Please upload only jpg or png file.";
   };
   
   if($file_size > 2097152){
    $errors[] = "Please upload less than 2MB size of image.";
   }



   if(empty($errors) === true){
    move_uploaded_file($tmp_name, "upload/".$new_name);
    unlink("upload/".$old_image);
    // echo "uploaded";

   }else{
    echo $errors;
   }
}
$post_id = $_POST['post_id'];
$post_title = $_POST['post_title'];
$description = $_POST['postdesc'];
$category = $_POST['category'];
$sql = "UPDATE post SET title = '{$post_title}', description = '{$description}', category = '{$category}', post_img = '{$new_name}'
 WHERE post_id = $post_id";

 if(mysqli_query($conn, $sql)){
 header("location: http://localhost/news-site/admin/post.php");
 }else{
  echo "Query Failed ". mysqli_error($conn);
 }

?>
