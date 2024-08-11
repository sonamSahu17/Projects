<?php include "header.php";
if($_SESSION["user_role"] == '0'){
  header("Location: {$hostname}/admin/post.php");
}
if(isset($_POST['save'])){
  include "config.php";

  $fname =mysqli_real_escape_string($conn,$_POST['fname']);
  $lname = mysqli_real_escape_string($conn,$_POST['lname']);
  $user = mysqli_real_escape_string($conn,$_POST['user']);
  $password = mysqli_real_escape_string($conn,md5($_POST['password']));
  $role = mysqli_real_escape_string($conn,$_POST['role']);

  $sql = "SELECT username FROM user WHERE username = '{$user}'";

  $result = mysqli_query($conn, $sql) or die("Query Failed.");

  if(mysqli_num_rows($result) > 0){
    echo "<p style='color:red;text-align:center;margin: 10px 0;'>UserName already Exists.</p>";
  }else{
    $sql1 = "INSERT INTO user (first_name,last_name, username, password, role)
              VALUES ('{$fname}','{$lname}','{$user}','{$password}','{$role}')";
    if(mysqli_query($conn,$sql1)){
      header("Location: {$hostname}/admin/users.php?success-msg=User Adeded Successfully !");
    }else{
      echo "<p style='color:red;text-align:center;margin: 10px 0;'>Can't Insert User.</p>";
    }
  }
}
?>

  <div id="admin-content">
      <div class="container">
      <div id="error" style=" width:100%; margin : 0px 0px 0px 0px;  color:red;  float:left; text-align: center;"></div>

          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add User</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form  action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST" autocomplete="off"  onsubmit="return validateForm()">
                      <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="fname" class="form-control"  id="firstName" >
                      </div>
                          <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="lname" class="form-control"  id="lastName">
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="user" class="form-control"  id="userName">
                      </div>

                      <div class="form-group">
                          <label>Password</label>
                          <input type="password" name="password" class="form-control"  id="password">
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" >
                              <option value="0">Normal User</option>
                              <option value="1">Admin</option>
                          </select>
                      </div>
                      <input type="submit"  name="save" class="btn btn-primary" value="Save"  />
                  </form>
                   <!-- Form End-->
               </div>
           </div>
       </div>
   </div>
   <script type="text/javascript" src="../js/jquery.js"></script>
   <script type="text/javascript">

        function validateForm() {
            var error = document.getElementById('error');
            var  firstName = document.getElementById('firstName');
            var  lastName = document.getElementById('lastName');
            var  userName = document.getElementById('userName');
            var  password = document.getElementById('password');
            var correct_way = /^[a-zA-Z0-9_]{3,20}$/;

        function clearError() {
        error.innerHTML = ""; // Clear the error message
        firstName.style.border = '1px solid #ced4da'; // Reset title border to default
        lastName.style.border = '1px solid #ced4da'; // Reset description border to default
        userName.style.border = '1px solid #ced4da'; // Reset description border to default
        password.style.border = '1px solid #ced4da'; // Reset description border to default
    }
         
    clearError();
            // validate first name
            if (firstName.value.trim() === ''){
                error.innerHTML = '* Ente First Name !';
                firstName.style.border = '1px solid red';               
                firstName.focus();
                return false;
            }  
            
            if (firstName.value.length > 100){
                error.innerHTML = "* It's too long !";
                firstName.style.border = '1px solid red';               
                firstName.focus();
                return false;
            }  

             // validate last name
             if (lastName.value.trim() === ''){
                error.innerHTML = '* Enter Last Name !';
                lastName.style.border = '1px solid red';               
                lastName.focus();
                return false;
            }

            if (lastName.value.length > 100){
                error.innerHTML = "* It's too long !";
                lastName.style.border = '1px solid red';               
                lastName.focus();
                return false;
            }

            // validate username
            if (userName.value === ''){
                error.innerHTML = '* Enter Your User Name !';
                userName.style.border = '1px solid red';               
                userName.focus();
                return false;
            }

            if (userName.value.length < 3 || userName.value.length > 20) {
                error.innerHTML = '* Username must be between 3 and 20 characters.';
                userName.style.border = '1px solid red';               
                userName.focus();
                return false;
               }

            
            if (userName.value.match(correct_way)) {
                true;}
                else{
                error.innerHTML = '* Username can only contain letters, numbers, and underscores.';
                userName.style.border = '1px solid red';               
                userName.focus();
                return false;
               }

            // validate password
            if (password.value === ''){
                error.innerHTML = '* Enter your Password !';
                password.style.border = '1px solid red';               
                password.focus();
                return false;
            }

            if (password.value.length < 3){
                error.innerHTML = '* Enter Atleast 3 Character !';
                password.style.border = '1px solid red';               
                password.focus();
                return false;
            }
           
           //validate 
            return true;
        }
</script>
<?php include "footer.php"; ?>
