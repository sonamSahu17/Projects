
<link rel="stylesheet" href="../css/style.css" />

<?php include "header.php";
//show success or delete messages
if(!isset($_GET['error-msg'])){
  $value = "";
  echo "<div id='error-message'></div>";

}else{
  $value = $_GET['error-msg'];
  echo "<div id='error-message'>.{$value}.</div>";

}
?>

<div id="admin-content">
    <div class="container">
    <div id="error" style=" width:100%; margin : 0px 0px 0px 0px;  color:red;  float:left; text-align: center;"></div>

        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Add New Post</h1>
           
            
            <div class="col-md-offset-3 col-md-6">
                <!-- Form -->
                <form action="save-post.php" method="POST" onsubmit="return validateForm()"  enctype="multipart/form-data" name="myform" >
                    
                <div class="form-group">
                        <label for="post_title">Title</label>
                        <input type="text" name="post_title" class="form-control" autocomplete="off" id ="title" >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1"> Description</label>
                        <textarea name="postdesc" class="form-control" rows="5" id="desc" ></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Category</label>
                        <select name="category" class="form-control"  id="category">
                            <option disabled selected value="" placeholder=""> Select Category</option>
                            <?php
                            include "config.php";
                            $sql = "SELECT * FROM category";

                            $result = mysqli_query($conn, $sql) or die("Query Failed.");

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='{$row['category_id']}'>{$row['category_name']}</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Post image</label>
                        <input type="file" name="fileToUpload" id="file">
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Save" id="submit-btn"/>
                </form>
                <!--/Form -->
            </div>
        </div>
    </div>
</div>


            </div>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript">
    
  
        function validateForm() {
            var  title = document.getElementById('title');
            var  category = document.getElementById('category');
            var  desc = document.getElementById('desc');
            var  file = document.getElementById('file');
            var  error = document.getElementById('error-message');

        function clearError() {
        error.innerHTML = ""; // Clear the error message
        title.style.border = '1px solid #ced4da'; // Reset title border to default
        desc.style.border = '1px solid #ced4da'; // Reset description border to default
        category.style.border = '1px solid #ced4da'; // Reset description border to default
        file.style.border = '1px solid #ced4da'; // Reset description border to default
    }
         
    clearError();
            // validate title
            if (title.value.trim() === ''){
                error.innerHTML = '* Write Title !';
                title.style.border = '1px solid red';               
                title.focus();
                return false;
            }                   

             // validate description
             if (desc.value.trim() === ''){
                error.innerHTML = '* Write Description !';
                desc.style.border = '1px solid red';               
                desc.focus();
                return false;
            }

            // validate category
            if (category.value === ''){
                error.innerHTML = '* Select Category !';
                category.style.border = '1px solid red';               
                category.focus();
                return false;
            }
            
            // validate file
            if (file.value === ''){
                error.innerHTML = '* Choose File !';
                file.style.border = '1px solid red';               
                file.focus();
                return false;
            }
         
            return true;
        }
</script>
<?php include "footer.php"; ?>