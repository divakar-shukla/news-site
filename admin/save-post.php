<?php
include "config.php";
if(isset($_FILES["fileToUpload"])){
$error = array();
 $file_name = $_FILES["fileToUpload"]["name"];
 $tmp_name = $_FILES["fileToUpload"]["tmp_name"];
 $file_size = $_FILES["fileToUpload"]["size"];
 $file_type = $_FILES["fileToUpload"]["type"];
 $extn = explode('.' , $file_name);
 $file_ext = end($extn);
 $extension = ["jpeg", "jpg", "png"];

$new_name = time(). "-" . $file_name;

 if (in_array($file_ext, $extension) === false){
  $error[] = " Please upload only jpeg, jpeg, png image.";
 };

if($file_size > 2194304){
  $error[] = "Please upload image that's size is less than 4MB.";
};

if(empty($error) === true){
  move_uploaded_file($tmp_name, "upload/". $new_name);

}else{
 echo $error;
};
};

if(isset($_POST["submit"])){
session_start();
  $post_title = mysqli_real_escape_string($conn, $_POST["post_title"]);
  $postdesc = mysqli_real_escape_string($conn, $_POST["postdesc"]);
  $category = mysqli_real_escape_string($conn, $_POST["category"]);
  $post_image = $new_name;
  $post_date = date("d, M, Y"); 
  $author = $_SESSION["user_id"];
  
 $sql = "INSERT INTO post(title, description, category, post_date, author, post_img)
          VALUES('{$post_title}', '{$postdesc}', {$category}, '{$post_date}', {$author}, '{$post_image}');";
 $sql .= "UPDATE category SET post = post + 1 WHERE category_id = {$category}";

  if(mysqli_multi_query($conn, $sql)){
    header("location: http://localhost/news-site/admin/post.php");
  }else{
    echo "Some error occuered." . mysqli_error($conn). "Please again with right value.";
  };
};

?>