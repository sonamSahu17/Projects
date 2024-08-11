

<?php
        include 'config.php';
          $cat_id = $_POST['id'];
         

          /* query record for modify*/
          $sql = "SELECT * FROM category WHERE category_id ='{$cat_id}'";
          $result = mysqli_query($conn, $sql);
          if (mysqli_num_rows($result) > 0) {
              while($row = mysqli_fetch_assoc($result)) { 
          
               $output = "";
               
               $output .="<tr>
               <h3>Edit Form..<h3>
<hr style=' border: 1px solid grey;'>
                           <td> <input id='edit-id' type='hidden' name='cat_id'  class='form-control' value='{$row["category_id"]}'>
                            <h4>category Name</h4>
                            <input id='edit-category-name' type='text' name='cat_name' class='form-control' value='{$row["category_name"]}'  placeholder='' required></td>
                            </tr>
                      <tr> 
                      <td><br> <input id='edit-submit'  type='submit' name='submit' class='btn btn-primary' value='Update' /></td>
                      </tr>";
              }
              echo $output;
             
          }else{
            echo "No record found...";
          }
        ?>