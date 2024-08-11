<?php include "header.php";
if($_SESSION["user_role"] == '0'){
  header("Location: {$hostname}/admin/post.php");
}
if(isset($_POST['submit'])){
  include "config.php";

  $userid =mysqli_real_escape_string($conn,$_POST['user_id']);
  $fname =mysqli_real_escape_string($conn,$_POST['f_name']);
  $lname = mysqli_real_escape_string($conn,$_POST['l_name']);
  $user = mysqli_real_escape_string($conn,$_POST['username']);
  $role = mysqli_real_escape_string($conn,$_POST['role']);

  $sql = "UPDATE user SET first_name = '{$fname}', last_name = '{$lname}', username = '{$user}', role = '{$role}' WHERE user_id = {$userid}";

    if(mysqli_query($conn,$sql)){
      header("Location: {$hostname}/admin/users.php?success-msg= User Data Updated Successfully !");
    }
}
?>
  <div id="admin-content">
      <div class="container">
      <div id="error" style=" width:100%; margin : 0px 0px 0px 0px;  color:red;  float:left; text-align: center;"></div>

          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Modify User Details</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">
                <?php
                include "config.php";
                $user_id = $_GET['id'];
                $sql = "SELECT * FROM user WHERE user_id = {$user_id}";
                $result = mysqli_query($conn, $sql) or die("Query Failed.");
                if(mysqli_num_rows($result) > 0){
                  while($row = mysqli_fetch_assoc($result)){
                ?>
                  <!-- Form Start -->
                  <form  action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST" onsubmit ="return  validateForm()">
                      <div class="form-group">
                          <input type="hidden" name="user_id" class="form-control" value="<?php echo $row['user_id'];  ?>">
                      </div>
                          <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="f_name" class="form-control" value="<?php echo $row['first_name'];  ?>" id ="fname">
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="l_name" class="form-control" value="<?php echo $row['last_name'];  ?>" id="lname">
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="username" class="form-control" value="<?php echo $row['username'];  ?>" id="uname">
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" value="<?php echo $row['role']; ?>">
                            <?php
                              if($row['role'] == 1){
                                echo "<option value='0'>normal User</option>
                                      <option value='1' selected>Admin</option>";
                              }else{
                                echo "<option value='0' selected>normal User</option>
                                      <option value='1'>Admin</option>";
                              }
                            ?>
                          </select>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" />
                  </form>
                  <!-- /Form -->
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
            var error = document.getElementById('error');
            var  fname = document.getElementById('fname');
            var  lname = document.getElementById('lname');
            var  uname = document.getElementById('uname');
            var correct_way = /^[a-zA-Z0-9_]{3,20}$/;

            
        function clearError() {
        error.innerHTML = ""; // Clear the error message
        fname.style.border = '1px solid #ced4da'; // Reset title border to default
        lname.style.border = '1px solid #ced4da'; // Reset description border to default
        uname.style.border = '1px solid #ced4da'; // Reset description border to default
    }
         
    clearError();
            // validate first name
            if (fname.value.trim() === ''){
                error.innerHTML = '* Ente First Name !';
                fname.style.border = '1px solid red';               
                fname.focus();
                return false;
            }  
            
            if (fname.value.length > 100){
                error.innerHTML = "* It's too long !";
                fname.style.border = '1px solid red';               
                fname.focus();
                return false;
            }  

             // validate last name
             if (lname.value.trim() === ''){
                error.innerHTML = '* Enter Last Name !';
                lname.style.border = '1px solid red';               
                lname.focus();
                return false;
            }

            if (lname.value.length > 100){
                error.innerHTML = "* It's too long !";
                lname.style.border = '1px solid red';               
                lname.focus();
                return false;
            }

            // validate username
            if (uname.value === ''){
                error.innerHTML = '* Enter Your User Name !';
                uname.style.border = '1px solid red';               
                uname.focus();
                return false;
            }

            if (uname.value.length < 3 || uname.value.length > 20) {
                error.innerHTML = '* Username must be between 3 and 20 characters.';
                uname.style.border = '1px solid red';               
                uname.focus();
                return false;
               }

            
            if (uname.value.match(correct_way)) {
                true;}
                else{
                error.innerHTML = '* Username can only contain letters, numbers, and underscores.';
                uname.style.border = '1px solid red';               
                uname.focus();
                return false;
               }

           
           
           //validate 
            return true;
        }
</script>
<?php include "footer.php"; ?>
