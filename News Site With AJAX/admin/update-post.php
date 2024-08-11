<style>
  .error {
    margin: -60px 0% 10px 389px;
    text-align: center;
    color: red;
    font-size: 20px;
    width: 555px;
     /* border:1px solid black;  */

    /* display: none; */
  }

  .success {
    display: inline-block;
    margin: -10px 0% 0% 93px;
    text-align: center;
    color: green;
    font-size: 20px;
    /* border:1px solid black; */
    width: 555px;
    display: none;
  }

  .h1{
    /* display: inline-block; */
    /* border: 1px solid black; */
    margin: 0px 100px 0px 50px;
    padding:0px 10px 0px 10px;

  }
</style>
<?php include "header.php";

if ($_SESSION["user_role"] == 0) {
  include "config.php";
  $post_id = $_GET['id'];
  $sql2 = "SELECT author FROM post WHERE post_id = {$post_id}";
  $result2 = mysqli_query($conn, $sql2) or die("Query Failed.");

  $row2 = mysqli_fetch_assoc($result2);

  if ($row2['author'] != $_SESSION["user_id"]) {
    header("location: {$hostname}/admin/post.php");
  }
}
?>
<div id="admin-content">
<h1 class="h1">Update Post</h1>
<!-- show error message -->
    <div name="error" class="error" id="error" ></div>
  <div class="container">
    <div class="row">
      <div class="col-md-offset-3 col-md-6">

        <?php
        include "config.php";
        $post_id = $_GET['id'];
        $sql = "SELECT post.post_id, post.title, post.description,post.post_img,
        category.category_name, post.category FROM post
        LEFT JOIN category ON post.category = category.category_id
        LEFT JOIN user ON post.author = user.user_id
        WHERE post.post_id = {$post_id}";    

        $result = mysqli_query($conn, $sql) or die("Query Failed.");
        if (mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);
$title = $row['title'];
$description = $row['description'];
$category = $row['category'];
$sql2="SELECT * from post where title='{$title}' and category='{$category}' and post_id != {$post_id}";
$result2 = mysqli_query($conn, $sql2) or die('query failed!');
$copy_data_no =  mysqli_num_rows($result2);
          // while($row = mysqli_fetch_assoc($result)) {
            ?>
            <!-- Form for show edit-->
            <form action="save-update-post.php" method="POST" enctype="multipart/form-data" autocomplete="off"
              onsubmit="return validateForm()">
              <div class="form-group">
                <input type="hidden" name="post_id" class="form-control" value="<?php echo $row['post_id']; ?>"
                  placeholder="">
              </div>
              <div class="form-group">
                <label for="exampleInputTile">Title</label>
                <input type="text" name="post_title" class="form-control" id="exampleInputUsername"
                  value="<?php echo $row['title']; ?>">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1"> Description</label>
                <textarea name="postdesc" class="form-control" required rows="5" id="description">
                                            <?php echo $row['description']; ?>
                                        </textarea>
              </div>
              <div class="form-group">
                <label for="exampleInputCategory">Category</label>
                <select class="form-control" name="category">
                  <option disabled > Select Category</option>
                  <?php
                  include "config.php";
                  $sql1 = "SELECT * FROM category";

                  $result1 = mysqli_query($conn, $sql1) or die("Query Failed.");

                  if (mysqli_num_rows($result1) > 0) {
                    while ($row1 = mysqli_fetch_assoc($result1)) {
                      if ($row['category'] == $row1['category_id']) {
                        $selected = "selected";
                      } else {
                        $selected = "";
                      }
                      echo "<option {$selected} value='{$row1['category_id']}'>{$row1['category_name']}</option>";
                    }
                  }
                  ?>
                </select>
                <input type="hidden" name="old_category" value="<?php echo $row['category']; ?>">
              </div>
              <div class="form-group">
                <label for="">Post image</label>
                <input type="file" name="new-image">
                <img src="upload/<?php echo $row['post_img']; ?>" height="150px">
                <input type="hidden" name="old_image" value="<?php echo $row['post_img']; ?>">
              </div>
              <input type="submit" name="submit" class="btn btn-primary " id="submit-btn" value="Update"  />
            </form>
            <!-- Form End -->
            <?php
          // }
        } else {
          echo "Result Not Found.";
        }


?>
      </div>
    </div>
  </div>
</div>
<script>
 function validateForm() {
    var desc = document.getElementById('description');
    var title = document.getElementById('exampleInputUsername');
    var copyDataNo = <?php echo $copy_data_no; ?>;


       
    // var s=document.getElementById("rbtn1");
    //    var n=document.getElementById("rbtn2");
    var errorElement = document.getElementById('error'); // Select the error message element

    function seterror(error) {
        errorElement.style.display = 'block'; // Display the error message
        errorElement.innerHTML = error; // Set the error message text
    }


    function clearError() {
        errorElement.innerHTML = ""; // Clear the error message
        title.style.border = '1px solid #ced4da'; // Reset title border to default
        desc.style.border = '1px solid #ced4da'; // Reset description border to default

    }

    // Function to check if a field is empty
    function isEmpty(value) {
        return value.trim() === '';
    }
    if (copyDataNo > 0) {
   
        seterror("* post already exists !");
        return false;
    }

    // Clear previous errors
    clearError();

    // Validate title
    if (isEmpty(title.value)) {
        seterror("* Title is required !");
        title.style.border = '1px solid red';
        title.style.display = 'inline-block';
        title.focus();
        return false;
    }

    if (title.value.length > 100) {
        seterror("* Title Is Too Long !");
        title.style.border = '1px solid red';
        title.focus();
        return false;
    }

    // Validate description
    if (isEmpty(desc.value)) {
        seterror("* Description is required !");
        desc.style.border = '1px solid red';
        desc.focus();
        return false;
    }

    if (dese.value.length < 20) {
        seterror("* Description Is Too Short !");
        desc.style.border = '1px solid red';
        desc.focus();
        return false;
    }

   
  
    // If both fields are filled, return true to submit the form
    return true;
}

// Event listeners to reset borders on blur
// document.getElementById('exampleInputUsername').addEventListener('blur', function () {
//     this.style.border = '3px solid #ced4da'; // Reset border to default on blur
// });

// document.getElementById('description').addEventListener('blur', function () {
//     this.style.border = '3px solid #ced4da'; // Reset border to default on blur
// });

</script>
<?php include "footer.php"; ?>


