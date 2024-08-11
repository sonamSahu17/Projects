<link rel="stylesheet" href="../css/style.css" />

<?php include "header.php";
//show success messages
if(!isset($_GET['success-msg'])){
  $value = "";
  echo "<div id='error-message' class='error-message'></div>";

}else{
  $value = $_GET['success-msg'];
  echo "<div id='success-message' class='error-message'>.{$value}.</div>";

}

?>
  <div id="admin-content">
      <div class="container">
      <div id="error" style=" width:100%; margin : 0px 0px 0px 0px;  color:red;  float:left; text-align: center;"></div>

         <div class="row">
             <div class="col-md-12">
                 <h1 class="admin-heading">Website Settings</h1>
             </div>
              <div class="col-md-offset-3 col-md-6">
                <?php
                  include "config.php";

                  $sql = "SELECT * FROM settings";

                  $result = mysqli_query($conn, $sql) or die("Query Failed.");
                  if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)) {
                ?>
                  <!-- Form -->
                  <form  action="save-settings.php" method="POST" enctype="multipart/form-data" onsubmit ="return  validateForm()">
                      <div class="form-group">
                          <label for="website_name">Website Name</label>
                          <input type="text" name="website_name" value="<?php echo $row['websitename']; ?>" class="form-control" autocomplete="off" id="webName">
                      </div>
                      <hr style="border:0.1px solid grey">
                      <div class="form-group">
                          <label for="logo">Website Logo</label></br>
                          <input type="file" name="logo" id="logo"></br></br>
                          <img src="images/<?php echo $row['logo']; ?>">
                          <input type="hidden" name="old_logo" value="<?php echo $row['logo']; ?>" >
                      </div>
                      <hr style="border:1px solid grey">
                      <div class="form-group">
                          <label for="footer_desc">Footer Description</label>
                          <textarea name="footer_desc" class="form-control" rows="5" id="desc"><?php echo $row['footerdesc']; ?></textarea>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Save"  />
                  </form>
                  <!--/Form -->
                  <?php
                      }
                    }
                  ?>
              </div>
          </div>
      </div>
  </div>
  <script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript">
    
  
        function validateForm() {
            var  webName = document.getElementById('webName');
            var  desc = document.getElementById('desc');
            var  logo = document.getElementById('logo');
            var error = document.getElementById('error-message');

        function clearError() {
        error.innerHTML = ""; // Clear the error message
        webName.style.border = '1px solid #ced4da'; // Reset description border to default
        logo.style.border = '1px solid #ced4da'; // Reset description border to default
        desc.style.border = '1px solid #ced4da'; // Reset description border to default
    }
         
    clearError();

    
            // validate web name
            if (webName.value === ''){
                error.innerHTML = '* Write Website Name !';
                webName.style.border = '1px solid red';               
                webName.focus();
                return false;
            }
          
            // validate footer description
            if (desc.value.trim() === ''){
                error.innerHTML = '* Write Footer Description !';
                desc.style.border = '1px solid red';               
                desc.focus();
                return false;
            }         


            return true;
        }
</script>
<?php include "footer.php"; ?>
