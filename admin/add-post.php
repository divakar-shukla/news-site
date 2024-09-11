<?php 
include "header.php"; 
 include "config.php";



?>


  <div id="admin-content">
      <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <h1 class="admin-heading">Add New Post</h1>
             </div>
              <div class="">
                  <!-- Form -->
                  <form  action="save-post.php" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                          <label for="post_title">Title</label>
                          <input type="text" name="post_title" class="form-control" autocomplete="off" required>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1"> Description</label>
                          <!-- <textarea name="postdesc" class="form-control" rows="5"  required></textarea> -->
    <!-- Place the first <script> tag in your HTML's <head> -->
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
<textarea name="postdesc">

</textarea>

<!-- <tinymce-editor
      api-key="no-api-key"
      height="500"
      menubar="false"
      plugins="advlist autolink lists link image charmap preview anchor
        searchreplace visualblocks code fullscreen
        insertdatetime media table code help wordcount"
      toolbar="undo redo | blocks | bold italic backcolor |
        alignleft aligncenter alignright alignjustify |
        bullist numlist outdent indent | removeformat | help"
      content_style="body
      {
        font-family:Helvetica,Arial,sans-serif;
        font-size:14px
      }"
      >

      <!-- Adding some initial editor content -->

                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Category</label>
                          <select name="category" class="form-control">
                              <option selected disabled> Select Category</option>

                             <?php

                             $sql = "SELECT * FROM category";

                             $result =  mysqli_query($conn, $sql) or die("Query Failes :" . mysqli_error($conn));

                             if(mysqli_num_rows($result)>0){

                                while($row = mysqli_fetch_assoc($result)){
    
                            
                             ?>
                               

                               <option value="<?php echo $row["category_id"]?>"><?php echo $row["category_name"]?></option>

                               <?php
                                }
                            }

                               ?>
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Post image</label>
                          <input type="file" name="fileToUpload" required>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Save" required />
                  </form>
                  <!--/Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
