<?php
          include 'config.php';
       
            $category =mysqli_real_escape_string($conn, $_POST['cat_name']);
            $cat_id =mysqli_real_escape_string($conn, $_POST['cat_id']);
            /* query for check input value exists in category table or not*/
            $sql = "SELECT category_name FROM category 
                    WHERE category_name='{$category}' 
                    AND NOT category_id={$cat_id}";
            $result1 = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result1)> 0) {
                // if input value exists
              echo 0;
            }
                // if input value not exists
              /* query for update category table */
             $sql1 = "UPDATE category SET category_id='{$_POST['cat_id']}', category_name='{$_POST['cat_name']}'  
                       WHERE  category_id={$_POST['cat_id']}";
if(mysqli_query($conn, $sql1)){
    echo 1;
}else{
  echo 2;
}
                 
          ?>